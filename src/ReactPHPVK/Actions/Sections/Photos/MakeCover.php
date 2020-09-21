<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Makes a photo into an album cover.
 */
class MakeCover
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private int $albumId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MakeCover
     */
    public function _setCustom(array $value): MakeCover
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return MakeCover
     */
    public function setOwnerId(int $value): MakeCover
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return MakeCover
     */
    public function setPhotoId(int $value): MakeCover
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * Album ID.
     * 
     * @param int $value
     * @return MakeCover
     */
    public function setAlbumId(int $value): MakeCover
    {
        $this->albumId = $value;
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
        $params['photo_id'] = $this->photoId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->albumId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.makeCover', $params);
    }
}