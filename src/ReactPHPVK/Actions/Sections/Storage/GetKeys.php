<?php

namespace ReactPHPVK\Actions\Sections\Storage;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the names of all variables.
 */
class GetKeys
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $offset = 0;
    private int $count = 100;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetKeys
     */
    public function _setCustom(array $value): GetKeys
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * user id, whose variables names are returned if they were requested with a server method.
     * 
     * @param int $value
     * @return GetKeys
     */
    public function setUserId(int $value): GetKeys
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetKeys
     */
    public function setOffset(int $value): GetKeys
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * amount of variable names the info needs to be collected from.
     * 
     * @param int $value
     * @return GetKeys
     */
    public function setCount(int $value): GetKeys
    {
        $this->count = $value;
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
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('storage.getKeys', $params);
    }
}