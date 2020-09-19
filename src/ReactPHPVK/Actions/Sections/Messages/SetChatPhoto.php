<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sets a previously-uploaded picture as the cover picture of a chat.
 */
class SetChatPhoto
{
    private Provider $_provider;
    
    private string $file = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetChatPhoto
     */
    public function _setCustom(array $value): SetChatPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Upload URL from the 'response' field returned by the [vk.com/dev/photos.getChatUploadServer|photos.getChatUploadServer] method upon successfully uploading an image.
     * 
     * @param string $value
     * @return SetChatPhoto
     */
    public function setFile(string $value): SetChatPhoto
    {
        $this->file = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['file'] = $this->file;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->file = '';
            $this->_custom = [];
        }

        return $this->_provider->request('messages.setChatPhoto', $params);
    }
}