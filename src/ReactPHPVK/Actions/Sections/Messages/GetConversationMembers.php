<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of IDs of users participating in a chat.
 */
class GetConversationMembers
{
    private Provider $_provider;
    
    private int $peerId = 0;
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
     * @return GetConversationMembers
     */
    public function _setCustom(array $value): GetConversationMembers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Peer ID.
     * 
     * @param int $value
     * @return GetConversationMembers
     */
    public function setPeerId(int $value): GetConversationMembers
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetConversationMembers
     */
    public function setFields(array $value): GetConversationMembers
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetConversationMembers
     */
    public function setGroupId(int $value): GetConversationMembers
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['peer_id'] = $this->peerId;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getConversationMembers', $params);
    }
}