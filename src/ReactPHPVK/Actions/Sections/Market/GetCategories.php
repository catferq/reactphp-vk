<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of market categories.
 */
class GetCategories
{
    private Provider $_provider;
    
    private int $count = 10;
    private int $offset = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCategories
     */
    public function _setCustom(array $value): GetCategories
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Number of results to return.
     * 
     * @param int $value
     * @return GetCategories
     */
    public function setCount(int $value): GetCategories
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return GetCategories
     */
    public function setOffset(int $value): GetCategories
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->count !== 10) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->count = 10;
            $this->offset = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.getCategories', $params);
    }
}