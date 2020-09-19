<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Changes order status.
 */
class ChangeState
{
    private Provider $_provider;
    
    private int $orderId = 0;
    private string $action = '';
    private int $appOrderId = 0;
    private bool $testMode = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ChangeState
     */
    public function _setCustom(array $value): ChangeState
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * order ID.
     * 
     * @param int $value
     * @return ChangeState
     */
    public function setOrderId(int $value): ChangeState
    {
        $this->orderId = $value;
        return $this;
    }

    /**
     * action to be done with the order. Available actions: *cancel — to cancel unconfirmed order. *charge — to confirm unconfirmed order. Applies only if processing of [vk.com/dev/payments_status|order_change_state] notification failed. *refund — to cancel confirmed order.
     * 
     * @param string $value
     * @return ChangeState
     */
    public function setAction(string $value): ChangeState
    {
        $this->action = $value;
        return $this;
    }

    /**
     * internal ID of the order in the application.
     * 
     * @param int $value
     * @return ChangeState
     */
    public function setAppOrderId(int $value): ChangeState
    {
        $this->appOrderId = $value;
        return $this;
    }

    /**
     * if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
     * 
     * @param bool $value
     * @return ChangeState
     */
    public function setTestMode(bool $value): ChangeState
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

        $params['order_id'] = $this->orderId;
        $params['action'] = $this->action;
        if ($this->appOrderId !== 0) $params['app_order_id'] = $this->appOrderId;
        if ($this->testMode !== false) $params['test_mode'] = intval($this->testMode);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->orderId = 0;
            $this->action = '';
            $this->appOrderId = 0;
            $this->testMode = false;
            $this->_custom = [];
        }

        return $this->_provider->request('orders.changeState', $params);
    }
}