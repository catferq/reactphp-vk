<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Removes a user from the community.
 */
class RemoveUser
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveUser
     */
    public function _setCustom(array $value): RemoveUser
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return RemoveUser
     */
    public function setGroupId(int $value): RemoveUser
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return RemoveUser
     */
    public function setUserId(int $value): RemoveUser
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.removeUser', $params);
    }
}