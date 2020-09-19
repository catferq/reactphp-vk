<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class RemoveProduct
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $id = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveProduct
     */
    public function _setCustom(array $value): RemoveProduct
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveProduct
     */
    public function setOwnerId(int $value): RemoveProduct
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveProduct
     */
    public function setId(int $value): RemoveProduct
    {
        $this->id = $value;
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
        $params['id'] = $this->id;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->id = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('fave.removeProduct', $params);
    }
}