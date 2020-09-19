<?php

namespace ReactPHPVK\Actions\Sections\PrettyCards;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Get
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $offset = 0;
    private int $count = 10;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setOwnerId(int $value): Get
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setCount(int $value): Get
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

        $params['owner_id'] = $this->ownerId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 10) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->offset = 0;
            $this->count = 10;
            $this->_custom = [];
        }

        return $this->_provider->request('prettyCards.get', $params);
    }
}