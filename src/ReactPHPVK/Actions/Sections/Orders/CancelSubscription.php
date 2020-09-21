<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class CancelSubscription
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $subscriptionId = 0;
    private bool $pendingCancel = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CancelSubscription
     */
    public function _setCustom(array $value): CancelSubscription
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CancelSubscription
     */
    public function setUserId(int $value): CancelSubscription
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CancelSubscription
     */
    public function setSubscriptionId(int $value): CancelSubscription
    {
        $this->subscriptionId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return CancelSubscription
     */
    public function setPendingCancel(bool $value): CancelSubscription
    {
        $this->pendingCancel = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        $params['subscription_id'] = $this->subscriptionId;
        if ($this->pendingCancel !== false) $params['pending_cancel'] = intval($this->pendingCancel);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->subscriptionId = 0;
            $this->pendingCancel = false;
            $this->_custom = [];
        }

        return $this->_provider->request('orders.cancelSubscription', $params);
    }
}