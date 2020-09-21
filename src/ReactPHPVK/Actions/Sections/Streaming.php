<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Streaming\GetServerUrl;
use ReactPHPVK\Actions\Sections\Streaming\SetSettings;

class Streaming
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to receive data for the connection to Streaming API.
     */
    public function getServerUrl(): GetServerUrl
    {
        return new GetServerUrl($this->_provider);
    }

    /**
     * 
     */
    public function setSettings(): SetSettings
    {
        return new SetSettings($this->_provider);
    }

}