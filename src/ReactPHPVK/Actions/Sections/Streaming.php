<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Streaming
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Allows to receive data for the connection to Streaming API.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getServerUrl(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('streaming.getServerUrl', $sendParams);
    }

    /**
     * streaming.setSettings
     * 
     * @param string|null $monthlyTier
     * @param array|null $custom
     * @return Promise
     */
    function setSettings(?string $monthlyTier = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($monthlyTier !== '' && $monthlyTier != null) $sendParams['monthly_tier'] = $monthlyTier;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('streaming.setSettings', $sendParams);
    }
}