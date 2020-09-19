<?php

namespace ReactPHPVK\Actions\Sections\Gifts;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of user gifts.
 */
class Get
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $count = 0;
    private int $offset = 0;
    
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
     * User ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setUserId(int $value): Get
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Number of gifts to return.
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
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->count = 0;
            $this->offset = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('gifts.get', $params);
    }
}