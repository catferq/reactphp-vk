<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to approve join request to the community.
 */
class ApproveRequest
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
     * @return ApproveRequest
     */
    public function _setCustom(array $value): ApproveRequest
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return ApproveRequest
     */
    public function setGroupId(int $value): ApproveRequest
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return ApproveRequest
     */
    public function setUserId(int $value): ApproveRequest
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

        return $this->_provider->request('groups.approveRequest', $params);
    }
}