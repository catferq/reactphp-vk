<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Moves a photo from one album to another.
 */
class Move
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $targetAlbumId = 0;
    private int $photoId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Move
     */
    public function _setCustom(array $value): Move
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return Move
     */
    public function setOwnerId(int $value): Move
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * ID of the album to which the photo will be moved.
     * 
     * @param int $value
     * @return Move
     */
    public function setTargetAlbumId(int $value): Move
    {
        $this->targetAlbumId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return Move
     */
    public function setPhotoId(int $value): Move
    {
        $this->photoId = $value;
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
        $params['target_album_id'] = $this->targetAlbumId;
        $params['photo_id'] = $this->photoId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->targetAlbumId = 0;
            $this->photoId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.move', $params);
    }
}