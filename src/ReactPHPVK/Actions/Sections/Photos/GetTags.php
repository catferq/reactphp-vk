<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of tags on a photo.
 */
class GetTags
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private string $accessKey = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTags
     */
    public function _setCustom(array $value): GetTags
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return GetTags
     */
    public function setOwnerId(int $value): GetTags
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return GetTags
     */
    public function setPhotoId(int $value): GetTags
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetTags
     */
    public function setAccessKey(string $value): GetTags
    {
        $this->accessKey = $value;
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
        $params['photo_id'] = $this->photoId;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->accessKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getTags', $params);
    }
}