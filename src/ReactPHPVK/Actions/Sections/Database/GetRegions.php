<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of regions.
 */
class GetRegions
{
    private Provider $_provider;
    
    private int $countryId = 0;
    private string $q = '';
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
     * @return GetRegions
     */
    public function _setCustom(array $value): GetRegions
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Country ID, received in [vk.com/dev/database.getCountries|database.getCountries] method.
     * 
     * @param int $value
     * @return GetRegions
     */
    public function setCountryId(int $value): GetRegions
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * Search query.
     * 
     * @param string $value
     * @return GetRegions
     */
    public function setQ(string $value): GetRegions
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Offset needed to return specific subset of regions.
     * 
     * @param int $value
     * @return GetRegions
     */
    public function setOffset(int $value): GetRegions
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of regions to return.
     * 
     * @param int $value
     * @return GetRegions
     */
    public function setCount(int $value): GetRegions
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
        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->countryId = 0;
            $this->q = '';
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getRegions', $params);
    }
}