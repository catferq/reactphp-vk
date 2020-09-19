<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks and unmarks conversations as unanswered.
 */
class MarkAsAnsweredConversation
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private bool $answered = true;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MarkAsAnsweredConversation
     */
    public function _setCustom(array $value): MarkAsAnsweredConversation
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of conversation to mark as important.
     * 
     * @param int $value
     * @return MarkAsAnsweredConversation
     */
    public function setPeerId(int $value): MarkAsAnsweredConversation
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * '1' — to mark as answered, '0' — to remove the mark
     * 
     * @param bool $value
     * @return MarkAsAnsweredConversation
     */
    public function setAnswered(bool $value): MarkAsAnsweredConversation
    {
        $this->answered = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return MarkAsAnsweredConversation
     */
    public function setGroupId(int $value): MarkAsAnsweredConversation
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
        if ($this->answered !== true) $params['answered'] = intval($this->answered);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->answered = true;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.markAsAnsweredConversation', $params);
    }
}