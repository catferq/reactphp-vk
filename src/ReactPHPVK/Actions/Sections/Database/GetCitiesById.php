<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about cities by their IDs.
 */
class GetCitiesById
{
    private Provider $_provider;
    
    private array $cityIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCitiesById
     */
    public function _setCustom(array $value): GetCitiesById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * City IDs.
     * 
     * @param array $value
     * @return GetCitiesById
     */
    public function setCityIds(array $value): GetCitiesById
    {
        $this->cityIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->cityIds !== []) $params['city_ids'] = implode(',', $this->cityIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->cityIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('database.getCitiesById', $params);
    }
}