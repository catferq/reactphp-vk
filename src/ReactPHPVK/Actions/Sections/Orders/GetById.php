<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about orders by their IDs.
 */
class GetById
{
    private Provider $_provider;
    
    private int $orderId = 0;
    private array $orderIds = [];
    private bool $testMode = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * order ID.
     * 
     * @param int $value
     * @return GetById
     */
    public function setOrderId(int $value): GetById
    {
        $this->orderId = $value;
        return $this;
    }

    /**
     * order IDs (when information about several orders is requested).
     * 
     * @param array $value
     * @return GetById
     */
    public function setOrderIds(array $value): GetById
    {
        $this->orderIds = $value;
        return $this;
    }

    /**
     * if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
     * 
     * @param bool $value
     * @return GetById
     */
    public function setTestMode(bool $value): GetById
    {
        $this->testMode = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->orderId !== 0) $params['order_id'] = $this->orderId;
        if ($this->orderIds !== []) $params['order_ids'] = implode(',', $this->orderIds);
        if ($this->testMode !== false) $params['test_mode'] = intval($this->testMode);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->orderId = 0;
            $this->orderIds = [];
            $this->testMode = false;
            $this->_custom = [];
        }

        return $this->_provider->request('orders.getById', $params);
    }
}