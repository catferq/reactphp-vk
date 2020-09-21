<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class UpdateSubscription
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $subscriptionId = 0;
    private int $price = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return UpdateSubscription
     */
    public function _setCustom(array $value): UpdateSubscription
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return UpdateSubscription
     */
    public function setUserId(int $value): UpdateSubscription
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return UpdateSubscription
     */
    public function setSubscriptionId(int $value): UpdateSubscription
    {
        $this->subscriptionId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return UpdateSubscription
     */
    public function setPrice(int $value): UpdateSubscription
    {
        $this->price = $value;
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
        $params['price'] = $this->price;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->subscriptionId = 0;
            $this->price = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('orders.updateSubscription', $params);
    }
}