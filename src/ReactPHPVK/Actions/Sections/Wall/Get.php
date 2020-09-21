<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of posts on a user wall or community wall.
 */
class Get
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $domain = '';
    private int $offset = 0;
    private int $count = 0;
    private string $filter = '';
    private bool $extended = false;
    private array $fields = [];
    
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
     * ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setOwnerId(int $value): Get
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * User or community short address.
     * 
     * @param string $value
     * @return Get
     */
    public function setDomain(string $value): Get
    {
        $this->domain = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of posts.
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
     * Number of posts to return (maximum 100).
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
     * Filter to apply: 'owner' — posts by the wall owner, 'others' — posts by someone else, 'all' — posts by the wall owner and others (default), 'postponed' — timed posts (only available for calls with an 'access_token'), 'suggests' — suggested posts on a community wall
     * 
     * @param string $value
     * @return Get
     */
    public function setFilter(string $value): Get
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * '1' — to return 'wall', 'profiles', and 'groups' fields, '0' — to return no additional fields (default)
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
     * @param array $value
     * @return Get
     */
    public function setFields(array $value): Get
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->domain !== '') $params['domain'] = $this->domain;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->filter !== '') $params['filter'] = $this->filter;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->domain = '';
            $this->offset = 0;
            $this->count = 0;
            $this->filter = '';
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('wall.get', $params);
    }
}