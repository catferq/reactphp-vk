<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of videos under the set search criterion.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private int $sort = 0;
    private int $hd = 0;
    private bool $adult = false;
    private array $filters = [];
    private bool $searchOwn = false;
    private int $offset = 0;
    private int $longer = 0;
    private int $shorter = 0;
    private int $count = 20;
    private bool $extended = false;
    
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
     * Search query string (e.g., 'The Beatles').
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
     * Sort order: '1' — by duration, '2' — by relevance, '0' — by date added
     * 
     * @param int $value
     * @return Search
     */
    public function setSort(int $value): Search
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * If not null, only searches for high-definition videos.
     * 
     * @param int $value
     * @return Search
     */
    public function setHd(int $value): Search
    {
        $this->hd = $value;
        return $this;
    }

    /**
     * '1' — to disable the Safe Search filter, '0' — to enable the Safe Search filter
     * 
     * @param bool $value
     * @return Search
     */
    public function setAdult(bool $value): Search
    {
        $this->adult = $value;
        return $this;
    }

    /**
     * Filters to apply: 'youtube' — return YouTube videos only, 'vimeo' — return Vimeo videos only, 'short' — return short videos only, 'long' — return long videos only
     * 
     * @param array $value
     * @return Search
     */
    public function setFilters(array $value): Search
    {
        $this->filters = $value;
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
     * Offset needed to return a specific subset of videos.
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
     * @param int $value
     * @return Search
     */
    public function setLonger(int $value): Search
    {
        $this->longer = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setShorter(int $value): Search
    {
        $this->shorter = $value;
        return $this;
    }

    /**
     * Number of videos to return.
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
     * @param bool $value
     * @return Search
     */
    public function setExtended(bool $value): Search
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['q'] = $this->q;
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->hd !== 0) $params['hd'] = $this->hd;
        if ($this->adult !== false) $params['adult'] = intval($this->adult);
        if ($this->filters !== []) $params['filters'] = implode(',', $this->filters);
        if ($this->searchOwn !== false) $params['search_own'] = intval($this->searchOwn);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->longer !== 0) $params['longer'] = $this->longer;
        if ($this->shorter !== 0) $params['shorter'] = $this->shorter;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->sort = 0;
            $this->hd = 0;
            $this->adult = false;
            $this->filters = [];
            $this->searchOwn = false;
            $this->offset = 0;
            $this->longer = 0;
            $this->shorter = 0;
            $this->count = 20;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('video.search', $params);
    }
}