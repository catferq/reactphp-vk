<?php

namespace ReactPHPVK\Actions\Sections\Status;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns data required to show the status of a user or community.
 */
class Get
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $groupId = 0;
    
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
     * User ID or community ID. Use a negative value to designate a community ID.
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
     * @param int $value
     * @return Get
     */
    public function setGroupId(int $value): Get
    {
        $this->groupId = $value;
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
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('status.get', $params);
    }
}