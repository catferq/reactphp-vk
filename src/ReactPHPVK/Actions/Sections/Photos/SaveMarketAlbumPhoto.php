<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves market album photos after successful uploading.
 */
class SaveMarketAlbumPhoto
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $photo = '';
    private int $server = 0;
    private string $hash = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveMarketAlbumPhoto
     */
    public function _setCustom(array $value): SaveMarketAlbumPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return SaveMarketAlbumPhoto
     */
    public function setGroupId(int $value): SaveMarketAlbumPhoto
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveMarketAlbumPhoto
     */
    public function setPhoto(string $value): SaveMarketAlbumPhoto
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param int $value
     * @return SaveMarketAlbumPhoto
     */
    public function setServer(int $value): SaveMarketAlbumPhoto
    {
        $this->server = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveMarketAlbumPhoto
     */
    public function setHash(string $value): SaveMarketAlbumPhoto
    {
        $this->hash = $value;
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
        $params['photo'] = $this->photo;
        $params['server'] = $this->server;
        $params['hash'] = $this->hash;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->photo = '';
            $this->server = 0;
            $this->hash = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.saveMarketAlbumPhoto', $params);
    }
}