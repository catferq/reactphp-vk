<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a chat's cover picture.
 */
class DeleteChatPhoto
{
    private Provider $_provider;
    
    private int $chatId = 0;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteChatPhoto
     */
    public function _setCustom(array $value): DeleteChatPhoto
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Chat ID.
     * 
     * @param int $value
     * @return DeleteChatPhoto
     */
    public function setChatId(int $value): DeleteChatPhoto
    {
        $this->chatId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return DeleteChatPhoto
     */
    public function setGroupId(int $value): DeleteChatPhoto
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['chat_id'] = $this->chatId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->chatId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.deleteChatPhoto', $params);
    }
}