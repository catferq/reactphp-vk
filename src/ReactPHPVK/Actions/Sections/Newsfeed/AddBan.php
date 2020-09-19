<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Prevents news from specified users and communities from appearing in the current user's newsfeed.
 */
class AddBan
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
     * @return AddBan
     */
    public function _setCustom(array $value): AddBan
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return AddBan
     */
    public function setUserIds(array $value): AddBan
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return AddBan
     */
    public function setGroupIds(array $value): AddBan
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

        return $this->_provider->request('newsfeed.addBan', $params);
    }
}