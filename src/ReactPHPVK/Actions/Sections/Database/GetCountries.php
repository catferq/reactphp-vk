<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of countries.
 */
class GetCountries
{
    private Provider $_provider;
    
    private bool $needAll = false;
    private string $code = '';
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
     * @return GetCountries
     */
    public function _setCustom(array $value): GetCountries
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * '1' — to return a full list of all countries, '0' — to return a list of countries near the current user's country (default).
     * 
     * @param bool $value
     * @return GetCountries
     */
    public function setNeedAll(bool $value): GetCountries
    {
        $this->needAll = $value;
        return $this;
    }

    /**
     * Country codes in [vk.com/dev/country_codes|ISO 3166-1 alpha-2] standard.
     * 
     * @param string $value
     * @return GetCountries
     */
    public function setCode(string $value): GetCountries
    {
        $this->code = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of countries.
     * 
     * @param int $value
     * @return GetCountries
     */
    public function setOffset(int $value): GetCountries
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of countries to return.
     * 
     * @param int $value
     * @return GetCountries
     */
    public function setCount(int $value): GetCountries
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

        if ($this->needAll !== false) $params['need_all'] = intval($this->needAll);
        if ($this->code !== '') $params['code'] = $this->code;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->needAll = false;
            $this->code = '';
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getCountries', $params);
    }
}