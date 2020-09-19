<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks and unmarks conversations as important.
 */
class MarkAsImportantConversation
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private bool $important = true;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MarkAsImportantConversation
     */
    public function _setCustom(array $value): MarkAsImportantConversation
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of conversation to mark as important.
     * 
     * @param int $value
     * @return MarkAsImportantConversation
     */
    public function setPeerId(int $value): MarkAsImportantConversation
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * '1' — to add a star (mark as important), '0' — to remove the star
     * 
     * @param bool $value
     * @return MarkAsImportantConversation
     */
    public function setImportant(bool $value): MarkAsImportantConversation
    {
        $this->important = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return MarkAsImportantConversation
     */
    public function setGroupId(int $value): MarkAsImportantConversation
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
        if ($this->important !== true) $params['important'] = intval($this->important);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->important = true;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.markAsImportantConversation', $params);
    }
}