<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of photos.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private float $lat = 0;
    private float $long = 0;
    private int $startTime = 0;
    private int $endTime = 0;
    private int $sort = 0;
    private int $offset = 0;
    private int $count = 100;
    private int $radius = 5000;
    
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
     * Geographical latitude, in degrees (from '-90' to '90').
     * 
     * @param float $value
     * @return Search
     */
    public function setLat(float $value): Search
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * Geographical longitude, in degrees (from '-180' to '180').
     * 
     * @param float $value
     * @return Search
     */
    public function setLong(float $value): Search
    {
        $this->long = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setStartTime(int $value): Search
    {
        $this->startTime = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setEndTime(int $value): Search
    {
        $this->endTime = $value;
        return $this;
    }

    /**
     * Sort order:
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
     * Offset needed to return a specific subset of photos.
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
     * Number of photos to return.
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
     * Radius of search in meters (works very approximately). Available values: '10', '100', '800', '6000', '50000'.
     * 
     * @param int $value
     * @return Search
     */
    public function setRadius(int $value): Search
    {
        $this->radius = $value;
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
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->radius !== 5000) $params['radius'] = $this->radius;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->lat = 0;
            $this->long = 0;
            $this->startTime = 0;
            $this->endTime = 0;
            $this->sort = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->radius = 5000;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.search', $params);
    }
}