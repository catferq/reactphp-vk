<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns search results by statuses.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private bool $extended = false;
    private int $count = 30;
    private float $latitude = 0;
    private float $longitude = 0;
    private int $startTime = 0;
    private int $endTime = 0;
    private string $startFrom = '';
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
     * Search query string (e.g., 'New Year').
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
     * '1' — to return additional information about the user or community that placed the post.
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
     * Number of posts to return.
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
     * Geographical latitude point (in degrees, -90 to 90) within which to search.
     * 
     * @param float $value
     * @return Search
     */
    public function setLatitude(float $value): Search
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * Geographical longitude point (in degrees, -180 to 180) within which to search.
     * 
     * @param float $value
     * @return Search
     */
    public function setLongitude(float $value): Search
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * 
     * @param int $value
     * @return Search
     */
    public function setStartTime(int $value): Search
    {
        $this->startTime = $value;
        return $this;
    }

    /**
     * Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * 
     * @param int $value
     * @return Search
     */
    public function setEndTime(int $value): Search
    {
        $this->endTime = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Search
     */
    public function setStartFrom(string $value): Search
    {
        $this->startFrom = $value;
        return $this;
    }

    /**
     * Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->count !== 30) $params['count'] = $this->count;
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->startFrom !== '') $params['start_from'] = $this->startFrom;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->extended = false;
            $this->count = 30;
            $this->latitude = 0;
            $this->longitude = 0;
            $this->startTime = 0;
            $this->endTime = 0;
            $this->startFrom = '';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.search', $params);
    }
}