<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of user IDs or detailed information about a user's friends.
 */
class Get
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $order = '';
    private int $listId = 0;
    private int $count = 5000;
    private int $offset = 0;
    private array $fields = [];
    private string $nameCase = '';
    private string $ref = '';
    
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
     * User ID. By default, the current user ID.
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
     * Sort order: , 'name' — by name (enabled only if the 'fields' parameter is used), 'hints' — by rating, similar to how friends are sorted in My friends section, , This parameter is available only for [vk.com/dev/standalone|desktop applications].
     * 
     * @param string $value
     * @return Get
     */
    public function setOrder(string $value): Get
    {
        $this->order = $value;
        return $this;
    }

    /**
     * ID of the friend list returned by the [vk.com/dev/friends.getLists|friends.getLists] method to be used as the source. This parameter is taken into account only when the uid parameter is set to the current user ID. This parameter is available only for [vk.com/dev/standalone|desktop applications].
     * 
     * @param int $value
     * @return Get
     */
    public function setListId(int $value): Get
    {
        $this->listId = $value;
        return $this;
    }

    /**
     * Number of friends to return.
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
     * Offset needed to return a specific subset of friends.
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
     * Profile fields to return. Sample values: 'uid', 'first_name', 'last_name', 'nickname', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'domain', 'has_mobile', 'rate', 'contacts', 'education'.
     * 
     * @param array $value
     * @return Get
     */
    public function setFields(array $value): Get
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * 
     * @param string $value
     * @return Get
     */
    public function setNameCase(string $value): Get
    {
        $this->nameCase = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Get
     */
    public function setRef(string $value): Get
    {
        $this->ref = $value;
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
        if ($this->order !== '') $params['order'] = $this->order;
        if ($this->listId !== 0) $params['list_id'] = $this->listId;
        if ($this->count !== 5000) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->ref !== '') $params['ref'] = $this->ref;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->order = '';
            $this->listId = 0;
            $this->count = 5000;
            $this->offset = 0;
            $this->fields = [];
            $this->nameCase = '';
            $this->ref = '';
            $this->_custom = [];
        }

        return $this->_provider->request('friends.get', $params);
    }
}