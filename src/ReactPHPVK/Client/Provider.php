<?php

namespace ReactPHPVK\Client;

use Psr\Log\LoggerInterface;
use ReactPHPVK\Client\Exceptions\APIResponseException;
use ReactPHPVK\Client\Exceptions\RuntimeException;
use ReactPHPVK\Logger\Logger;
use ReactPHPVK\Throttling\QManager;
use Clue\React\Buzz\Browser;
use Exception;
use Closure;
use Throwable;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use React\Promise\Promise;
use function React\Promise\reject;
use function React\Promise\resolve;

class Provider
{
    public LoggerInterface $logger;
    public Browser $browser;
    public LoopInterface $loop;
    public Closure $onFailHTTPRequest;
    private QManager $qManager;
    private string $accessToken;
    private float $version;
    private ?string $language;
    private float $limiter;

    /**
     * Provider constructor.
     * @param LoopInterface $loop
     * @param string $accessToken
     * @param Browser|null $browser
     * @param float $limiter
     * @param float $version
     * @param string|null $language
     * @param QManager|null $qManager
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoopInterface $loop, string $accessToken, Browser $browser = null, float $limiter = 0, float $version = 5.122, string $language = null, QManager $qManager = null, LoggerInterface $logger = null)
    {
        $this->onFailHTTPRequest = function (Throwable $throwable, $method, $params) {
            $this->request($method, $params);
        };

        $this->loop = $loop;
        $this->accessToken = $accessToken;
        $this->browser = $browser ?? new Browser($loop);
        $this->version = $version;
        $this->language = $language;
        $this->limiter = $limiter;
        $this->qManager = $qManager ?? new QManager($loop);
        $this->logger = $logger ?? new Logger();

        $this->logger->info('[AVK] Init');
    }

    /**
     * @param string $method
     * @param array $params
     * @return Promise
     */
    public function request(string $method, array $params = []): Promise
    {
        $params['access_token'] ??= $this->accessToken;
        $params['v'] ??= $this->version;

        if (!empty($this->language)) {
            $params['lang'] ??= $this->language;
        }

        $this->logger->debug("[AVK] API Request: ($method) " . json_encode($params));

        return $this->qManager->limiter(
            fn() => $this->browser->post("https://api.vk.com/method/{$method}", [], http_build_query($params)),
            $this->limiter,
            'api'
        )->then(
            function (ResponseInterface $response) use ($method, $params) {
                $this->logger->debug("[AVK] API Response: ($method) " . json_encode($params) . " {$response->getStatusCode()} & {$response->getBody()}");

                $array = json_decode($response->getBody(), true);

                if (empty($array)) {
                    reject(new RuntimeException("Empty response: '{$response->getBody()}'"));
                }

                if (isset($array['error'])) {
                    $apiResParams = json_encode(
                        $array['error']['request_params'],
                        JSON_UNESCAPED_UNICODE
                    );
                    $message = "{$array['error']['error_msg']} {$apiResParams}";

                    return reject(
                        new APIResponseException(
                            $message,
                            $array['error']['error_code']
                        )
                    );
                }

                return resolve($array['response']);
            },
            function (Exception $error) use ($params, $method) {
                $this->logger->error("[AVK] Exception {$error->getFile()} {$error->getMessage()} {$error->getTraceAsString()}");

                if ($this->onFailHTTPRequest) {
                    return call_user_func($this->onFailHTTPRequest, $error, $method, $params);
                }

                return reject($error);
            }
        );
    }
}