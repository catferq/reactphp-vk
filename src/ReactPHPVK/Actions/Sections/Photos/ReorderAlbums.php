<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reorders the album in the list of user albums.
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
     * ID of the user or community that owns the album.
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
     * Album ID.
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
     * ID of the album before which the album in question shall be placed.
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
     * ID of the album after which the album in question shall be placed.
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
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
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

        return $this->_provider->request('photos.reorderAlbums', $params);
    }
}