<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information specifying whether a user is a member of a community.
 */
class IsMember
{
    private Provider $_provider;
    
    private string $groupId = '';
    private int $userId = 0;
    private array $userIds = [];
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return IsMember
     */
    public function _setCustom(array $value): IsMember
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID or screen name of the community.
     * 
     * @param string $value
     * @return IsMember
     */
    public function setGroupId(string $value): IsMember
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return IsMember
     */
    public function setUserId(int $value): IsMember
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * User IDs.
     * 
     * @param array $value
     * @return IsMember
     */
    public function setUserIds(array $value): IsMember
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * '1' — to return an extended response with additional fields. By default: '0'.
     * 
     * @param bool $value
     * @return IsMember
     */
    public function setExtended(bool $value): IsMember
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = '';
            $this->userId = 0;
            $this->userIds = [];
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.isMember', $params);
    }
}