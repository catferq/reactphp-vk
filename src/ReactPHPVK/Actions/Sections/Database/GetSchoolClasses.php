<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of school classes specified for the country.
 */
class GetSchoolClasses
{
    private Provider $_provider;
    
    private int $countryId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetSchoolClasses
     */
    public function _setCustom(array $value): GetSchoolClasses
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Country ID.
     * 
     * @param int $value
     * @return GetSchoolClasses
     */
    public function setCountryId(int $value): GetSchoolClasses
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->countryId !== 0) $params['country_id'] = $this->countryId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->countryId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getSchoolClasses', $params);
    }
}