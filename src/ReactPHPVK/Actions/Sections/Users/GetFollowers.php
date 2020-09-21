<?php

namespace ReactPHPVK\Actions\Sections\Users;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of IDs of followers of the user in question, sorted by date added, most recent first.
 */
class GetFollowers
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $offset = 0;
    private int $count = 100;
    private array $fields = [];
    private string $nameCase = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetFollowers
     */
    public function _setCustom(array $value): GetFollowers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return GetFollowers
     */
    public function setUserId(int $value): GetFollowers
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of followers.
     * 
     * @param int $value
     * @return GetFollowers
     */
    public function setOffset(int $value): GetFollowers
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of followers to return.
     * 
     * @param int $value
     * @return GetFollowers
     */
    public function setCount(int $value): GetFollowers
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online'.
     * 
     * @param array $value
     * @return GetFollowers
     */
    public function setFields(array $value): GetFollowers
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * 
     * @param string $value
     * @return GetFollowers
     */
    public function setNameCase(string $value): GetFollowers
    {
        $this->nameCase = $value;
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
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('users.getFollowers', $params);
    }
}