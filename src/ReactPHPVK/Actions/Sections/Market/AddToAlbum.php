<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds an item to one or multiple collections.
 */
class AddToAlbum
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
     * @return AddToAlbum
     */
    public function _setCustom(array $value): AddToAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return AddToAlbum
     */
    public function setOwnerId(int $value): AddToAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return AddToAlbum
     */
    public function setItemId(int $value): AddToAlbum
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Collections IDs to add item to.
     * 
     * @param array $value
     * @return AddToAlbum
     */
    public function setAlbumIds(array $value): AddToAlbum
    {
        $this->albumIds = $value;
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
        $params['item_id'] = $this->itemId;
        $params['album_ids'] = implode(',', $this->albumIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->albumIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('market.addToAlbum', $params);
    }
}