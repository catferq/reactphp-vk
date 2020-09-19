<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves a profile or community photo. Upload URL can be got with the [vk.com/dev/photos.getOwnerPhotoUploadServer|photos.getOwnerPhotoUploadServer] method.
 */
class SaveOwnerPhoto
{
    private Provider $_provider;
    
    private string $server = '';
    private string $hash = '';
    private string $photo = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveOwnerPhoto
     */
    public function _setCustom(array $value): SaveOwnerPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * parameter returned after [vk.com/dev/upload_files|photo upload].
     * 
     * @param string $value
     * @return SaveOwnerPhoto
     */
    public function setServer(string $value): SaveOwnerPhoto
    {
        $this->server = $value;
        return $this;
    }

    /**
     * parameter returned after [vk.com/dev/upload_files|photo upload].
     * 
     * @param string $value
     * @return SaveOwnerPhoto
     */
    public function setHash(string $value): SaveOwnerPhoto
    {
        $this->hash = $value;
        return $this;
    }

    /**
     * parameter returned after [vk.com/dev/upload_files|photo upload].
     * 
     * @param string $value
     * @return SaveOwnerPhoto
     */
    public function setPhoto(string $value): SaveOwnerPhoto
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->server !== '') $params['server'] = $this->server;
        if ($this->hash !== '') $params['hash'] = $this->hash;
        if ($this->photo !== '') $params['photo'] = $this->photo;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->server = '';
            $this->hash = '';
            $this->photo = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.saveOwnerPhoto', $params);
    }
}