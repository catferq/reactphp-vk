<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns messages by their IDs within the conversation.
 */
class GetByConversationMessageId
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private array $conversationMessageIds = [];
    private bool $extended = false;
    private array $fields = [];
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetByConversationMessageId
     */
    public function _setCustom(array $value): GetByConversationMessageId
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return GetByConversationMessageId
     */
    public function setPeerId(int $value): GetByConversationMessageId
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Conversation message IDs.
     * 
     * @param array $value
     * @return GetByConversationMessageId
     */
    public function setConversationMessageIds(array $value): GetByConversationMessageId
    {
        $this->conversationMessageIds = $value;
        return $this;
    }

    /**
     * Information whether the response should be extended
     * 
     * @param bool $value
     * @return GetByConversationMessageId
     */
    public function setExtended(bool $value): GetByConversationMessageId
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetByConversationMessageId
     */
    public function setFields(array $value): GetByConversationMessageId
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetByConversationMessageId
     */
    public function setGroupId(int $value): GetByConversationMessageId
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

        $params['peer_id'] = $this->peerId;
        $params['conversation_message_ids'] = implode(',', $this->conversationMessageIds);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->conversationMessageIds = [];
            $this->extended = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getByConversationMessageId', $params);
    }
}