<?php

namespace ReactPHPVK\Actions\Sections\Users;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns detailed information on users.
 */
class Get
{
    private Provider $_provider;
    
    private array $userIds = [];
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
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User IDs or screen names ('screen_name'). By default, current user ID.
     * 
     * @param array $value
     * @return Get
     */
    public function setUserIds(array $value): Get
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', 'can_invite_to_chats'
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
     * Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('users.get', $params);
    }
}