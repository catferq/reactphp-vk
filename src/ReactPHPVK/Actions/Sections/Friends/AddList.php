<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a new friend list for the current user.
 */
class AddList
{
    private Provider $_provider;
    
    private string $name = '';
    private array $userIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddList
     */
    public function _setCustom(array $value): AddList
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Name of the friend list.
     * 
     * @param string $value
     * @return AddList
     */
    public function setName(string $value): AddList
    {
        $this->name = $value;
        return $this;
    }

    /**
     * IDs of users to be added to the friend list.
     * 
     * @param array $value
     * @return AddList
     */
    public function setUserIds(array $value): AddList
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['name'] = $this->name;
        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->name = '';
            $this->userIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('friends.addList', $params);
    }
}