<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows news from previously banned users and communities to be shown in the current user's newsfeed.
 */
class DeleteBan
{
    private Provider $_provider;
    
    private array $userIds = [];
    private array $groupIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteBan
     */
    public function _setCustom(array $value): DeleteBan
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return DeleteBan
     */
    public function setUserIds(array $value): DeleteBan
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return DeleteBan
     */
    public function setGroupIds(array $value): DeleteBan
    {
        $this->groupIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->groupIds !== []) $params['group_ids'] = implode(',', $this->groupIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->groupIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.deleteBan', $params);
    }
}