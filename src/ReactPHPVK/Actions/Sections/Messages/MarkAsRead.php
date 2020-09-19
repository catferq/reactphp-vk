<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks messages as read.
 */
class MarkAsRead
{
    private Provider $_provider;
    
    private array $messageIds = [];
    private int $peerId = 0;
    private int $startMessageId = 0;
    private int $groupId = 0;
    private bool $markConversationAsRead = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MarkAsRead
     */
    public function _setCustom(array $value): MarkAsRead
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * IDs of messages to mark as read.
     * 
     * @param array $value
     * @return MarkAsRead
     */
    public function setMessageIds(array $value): MarkAsRead
    {
        $this->messageIds = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return MarkAsRead
     */
    public function setPeerId(int $value): MarkAsRead
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Message ID to start from.
     * 
     * @param int $value
     * @return MarkAsRead
     */
    public function setStartMessageId(int $value): MarkAsRead
    {
        $this->startMessageId = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return MarkAsRead
     */
    public function setGroupId(int $value): MarkAsRead
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return MarkAsRead
     */
    public function setMarkConversationAsRead(bool $value): MarkAsRead
    {
        $this->markConversationAsRead = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->messageIds !== []) $params['message_ids'] = implode(',', $this->messageIds);
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->startMessageId !== 0) $params['start_message_id'] = $this->startMessageId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->markConversationAsRead !== false) $params['mark_conversation_as_read'] = intval($this->markConversationAsRead);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->messageIds = [];
            $this->peerId = 0;
            $this->startMessageId = 0;
            $this->groupId = 0;
            $this->markConversationAsRead = false;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.markAsRead', $params);
    }
}