<?php

namespace ReactPHPVK\Actions\Sections\Search;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows the programmer to do a quick search for any substring.
 */
class GetHints
{
    private Provider $_provider;
    
    private string $q = '';
    private int $offset = 0;
    private int $limit = 9;
    private array $filters = [];
    private array $fields = [];
    private bool $searchGlobal = true;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetHints
     */
    public function _setCustom(array $value): GetHints
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query string.
     * 
     * @param string $value
     * @return GetHints
     */
    public function setQ(string $value): GetHints
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Offset for querying specific result subset
     * 
     * @param int $value
     * @return GetHints
     */
    public function setOffset(int $value): GetHints
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Maximum number of results to return.
     * 
     * @param int $value
     * @return GetHints
     */
    public function setLimit(int $value): GetHints
    {
        $this->limit = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetHints
     */
    public function setFilters(array $value): GetHints
    {
        $this->filters = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetHints
     */
    public function setFields(array $value): GetHints
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetHints
     */
    public function setSearchGlobal(bool $value): GetHints
    {
        $this->searchGlobal = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->limit !== 9) $params['limit'] = $this->limit;
        if ($this->filters !== []) $params['filters'] = implode(',', $this->filters);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->searchGlobal !== true) $params['search_global'] = intval($this->searchGlobal);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->offset = 0;
            $this->limit = 9;
            $this->filters = [];
            $this->fields = [];
            $this->searchGlobal = true;
            $this->_custom = [];
        }

        return $this->_provider->request('search.getHints', $params);
    }
}