<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of the current user's conversations that match search criteria.
 */
class SearchConversations
{
    private Provider $_provider;
    
    private string $q = '';
    private int $count = 20;
    private bool $extended = false;
    private array $fields = [];
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SearchConversations
     */
    public function _setCustom(array $value): SearchConversations
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query string.
     * 
     * @param string $value
     * @return SearchConversations
     */
    public function setQ(string $value): SearchConversations
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Maximum number of results.
     * 
     * @param int $value
     * @return SearchConversations
     */
    public function setCount(int $value): SearchConversations
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — return extra information about users and communities
     * 
     * @param bool $value
     * @return SearchConversations
     */
    public function setExtended(bool $value): SearchConversations
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return SearchConversations
     */
    public function setFields(array $value): SearchConversations
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return SearchConversations
     */
    public function setGroupId(int $value): SearchConversations
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->count = 20;
            $this->extended = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.searchConversations', $params);
    }
}