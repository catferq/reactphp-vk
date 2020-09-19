<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores recently deleted item
 */
class Restore
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
     * @return Restore
     */
    public function _setCustom(array $value): Restore
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return Restore
     */
    public function setOwnerId(int $value): Restore
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Deleted item ID.
     * 
     * @param int $value
     * @return Restore
     */
    public function setItemId(int $value): Restore
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

        return $this->_provider->request('market.restore', $params);
    }
}