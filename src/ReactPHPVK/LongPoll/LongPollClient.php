<?php

namespace ReactPHPVK\LongPoll;

use ReactPHPVK\Client\AVKClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Closure;

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

    public Closure $onFailHTTPRequest;

    public function __construct(AVKClient $AVKClient, int $groupId, int $wait = 25, $mode = 2)
    {
        $this->onFailHTTPRequest = function (Throwable $throwable) {};

        $this->client = $AVKClient;
        $this->groupId = $groupId;
        $this->wait = $wait;
        $this->mode = $mode;

        $this->client->_provider->logger->info('[AVK] LP Init');
    }

    public function handle(callable $callable)
    {
        if ($this->work === self::STATUS_STOP || $this->work === self::STATUS_FAST_STOP) return null;

        return
            $this->getUpdates()
                ->then(
                    function ($response) use ($callable) {
                        $this->client->_provider->logger->debug('[AVK] LP handle ' . json_encode($response));
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

        $this->client->_provider->logger->debug("[AVK] LP request TS:{$this->actualTs} KEY:{$this->actualKey} SERVER:{$this->actualServer}");

        return $this->client->_provider->browser->get("{$this->actualServer}?" . http_build_query([
                'act' => 'a_check',
                'key' => $this->actualKey,
                'ts' => $this->actualTs,
                'wait' => $this->wait,
                'mode' => $this->mode
            ])
        )->then(
            function (ResponseInterface $response) {
                $this->client->_provider->logger->debug("[AVK] LP response TS:{$this->actualTs} KEY:{$this->actualKey} SERVER:{$this->actualServer} HTTP_CODE:{$response->getStatusCode()} BODY:{$response->getBody()}");

                $response = json_decode($response->getBody(), true);
                if (isset($response['failed'])) {
                    if ($response['failed'] === 1) {
                        $this->client->_provider->logger->error("[AVK] LP error 1");
                        return $this->getUpdates($response['ts']);
                    }

                    if ($response['failed'] === 2) {
                        $this->client->_provider->logger->error("[AVK] LP error 2");
                        return $this->getLongPollInfo()->then(
                            function ($response) {
                                $this->actualKey = $response['key'];
                                $this->actualServer = $response['server'];
                                return $this->getUpdates();
                            }
                        );
                    }

                    if ($response['failed'] === 3) {
                        $this->client->_provider->logger->error("[AVK] LP error 3");
                        return $this->getLongPollInfo()->then(
                            function ($response) {
                                $this->actualTs = $response['ts'];
                                $this->actualKey = $response['key'];
                                $this->actualServer = $response['server'];
                                return $this->getUpdates();
                            }
                        );
                    }
                }

                $this->actualTs = $response['ts'];

                return $response;
            },
            function (Throwable $throwable) {
                $this->client->_provider->logger->error("[AVK] LP (a_check) Throwable: {$throwable->getMessage()}");
                call_user_func($this->onFailHTTPRequest, $throwable);
                return $this->getUpdates();
            }
        );
    }

    public function getLongPollInfo()
    {
        return $this->client->groups()->getLongPollServer()->setGroupId($this->groupId)->execute();
    }
}