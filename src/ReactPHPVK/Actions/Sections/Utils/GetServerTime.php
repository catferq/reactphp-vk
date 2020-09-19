<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the current time of the VK server.
 */
class GetServerTime
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
     * @return GetServerTime
     */
    public function _setCustom(array $value): GetServerTime
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->_custom = [];
        }

        return $this->_provider->request('utils.getServerTime', $params);
    }
}