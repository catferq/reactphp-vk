<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Streaming\GetServerUrl;
use ReactPHPVK\Actions\Sections\Streaming\SetSettings;

class Streaming
{
    private Provider $_provider;

    private ?Streaming\GetServerUrl $getServerUrl = null;
    private ?Streaming\SetSettings $setSettings = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to receive data for the connection to Streaming API.
     */
    public function getServerUrl(): GetServerUrl
    {
        if (!$this->getServerUrl) {
            $this->getServerUrl = new GetServerUrl($this->_provider);
        }
        return $this->getServerUrl;
    }

    /**
     * 
     */
    public function setSettings(): SetSettings
    {
        if (!$this->setSettings) {
            $this->setSettings = new SetSettings($this->_provider);
        }
        return $this->setSettings;
    }

}