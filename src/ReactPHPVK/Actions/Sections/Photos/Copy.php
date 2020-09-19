<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to copy a photo to the "Saved photos" album
 */
class Copy
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
     * @return Copy
     */
    public function _setCustom(array $value): Copy
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * photo's owner ID
     * 
     * @param int $value
     * @return Copy
     */
    public function setOwnerId(int $value): Copy
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * photo ID
     * 
     * @param int $value
     * @return Copy
     */
    public function setPhotoId(int $value): Copy
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * for private photos
     * 
     * @param string $value
     * @return Copy
     */
    public function setAccessKey(string $value): Copy
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

        $params['owner_id'] = $this->ownerId;
        $params['photo_id'] = $this->photoId;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->accessKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.copy', $params);
    }
}