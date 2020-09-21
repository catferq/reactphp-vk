<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the server address for market photo upload.
 */
class GetMarketUploadServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private bool $mainPhoto = false;
    private int $cropX = 0;
    private int $cropY = 0;
    private int $cropWidth = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMarketUploadServer
     */
    public function _setCustom(array $value): GetMarketUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return GetMarketUploadServer
     */
    public function setGroupId(int $value): GetMarketUploadServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * '1' if you want to upload the main item photo.
     * 
     * @param bool $value
     * @return GetMarketUploadServer
     */
    public function setMainPhoto(bool $value): GetMarketUploadServer
    {
        $this->mainPhoto = $value;
        return $this;
    }

    /**
     * X coordinate of the crop left upper corner.
     * 
     * @param int $value
     * @return GetMarketUploadServer
     */
    public function setCropX(int $value): GetMarketUploadServer
    {
        $this->cropX = $value;
        return $this;
    }

    /**
     * Y coordinate of the crop left upper corner.
     * 
     * @param int $value
     * @return GetMarketUploadServer
     */
    public function setCropY(int $value): GetMarketUploadServer
    {
        $this->cropY = $value;
        return $this;
    }

    /**
     * Width of the cropped photo in px.
     * 
     * @param int $value
     * @return GetMarketUploadServer
     */
    public function setCropWidth(int $value): GetMarketUploadServer
    {
        $this->cropWidth = $value;
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
        if ($this->mainPhoto !== false) $params['main_photo'] = intval($this->mainPhoto);
        if ($this->cropX !== 0) $params['crop_x'] = $this->cropX;
        if ($this->cropY !== 0) $params['crop_y'] = $this->cropY;
        if ($this->cropWidth !== 0) $params['crop_width'] = $this->cropWidth;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->mainPhoto = false;
            $this->cropX = 0;
            $this->cropY = 0;
            $this->cropWidth = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getMarketUploadServer', $params);
    }
}