<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves a photo to a user's or community's wall after being uploaded.
 */
class SaveWallPhoto
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $groupId = 0;
    private string $photo = '';
    private int $server = 0;
    private string $hash = '';
    private float $latitude = 0;
    private float $longitude = 0;
    private string $caption = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveWallPhoto
     */
    public function _setCustom(array $value): SaveWallPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user on whose wall the photo will be saved.
     * 
     * @param int $value
     * @return SaveWallPhoto
     */
    public function setUserId(int $value): SaveWallPhoto
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * ID of community on whose wall the photo will be saved.
     * 
     * @param int $value
     * @return SaveWallPhoto
     */
    public function setGroupId(int $value): SaveWallPhoto
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Parameter returned when the the photo is [vk.com/dev/upload_files|uploaded to the server].
     * 
     * @param string $value
     * @return SaveWallPhoto
     */
    public function setPhoto(string $value): SaveWallPhoto
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SaveWallPhoto
     */
    public function setServer(int $value): SaveWallPhoto
    {
        $this->server = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SaveWallPhoto
     */
    public function setHash(string $value): SaveWallPhoto
    {
        $this->hash = $value;
        return $this;
    }

    /**
     * Geographical latitude, in degrees (from '-90' to '90').
     * 
     * @param float $value
     * @return SaveWallPhoto
     */
    public function setLatitude(float $value): SaveWallPhoto
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * Geographical longitude, in degrees (from '-180' to '180').
     * 
     * @param float $value
     * @return SaveWallPhoto
     */
    public function setLongitude(float $value): SaveWallPhoto
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * Text describing the photo. 2048 digits max.
     * 
     * @param string $value
     * @return SaveWallPhoto
     */
    public function setCaption(string $value): SaveWallPhoto
    {
        $this->caption = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        $params['photo'] = $this->photo;
        if ($this->server !== 0) $params['server'] = $this->server;
        if ($this->hash !== '') $params['hash'] = $this->hash;
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->caption !== '') $params['caption'] = $this->caption;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->groupId = 0;
            $this->photo = '';
            $this->server = 0;
            $this->hash = '';
            $this->latitude = 0;
            $this->longitude = 0;
            $this->caption = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.saveWallPhoto', $params);
    }
}