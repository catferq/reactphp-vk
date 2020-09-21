<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Changes item place in a collection.
 */
class ReorderItems
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
    private int $itemId = 0;
    private int $before = 0;
    private int $after = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ReorderItems
     */
    public function _setCustom(array $value): ReorderItems
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return ReorderItems
     */
    public function setOwnerId(int $value): ReorderItems
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * ID of a collection to reorder items in. Set 0 to reorder full items list.
     * 
     * @param int $value
     * @return ReorderItems
     */
    public function setAlbumId(int $value): ReorderItems
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return ReorderItems
     */
    public function setItemId(int $value): ReorderItems
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * ID of an item to place current item before it.
     * 
     * @param int $value
     * @return ReorderItems
     */
    public function setBefore(int $value): ReorderItems
    {
        $this->before = $value;
        return $this;
    }

    /**
     * ID of an item to place current item after it.
     * 
     * @param int $value
     * @return ReorderItems
     */
    public function setAfter(int $value): ReorderItems
    {
        $this->after = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        $params['item_id'] = $this->itemId;
        if ($this->before !== 0) $params['before'] = $this->before;
        if ($this->after !== 0) $params['after'] = $this->after;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->itemId = 0;
            $this->before = 0;
            $this->after = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.reorderItems', $params);
    }
}