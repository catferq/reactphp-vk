<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows the current user to leave a chat or, if the current user started the chat, allows the user to remove another user from the chat.
 */
class RemoveChatUser
{
    private Provider $_provider;
    
    private int $chatId = 0;
    private int $userId = 0;
    private int $memberId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveChatUser
     */
    public function _setCustom(array $value): RemoveChatUser
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Chat ID.
     * 
     * @param int $value
     * @return RemoveChatUser
     */
    public function setChatId(int $value): RemoveChatUser
    {
        $this->chatId = $value;
        return $this;
    }

    /**
     * ID of the user to be removed from the chat.
     * 
     * @param int $value
     * @return RemoveChatUser
     */
    public function setUserId(int $value): RemoveChatUser
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveChatUser
     */
    public function setMemberId(int $value): RemoveChatUser
    {
        $this->memberId = $value;
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
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->memberId !== 0) $params['member_id'] = $this->memberId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->chatId = 0;
            $this->userId = 0;
            $this->memberId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.removeChatUser', $params);
    }
}