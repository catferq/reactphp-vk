<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to search posts on user or community walls.
 */
class Search
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $domain = '';
    private string $query = '';
    private bool $ownersOnly = false;
    private int $count = 20;
    private int $offset = 0;
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
     * @return Search
     */
    public function _setCustom(array $value): Search
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * user or community id. "Remember that for a community 'owner_id' must be negative."
     * 
     * @param int $value
     * @return Search
     */
    public function setOwnerId(int $value): Search
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * user or community screen name.
     * 
     * @param string $value
     * @return Search
     */
    public function setDomain(string $value): Search
    {
        $this->domain = $value;
        return $this;
    }

    /**
     * search query string.
     * 
     * @param string $value
     * @return Search
     */
    public function setQuery(string $value): Search
    {
        $this->query = $value;
        return $this;
    }

    /**
     * '1' – returns only page owner's posts.
     * 
     * @param bool $value
     * @return Search
     */
    public function setOwnersOnly(bool $value): Search
    {
        $this->ownersOnly = $value;
        return $this;
    }

    /**
     * count of posts to return.
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
     * Offset needed to return a specific subset of posts.
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
     * show extended post info.
     * 
     * @param bool $value
     * @return Search
     */
    public function setExtended(bool $value): Search
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Search
     */
    public function setFields(array $value): Search
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->domain !== '') $params['domain'] = $this->domain;
        if ($this->query !== '') $params['query'] = $this->query;
        if ($this->ownersOnly !== false) $params['owners_only'] = intval($this->ownersOnly);
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->domain = '';
            $this->query = '';
            $this->ownersOnly = false;
            $this->count = 20;
            $this->offset = 0;
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('wall.search', $params);
    }
}