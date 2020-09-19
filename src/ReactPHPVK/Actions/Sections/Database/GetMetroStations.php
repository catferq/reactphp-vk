<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Get metro stations by city
 */
class GetMetroStations
{
    private Provider $_provider;
    
    private int $cityId = 0;
    private int $offset = 0;
    private int $count = 100;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMetroStations
     */
    public function _setCustom(array $value): GetMetroStations
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetMetroStations
     */
    public function setCityId(int $value): GetMetroStations
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetMetroStations
     */
    public function setOffset(int $value): GetMetroStations
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetMetroStations
     */
    public function setCount(int $value): GetMetroStations
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetMetroStations
     */
    public function setExtended(bool $value): GetMetroStations
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['city_id'] = $this->cityId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->cityId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getMetroStations', $params);
    }
}