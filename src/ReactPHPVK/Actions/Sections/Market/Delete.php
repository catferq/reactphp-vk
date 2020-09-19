<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes an item.
 */
class Delete
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $itemId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Delete
     */
    public function _setCustom(array $value): Delete
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return Delete
     */
    public function setOwnerId(int $value): Delete
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return Delete
     */
    public function setItemId(int $value): Delete
    {
        $this->itemId = $value;
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
        $params['item_id'] = $this->itemId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.delete', $params);
    }
}