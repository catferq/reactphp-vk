<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of a user's or community's photo albums.
 */
class GetAlbums
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private array $albumIds = [];
    private int $offset = 0;
    private int $count = 0;
    private bool $needSystem = false;
    private bool $needCovers = false;
    private bool $photoSizes = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAlbums
     */
    public function _setCustom(array $value): GetAlbums
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the albums.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setOwnerId(int $value): GetAlbums
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Album IDs.
     * 
     * @param array $value
     * @return GetAlbums
     */
    public function setAlbumIds(array $value): GetAlbums
    {
        $this->albumIds = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of albums.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setOffset(int $value): GetAlbums
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of albums to return.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setCount(int $value): GetAlbums
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return system albums with negative IDs
     * 
     * @param bool $value
     * @return GetAlbums
     */
    public function setNeedSystem(bool $value): GetAlbums
    {
        $this->needSystem = $value;
        return $this;
    }

    /**
     * '1' — to return an additional 'thumb_src' field, '0' — (default)
     * 
     * @param bool $value
     * @return GetAlbums
     */
    public function setNeedCovers(bool $value): GetAlbums
    {
        $this->needCovers = $value;
        return $this;
    }

    /**
     * '1' — to return photo sizes in a
     * 
     * @param bool $value
     * @return GetAlbums
     */
    public function setPhotoSizes(bool $value): GetAlbums
    {
        $this->photoSizes = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->albumIds !== []) $params['album_ids'] = implode(',', $this->albumIds);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->needSystem !== false) $params['need_system'] = intval($this->needSystem);
        if ($this->needCovers !== false) $params['need_covers'] = intval($this->needCovers);
        if ($this->photoSizes !== false) $params['photo_sizes'] = intval($this->photoSizes);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumIds = [];
            $this->offset = 0;
            $this->count = 0;
            $this->needSystem = false;
            $this->needCovers = false;
            $this->photoSizes = false;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getAlbums', $params);
    }
}