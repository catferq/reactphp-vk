<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Removes a tag from a photo.
 */
class RemoveTag
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private int $tagId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveTag
     */
    public function _setCustom(array $value): RemoveTag
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return RemoveTag
     */
    public function setOwnerId(int $value): RemoveTag
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return RemoveTag
     */
    public function setPhotoId(int $value): RemoveTag
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * Tag ID.
     * 
     * @param int $value
     * @return RemoveTag
     */
    public function setTagId(int $value): RemoveTag
    {
        $this->tagId = $value;
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
        $params['tag_id'] = $this->tagId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->tagId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.removeTag', $params);
    }
}