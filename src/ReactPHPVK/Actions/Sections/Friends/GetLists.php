<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of the user's friend lists.
 */
class GetLists
{
    private Provider $_provider;
    
    private int $userId = 0;
    private bool $returnSystem = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLists
     */
    public function _setCustom(array $value): GetLists
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return GetLists
     */
    public function setUserId(int $value): GetLists
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * '1' — to return system friend lists. By default: '0'.
     * 
     * @param bool $value
     * @return GetLists
     */
    public function setReturnSystem(bool $value): GetLists
    {
        $this->returnSystem = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->returnSystem !== false) $params['return_system'] = intval($this->returnSystem);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->returnSystem = false;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getLists', $params);
    }
}