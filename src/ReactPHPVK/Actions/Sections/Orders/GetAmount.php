<?php

namespace ReactPHPVK\Actions\Sections\Orders;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetAmount
{
    private Provider $_provider;
    
    private int $userId = 0;
    private array $votes = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAmount
     */
    public function _setCustom(array $value): GetAmount
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetAmount
     */
    public function setUserId(int $value): GetAmount
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetAmount
     */
    public function setVotes(array $value): GetAmount
    {
        $this->votes = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        $params['votes'] = implode(',', $this->votes);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->votes = [];
            $this->_custom = [];
        }

        return $this->_provider->request('orders.getAmount', $params);
    }
}