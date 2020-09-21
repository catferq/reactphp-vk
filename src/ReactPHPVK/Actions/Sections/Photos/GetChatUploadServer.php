<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns an upload link for chat cover pictures.
 */
class GetChatUploadServer
{
    private Provider $_provider;
    
    private int $chatId = 0;
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
     * @return GetChatUploadServer
     */
    public function _setCustom(array $value): GetChatUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the chat for which you want to upload a cover photo.
     * 
     * @param int $value
     * @return GetChatUploadServer
     */
    public function setChatId(int $value): GetChatUploadServer
    {
        $this->chatId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetChatUploadServer
     */
    public function setCropX(int $value): GetChatUploadServer
    {
        $this->cropX = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetChatUploadServer
     */
    public function setCropY(int $value): GetChatUploadServer
    {
        $this->cropY = $value;
        return $this;
    }

    /**
     * Width (in pixels) of the photo after cropping.
     * 
     * @param int $value
     * @return GetChatUploadServer
     */
    public function setCropWidth(int $value): GetChatUploadServer
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

        $params['chat_id'] = $this->chatId;
        if ($this->cropX !== 0) $params['crop_x'] = $this->cropX;
        if ($this->cropY !== 0) $params['crop_y'] = $this->cropY;
        if ($this->cropWidth !== 0) $params['crop_width'] = $this->cropWidth;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->chatId = 0;
            $this->cropX = 0;
            $this->cropY = 0;
            $this->cropWidth = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getChatUploadServer', $params);
    }
}