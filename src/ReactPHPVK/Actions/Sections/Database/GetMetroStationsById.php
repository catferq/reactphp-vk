<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Get metro station by his id
 */
class GetMetroStationsById
{
    private Provider $_provider;
    
    private array $stationIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMetroStationsById
     */
    public function _setCustom(array $value): GetMetroStationsById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetMetroStationsById
     */
    public function setStationIds(array $value): GetMetroStationsById
    {
        $this->stationIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->stationIds !== []) $params['station_ids'] = implode(',', $this->stationIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->stationIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('database.getMetroStationsById', $params);
    }
}