<?php

namespace ReactPHPVK\Client;

use ReactPHPVK\Client\Exceptions\APIResponseException;
use ReactPHPVK\Client\Exceptions\RuntimeException;
use ReactPHPVK\Throttling\QManager;
use Clue\React\Buzz\Browser;
use Exception;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use React\Promise\Promise;
use function React\Promise\reject;
use function React\Promise\resolve;

class Provider
{
    public Browser $browser;

    private QManager $qManager;
    public LoopInterface $loop;

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
     */
    public function __construct(LoopInterface $loop, string $accessToken, Browser $browser = null, float $limiter = 0, float $version = 5.122, string $language = null, QManager $qManager = null)
    {
        $this->loop = $loop;
        $this->accessToken = $accessToken;
        $this->browser = $browser ?? new Browser($loop);
        $this->version = $version;
        $this->language = $language;
        $this->limiter = $limiter;
        $this->qManager = $qManager ?? new QManager($loop);
    }

    /**
     * @param string $method
     * @param array $params
     * @param string $limiterTag
     * @return Promise
     */
    public function request(string $method, array $params = [], $limiterTag = 'api'): Promise
    {
        $params['access_token'] ??= $this->accessToken;
        $params['v'] ??= $this->version;
        $params['lang'] ??= $this->language;

        return $this->qManager->limiter(
            fn () => $this->browser->post("https://api.vk.com/method/{$method}", [], http_build_query($params)),
            $this->limiter,
            $limiterTag
        )->then(
            function (ResponseInterface $response) {
                $array = json_decode($response->getBody(), true);
                if (empty($array)) reject(new RuntimeException("Empty response: '{$response->getBody()}'"));
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
            function (Exception $error) {
                return reject($error);
            }
        );
    }
}