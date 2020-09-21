<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reorders the collections list.
 */
class ReorderAlbums
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
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
     * @return ReorderAlbums
     */
    public function _setCustom(array $value): ReorderAlbums
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return ReorderAlbums
     */
    public function setOwnerId(int $value): ReorderAlbums
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Collection ID.
     * 
     * @param int $value
     * @return ReorderAlbums
     */
    public function setAlbumId(int $value): ReorderAlbums
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * ID of a collection to place current collection before it.
     * 
     * @param int $value
     * @return ReorderAlbums
     */
    public function setBefore(int $value): ReorderAlbums
    {
        $this->before = $value;
        return $this;
    }

    /**
     * ID of a collection to place current collection after it.
     * 
     * @param int $value
     * @return ReorderAlbums
     */
    public function setAfter(int $value): ReorderAlbums
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
        $params['album_id'] = $this->albumId;
        if ($this->before !== 0) $params['before'] = $this->before;
        if ($this->after !== 0) $params['after'] = $this->after;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->before = 0;
            $this->after = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.reorderAlbums', $params);
    }
}