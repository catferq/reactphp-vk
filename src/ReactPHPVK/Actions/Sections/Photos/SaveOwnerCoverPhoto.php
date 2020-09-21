<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves cover photo after successful uploading.
 */
class SaveOwnerCoverPhoto
{
    private Provider $_provider;
    
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
     * @return SaveOwnerCoverPhoto
     */
    public function _setCustom(array $value): SaveOwnerCoverPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveOwnerCoverPhoto
     */
    public function setHash(string $value): SaveOwnerCoverPhoto
    {
        $this->hash = $value;
        return $this;
    }

    /**
     * Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * 
     * @param string $value
     * @return SaveOwnerCoverPhoto
     */
    public function setPhoto(string $value): SaveOwnerCoverPhoto
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['hash'] = $this->hash;
        $params['photo'] = $this->photo;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->hash = '';
            $this->photo = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.saveOwnerCoverPhoto', $params);
    }
}