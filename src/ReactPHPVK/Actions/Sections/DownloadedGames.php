<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class DownloadedGames
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * downloadedGames.getPaidStatus
     * 
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function getPaidStatus(?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('downloadedGames.getPaidStatus', $sendParams);
    }
}