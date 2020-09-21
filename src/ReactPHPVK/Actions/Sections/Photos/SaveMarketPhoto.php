<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves market photos after successful uploading.
 */
class SaveMarketPhoto
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $photo = '';
    private int $server = 0;
    private string $hash = '';
    private string $cropData = '';
    private string $cropHash = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveMarketPhoto
     */
    public function _setCustom(array $value): SaveMarketPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return SaveMarketPhoto
     */
    public function setGroupId(int $value): SaveMarketPhoto
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveMarketPhoto
     */
    public function setPhoto(string $value): SaveMarketPhoto
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param int $value
     * @return SaveMarketPhoto
     */
    public function setServer(int $value): SaveMarketPhoto
    {
        $this->server = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveMarketPhoto
     */
    public function setHash(string $value): SaveMarketPhoto
    {
        $this->hash = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveMarketPhoto
     */
    public function setCropData(string $value): SaveMarketPhoto
    {
        $this->cropData = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveMarketPhoto
     */
    public function setCropHash(string $value): SaveMarketPhoto
    {
        $this->cropHash = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        $params['photo'] = $this->photo;
        $params['server'] = $this->server;
        $params['hash'] = $this->hash;
        if ($this->cropData !== '') $params['crop_data'] = $this->cropData;
        if ($this->cropHash !== '') $params['crop_hash'] = $this->cropHash;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->photo = '';
            $this->server = 0;
            $this->hash = '';
            $this->cropData = '';
            $this->cropHash = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.saveMarketPhoto', $params);
    }
}