<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of friends matching the search criteria.
 */
class Search
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $q = '';
    private array $fields = [];
    private string $nameCase = 'Nom';
    private int $offset = 0;
    private int $count = 20;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Search
     */
    public function _setCustom(array $value): Search
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return Search
     */
    public function setUserId(int $value): Search
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Search query string (e.g., 'Vasya Babich').
     * 
     * @param string $value
     * @return Search
     */
    public function setQ(string $value): Search
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online',
     * 
     * @param array $value
     * @return Search
     */
    public function setFields(array $value): Search
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * 
     * @param string $value
     * @return Search
     */
    public function setNameCase(string $value): Search
    {
        $this->nameCase = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of friends.
     * 
     * @param int $value
     * @return Search
     */
    public function setOffset(int $value): Search
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of friends to return.
     * 
     * @param int $value
     * @return Search
     */
    public function setCount(int $value): Search
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== 'Nom') $params['name_case'] = $this->nameCase;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->q = '';
            $this->fields = [];
            $this->nameCase = 'Nom';
            $this->offset = 0;
            $this->count = 20;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.search', $params);
    }
}