<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves photos after successful uploading.
 */
class Save
{
    private Provider $_provider;
    
    private int $albumId = 0;
    private int $groupId = 0;
    private int $server = 0;
    private string $photosList = '';
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
     * @return Save
     */
    public function _setCustom(array $value): Save
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the album to save photos to.
     * 
     * @param int $value
     * @return Save
     */
    public function setAlbumId(int $value): Save
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * ID of the community to save photos to.
     * 
     * @param int $value
     * @return Save
     */
    public function setGroupId(int $value): Save
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param int $value
     * @return Save
     */
    public function setServer(int $value): Save
    {
        $this->server = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return Save
     */
    public function setPhotosList(string $value): Save
    {
        $this->photosList = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return Save
     */
    public function setHash(string $value): Save
    {
        $this->hash = $value;
        return $this;
    }

    /**
     * Geographical latitude, in degrees (from '-90' to '90').
     * 
     * @param float $value
     * @return Save
     */
    public function setLatitude(float $value): Save
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * Geographical longitude, in degrees (from '-180' to '180').
     * 
     * @param float $value
     * @return Save
     */
    public function setLongitude(float $value): Save
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * Text describing the photo. 2048 digits max.
     * 
     * @param string $value
     * @return Save
     */
    public function setCaption(string $value): Save
    {
        $this->caption = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->server !== 0) $params['server'] = $this->server;
        if ($this->photosList !== '') $params['photos_list'] = $this->photosList;
        if ($this->hash !== '') $params['hash'] = $this->hash;
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->caption !== '') $params['caption'] = $this->caption;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->albumId = 0;
            $this->groupId = 0;
            $this->server = 0;
            $this->photosList = '';
            $this->hash = '';
            $this->latitude = 0;
            $this->longitude = 0;
            $this->caption = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.save', $params);
    }
}