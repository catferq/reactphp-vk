<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of schools.
 */
class GetSchools
{
    private Provider $_provider;
    
    private string $q = '';
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
     * @return GetSchools
     */
    public function _setCustom(array $value): GetSchools
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query.
     * 
     * @param string $value
     * @return GetSchools
     */
    public function setQ(string $value): GetSchools
    {
        $this->q = $value;
        return $this;
    }

    /**
     * City ID.
     * 
     * @param int $value
     * @return GetSchools
     */
    public function setCityId(int $value): GetSchools
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of schools.
     * 
     * @param int $value
     * @return GetSchools
     */
    public function setOffset(int $value): GetSchools
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of schools to return.
     * 
     * @param int $value
     * @return GetSchools
     */
    public function setCount(int $value): GetSchools
    {
        $this->count = $value;
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
        $params['city_id'] = $this->cityId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->cityId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getSchools', $params);
    }
}