<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the server address for owner cover upload.
 */
class GetOwnerCoverPhotoUploadServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $cropX = 0;
    private int $cropY = 0;
    private int $cropX2 = 795;
    private int $cropY2 = 200;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetOwnerCoverPhotoUploadServer
     */
    public function _setCustom(array $value): GetOwnerCoverPhotoUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of community that owns the album (if the photo will be uploaded to a community album).
     * 
     * @param int $value
     * @return GetOwnerCoverPhotoUploadServer
     */
    public function setGroupId(int $value): GetOwnerCoverPhotoUploadServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * X coordinate of the left-upper corner
     * 
     * @param int $value
     * @return GetOwnerCoverPhotoUploadServer
     */
    public function setCropX(int $value): GetOwnerCoverPhotoUploadServer
    {
        $this->cropX = $value;
        return $this;
    }

    /**
     * Y coordinate of the left-upper corner
     * 
     * @param int $value
     * @return GetOwnerCoverPhotoUploadServer
     */
    public function setCropY(int $value): GetOwnerCoverPhotoUploadServer
    {
        $this->cropY = $value;
        return $this;
    }

    /**
     * X coordinate of the right-bottom corner
     * 
     * @param int $value
     * @return GetOwnerCoverPhotoUploadServer
     */
    public function setCropX2(int $value): GetOwnerCoverPhotoUploadServer
    {
        $this->cropX2 = $value;
        return $this;
    }

    /**
     * Y coordinate of the right-bottom corner
     * 
     * @param int $value
     * @return GetOwnerCoverPhotoUploadServer
     */
    public function setCropY2(int $value): GetOwnerCoverPhotoUploadServer
    {
        $this->cropY2 = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->cropX !== 0) $params['crop_x'] = $this->cropX;
        if ($this->cropY !== 0) $params['crop_y'] = $this->cropY;
        if ($this->cropX2 !== 795) $params['crop_x2'] = $this->cropX2;
        if ($this->cropY2 !== 200) $params['crop_y2'] = $this->cropY2;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->cropX = 0;
            $this->cropY = 0;
            $this->cropX2 = 795;
            $this->cropY2 = 200;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getOwnerCoverPhotoUploadServer', $params);
    }
}