<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of documents matching the search criteria.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private bool $searchOwn = false;
    private int $count = 20;
    private int $offset = 0;
    private bool $returnTags = false;
    
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
     * Search query string.
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
     * @param bool $value
     * @return Search
     */
    public function setSearchOwn(bool $value): Search
    {
        $this->searchOwn = $value;
        return $this;
    }

    /**
     * Number of results to return.
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
     * Offset needed to return a specific subset of results.
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
     * @param bool $value
     * @return Search
     */
    public function setReturnTags(bool $value): Search
    {
        $this->returnTags = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['q'] = $this->q;
        if ($this->searchOwn !== false) $params['search_own'] = intval($this->searchOwn);
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->returnTags !== false) $params['return_tags'] = intval($this->returnTags);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->searchOwn = false;
            $this->count = 20;
            $this->offset = 0;
            $this->returnTags = false;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.search', $params);
    }
}