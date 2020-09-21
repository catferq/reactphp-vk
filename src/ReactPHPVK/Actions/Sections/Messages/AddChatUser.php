<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a new user to a chat.
 */
class AddChatUser
{
    private Provider $_provider;
    
    private int $chatId = 0;
    private int $userId = 0;
    private int $visibleMessagesCount = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddChatUser
     */
    public function _setCustom(array $value): AddChatUser
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Chat ID.
     * 
     * @param int $value
     * @return AddChatUser
     */
    public function setChatId(int $value): AddChatUser
    {
        $this->chatId = $value;
        return $this;
    }

    /**
     * ID of the user to be added to the chat.
     * 
     * @param int $value
     * @return AddChatUser
     */
    public function setUserId(int $value): AddChatUser
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddChatUser
     */
    public function setVisibleMessagesCount(int $value): AddChatUser
    {
        $this->visibleMessagesCount = $value;
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
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->visibleMessagesCount !== 0) $params['visible_messages_count'] = $this->visibleMessagesCount;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->chatId = 0;
            $this->userId = 0;
            $this->visibleMessagesCount = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.addChatUser', $params);
    }
}