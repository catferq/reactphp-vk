<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of the current user's conversations.
 */
class GetConversations
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 20;
    private string $filter = 'all';
    private bool $extended = false;
    private int $startMessageId = 0;
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
     * @return GetConversations
     */
    public function _setCustom(array $value): GetConversations
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of conversations.
     * 
     * @param int $value
     * @return GetConversations
     */
    public function setOffset(int $value): GetConversations
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of conversations to return.
     * 
     * @param int $value
     * @return GetConversations
     */
    public function setCount(int $value): GetConversations
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Filter to apply: 'all' — all conversations, 'unread' — conversations with unread messages, 'important' — conversations, marked as important (only for community messages), 'unanswered' — conversations, marked as unanswered (only for community messages)
     * 
     * @param string $value
     * @return GetConversations
     */
    public function setFilter(string $value): GetConversations
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * '1' — return extra information about users and communities
     * 
     * @param bool $value
     * @return GetConversations
     */
    public function setExtended(bool $value): GetConversations
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * ID of the message from what to return dialogs.
     * 
     * @param int $value
     * @return GetConversations
     */
    public function setStartMessageId(int $value): GetConversations
    {
        $this->startMessageId = $value;
        return $this;
    }

    /**
     * Profile and communities fields to return.
     * 
     * @param array $value
     * @return GetConversations
     */
    public function setFields(array $value): GetConversations
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetConversations
     */
    public function setGroupId(int $value): GetConversations
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

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->filter !== 'all') $params['filter'] = $this->filter;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->startMessageId !== 0) $params['start_message_id'] = $this->startMessageId;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 20;
            $this->filter = 'all';
            $this->extended = false;
            $this->startMessageId = 0;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getConversations', $params);
    }
}