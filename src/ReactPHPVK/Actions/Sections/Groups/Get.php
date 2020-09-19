<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of the communities to which a user belongs.
 */
class Get
{
    private Provider $_provider;
    
    private int $userId = 0;
    private bool $extended = false;
    private array $filter = [];
    private array $fields = [];
    private int $offset = 0;
    private int $count = 0;
    
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
     * User ID.
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
     * '1' — to return complete information about a user's communities, '0' — to return a list of community IDs without any additional fields (default),
     * 
     * @param bool $value
     * @return Get
     */
    public function setExtended(bool $value): Get
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Types of communities to return: 'admin' — to return communities administered by the user , 'editor' — to return communities where the user is an administrator or editor, 'moder' — to return communities where the user is an administrator, editor, or moderator, 'groups' — to return only groups, 'publics' — to return only public pages, 'events' — to return only events
     * 
     * @param array $value
     * @return Get
     */
    public function setFilter(array $value): Get
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * Profile fields to return.
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
     * Offset needed to return a specific subset of communities.
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
     * Number of communities to return.
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->filter !== []) $params['filter'] = implode(',', $this->filter);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->extended = false;
            $this->filter = [];
            $this->fields = [];
            $this->offset = 0;
            $this->count = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.get', $params);
    }
}