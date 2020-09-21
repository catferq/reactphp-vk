<?php

namespace ReactPHPVK\Actions\Sections\Streaming;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to receive data for the connection to Streaming API.
 */
class GetServerUrl
{
    private Provider $_provider;
    
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetServerUrl
     */
    public function _setCustom(array $value): GetServerUrl
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->_custom = [];
        }

        return $this->_provider->request('streaming.getServerUrl', $params);
    }
}