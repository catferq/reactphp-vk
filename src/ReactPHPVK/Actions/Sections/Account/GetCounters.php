<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns non-null values of user counters.
 */
class GetCounters
{
    private Provider $_provider;
    
    private array $filter = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCounters
     */
    public function _setCustom(array $value): GetCounters
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Counters to be returned.
     * 
     * @param array $value
     * @return GetCounters
     */
    public function setFilter(array $value): GetCounters
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->filter !== []) $params['filter'] = implode(',', $this->filter);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->filter = [];
            $this->_custom = [];
        }

        return $this->_provider->request('account.getCounters', $params);
    }
}