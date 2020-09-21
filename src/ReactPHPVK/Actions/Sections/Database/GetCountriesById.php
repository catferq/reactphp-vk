<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about countries by their IDs.
 */
class GetCountriesById
{
    private Provider $_provider;
    
    private array $countryIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCountriesById
     */
    public function _setCustom(array $value): GetCountriesById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Country IDs.
     * 
     * @param array $value
     * @return GetCountriesById
     */
    public function setCountryIds(array $value): GetCountriesById
    {
        $this->countryIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->countryIds !== []) $params['country_ids'] = implode(',', $this->countryIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->countryIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('database.getCountriesById', $params);
    }
}