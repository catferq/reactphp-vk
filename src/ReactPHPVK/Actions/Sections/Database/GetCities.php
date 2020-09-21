<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of cities.
 */
class GetCities
{
    private Provider $_provider;
    
    private int $countryId = 0;
    private int $regionId = 0;
    private string $q = '';
    private bool $needAll = false;
    private int $offset = 0;
    private int $count = 100;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCities
     */
    public function _setCustom(array $value): GetCities
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Country ID.
     * 
     * @param int $value
     * @return GetCities
     */
    public function setCountryId(int $value): GetCities
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * Region ID.
     * 
     * @param int $value
     * @return GetCities
     */
    public function setRegionId(int $value): GetCities
    {
        $this->regionId = $value;
        return $this;
    }

    /**
     * Search query.
     * 
     * @param string $value
     * @return GetCities
     */
    public function setQ(string $value): GetCities
    {
        $this->q = $value;
        return $this;
    }

    /**
     * '1' — to return all cities in the country, '0' — to return major cities in the country (default),
     * 
     * @param bool $value
     * @return GetCities
     */
    public function setNeedAll(bool $value): GetCities
    {
        $this->needAll = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of cities.
     * 
     * @param int $value
     * @return GetCities
     */
    public function setOffset(int $value): GetCities
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of cities to return.
     * 
     * @param int $value
     * @return GetCities
     */
    public function setCount(int $value): GetCities
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['country_id'] = $this->countryId;
        if ($this->regionId !== 0) $params['region_id'] = $this->regionId;
        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->needAll !== false) $params['need_all'] = intval($this->needAll);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->countryId = 0;
            $this->regionId = 0;
            $this->q = '';
            $this->needAll = false;
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getCities', $params);
    }
}