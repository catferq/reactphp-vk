<?php

namespace ReactPHPVK\LongPoll;

use ReactPHPVK\Client\AVKClient;
use Psr\Http\Message\ResponseInterface;

class LongPollClient
{
    private const STATUS_START = 1;
    private const STATUS_STOP = 0;
    private const STATUS_FAST_STOP = -1;

    private int $work = 1;
    private int $groupId;
    private AVKClient $client;

    private ?string $actualKey = null;
    private ?string $actualServer = null;
    private ?int $actualTs = null;

    private int $wait;
    private int $mode;

    public function __construct(AVKClient $AVKClient, int $groupId, int $wait = 10, $mode = 2)
    {
        $this->client = $AVKClient;
        $this->groupId = $groupId;
        $this->wait = $wait;
        $this->mode = $mode;
    }

    public function handle(callable $callable)
    {
        if ($this->work === self::STATUS_STOP || $this->work === self::STATUS_FAST_STOP) return null;
        return
            $this->getUpdates()
                ->then(
                    function ($response) use ($callable) {
                        if (!empty($response['updates'])) {
                            foreach ($response['updates'] as $update) {
                                $this->work = $callable($update) ?? 1;
                                if ($this->work === self::STATUS_FAST_STOP) break;
                            }
                        }
                        $this->handle($callable);
                    }
                );
    }

    public function getUpdates($newTs = null)
    {
        if ($newTs) $this->actualTs = $newTs;
        if (!$this->actualServer) {
            return $this->getLongPollInfo()->then(
                function ($response) {
                    $this->actualServer = $response['server'];
                    $this->actualKey = $response['key'];
                    $this->actualTs ??= $response['ts'];
                    return $this->getUpdates();
                }
            );
        }
        return $this->client->provider->browser->get("{$this->actualServer}?" . http_build_query([
                'act' => 'a_check',
                'key' => $this->actualKey,
                'ts' => $this->actualTs
            ])
        )->then(
            function (ResponseInterface $response) {
                $response = json_decode($response->getBody(), true);
                if (isset($response['error'])) {
                    if ($response['error'] === 1) return $this->getUpdates($response['ts']);
                    if ($response['error'] === 2) {
                        return $this->getLongPollInfo()->then(
                            function ($response) {
                                $this->actualKey = $response['key'];
                                $this->actualServer = $response['server'];
                                return $this->getUpdates();
                            }
                        );
                    }
                    if ($response['error'] === 3) {
                        return $this->getLongPollInfo()->then(
                            function ($response) {
                                $this->actualKey = $response['key'];
                                $this->actualServer = $response['server'];
                                return $this->getUpdates();
                            }
                        );
                    }
                }

                $this->actualTs = $response['ts'];

                return $response;
            }
        );
    }

    public function getLongPollInfo()
    {
        return $this->client->groups()->getLongPollServer($this->groupId);
    }
}