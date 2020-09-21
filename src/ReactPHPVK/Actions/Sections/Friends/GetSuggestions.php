<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of profiles of users whom the current user may know.
 */
class GetSuggestions
{
    private Provider $_provider;
    
    private array $filter = [];
    private int $count = 500;
    private int $offset = 0;
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
     * @return GetSuggestions
     */
    public function _setCustom(array $value): GetSuggestions
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Types of potential friends to return: 'mutual' — users with many mutual friends , 'contacts' — users found with the [vk.com/dev/account.importContacts|account.importContacts] method , 'mutual_contacts' — users who imported the same contacts as the current user with the [vk.com/dev/account.importContacts|account.importContacts] method
     * 
     * @param array $value
     * @return GetSuggestions
     */
    public function setFilter(array $value): GetSuggestions
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * Number of suggestions to return.
     * 
     * @param int $value
     * @return GetSuggestions
     */
    public function setCount(int $value): GetSuggestions
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of suggestions.
     * 
     * @param int $value
     * @return GetSuggestions
     */
    public function setOffset(int $value): GetSuggestions
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online', 'counters'.
     * 
     * @param array $value
     * @return GetSuggestions
     */
    public function setFields(array $value): GetSuggestions
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * 
     * @param string $value
     * @return GetSuggestions
     */
    public function setNameCase(string $value): GetSuggestions
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

        if ($this->filter !== []) $params['filter'] = implode(',', $this->filter);
        if ($this->count !== 500) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->filter = [];
            $this->count = 500;
            $this->offset = 0;
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getSuggestions', $params);
    }
}