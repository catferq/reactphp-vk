<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reorders the photo in the list of photos of the user album.
 */
class ReorderPhotos
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
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
     * @return ReorderPhotos
     */
    public function _setCustom(array $value): ReorderPhotos
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return ReorderPhotos
     */
    public function setOwnerId(int $value): ReorderPhotos
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return ReorderPhotos
     */
    public function setPhotoId(int $value): ReorderPhotos
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * ID of the photo before which the photo in question shall be placed.
     * 
     * @param int $value
     * @return ReorderPhotos
     */
    public function setBefore(int $value): ReorderPhotos
    {
        $this->before = $value;
        return $this;
    }

    /**
     * ID of the photo after which the photo in question shall be placed.
     * 
     * @param int $value
     * @return ReorderPhotos
     */
    public function setAfter(int $value): ReorderPhotos
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

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['photo_id'] = $this->photoId;
        if ($this->before !== 0) $params['before'] = $this->before;
        if ($this->after !== 0) $params['after'] = $this->after;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->before = 0;
            $this->after = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.reorderPhotos', $params);
    }
}