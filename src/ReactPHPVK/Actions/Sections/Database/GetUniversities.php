<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of higher education institutions.
 */
class GetUniversities
{
    private Provider $_provider;
    
    private string $q = '';
    private int $countryId = 0;
    private int $cityId = 0;
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
     * @return GetUniversities
     */
    public function _setCustom(array $value): GetUniversities
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query.
     * 
     * @param string $value
     * @return GetUniversities
     */
    public function setQ(string $value): GetUniversities
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Country ID.
     * 
     * @param int $value
     * @return GetUniversities
     */
    public function setCountryId(int $value): GetUniversities
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * City ID.
     * 
     * @param int $value
     * @return GetUniversities
     */
    public function setCityId(int $value): GetUniversities
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of universities.
     * 
     * @param int $value
     * @return GetUniversities
     */
    public function setOffset(int $value): GetUniversities
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of universities to return.
     * 
     * @param int $value
     * @return GetUniversities
     */
    public function setCount(int $value): GetUniversities
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

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->countryId !== 0) $params['country_id'] = $this->countryId;
        if ($this->cityId !== 0) $params['city_id'] = $this->cityId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->countryId = 0;
            $this->cityId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getUniversities', $params);
    }
}