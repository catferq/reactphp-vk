<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves a photo after being successfully uploaded. URL obtained with [vk.com/dev/photos.getMessagesUploadServer|photos.getMessagesUploadServer] method.
 */
class SaveMessagesPhoto
{
    private Provider $_provider;
    
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
     * @return SaveMessagesPhoto
     */
    public function _setCustom(array $value): SaveMessagesPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Parameter returned when the photo is [vk.com/dev/upload_files|uploaded to the server].
     * 
     * @param string $value
     * @return SaveMessagesPhoto
     */
    public function setPhoto(string $value): SaveMessagesPhoto
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SaveMessagesPhoto
     */
    public function setServer(int $value): SaveMessagesPhoto
    {
        $this->server = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SaveMessagesPhoto
     */
    public function setHash(string $value): SaveMessagesPhoto
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

        $params['photo'] = $this->photo;
        if ($this->server !== 0) $params['server'] = $this->server;
        if ($this->hash !== '') $params['hash'] = $this->hash;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->photo = '';
            $this->server = 0;
            $this->hash = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.saveMessagesPhoto', $params);
    }
}