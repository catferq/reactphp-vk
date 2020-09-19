<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Removes an item from one or multiple collections.
 */
class RemoveFromAlbum
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $itemId = 0;
    private array $albumIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveFromAlbum
     */
    public function _setCustom(array $value): RemoveFromAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return RemoveFromAlbum
     */
    public function setOwnerId(int $value): RemoveFromAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return RemoveFromAlbum
     */
    public function setItemId(int $value): RemoveFromAlbum
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Collections IDs to remove item from.
     * 
     * @param array $value
     * @return RemoveFromAlbum
     */
    public function setAlbumIds(array $value): RemoveFromAlbum
    {
        $this->albumIds = $value;
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
        $params['album_ids'] = implode(',', $this->albumIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->albumIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('market.removeFromAlbum', $params);
    }
}