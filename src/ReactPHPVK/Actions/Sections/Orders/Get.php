<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of orders.
 */
class Get
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 100;
    private bool $testMode = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * number of returned orders.
     * 
     * @param int $value
     * @return Get
     */
    public function setCount(int $value): Get
    {
        $this->count = $value;
        return $this;
    }

    /**
     * if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
     * 
     * @param bool $value
     * @return Get
     */
    public function setTestMode(bool $value): Get
    {
        $this->testMode = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->testMode !== false) $params['test_mode'] = intval($this->testMode);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 100;
            $this->testMode = false;
            $this->_custom = [];
        }

        return $this->_provider->request('orders.get', $params);
    }
}