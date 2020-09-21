<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetUserSubscriptionById
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $subscriptionId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetUserSubscriptionById
     */
    public function _setCustom(array $value): GetUserSubscriptionById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetUserSubscriptionById
     */
    public function setUserId(int $value): GetUserSubscriptionById
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetUserSubscriptionById
     */
    public function setSubscriptionId(int $value): GetUserSubscriptionById
    {
        $this->subscriptionId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->subscriptionId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('orders.getUserSubscriptionById', $params);
    }
}