<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns message history for the specified user or group chat.
 */
class GetHistory
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 20;
    private int $userId = 0;
    private int $peerId = 0;
    private int $startMessageId = 0;
    private int $rev = 0;
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
     * @return GetHistory
     */
    public function _setCustom(array $value): GetHistory
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of messages.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setOffset(int $value): GetHistory
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of messages to return.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setCount(int $value): GetHistory
    {
        $this->count = $value;
        return $this;
    }

    /**
     * ID of the user whose message history you want to return.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setUserId(int $value): GetHistory
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetHistory
     */
    public function setPeerId(int $value): GetHistory
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Starting message ID from which to return history.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setStartMessageId(int $value): GetHistory
    {
        $this->startMessageId = $value;
        return $this;
    }

    /**
     * Sort order: '1' — return messages in chronological order. '0' — return messages in reverse chronological order.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setRev(int $value): GetHistory
    {
        $this->rev = $value;
        return $this;
    }

    /**
     * Information whether the response should be extended
     * 
     * @param bool $value
     * @return GetHistory
     */
    public function setExtended(bool $value): GetHistory
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetHistory
     */
    public function setFields(array $value): GetHistory
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setGroupId(int $value): GetHistory
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
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->startMessageId !== 0) $params['start_message_id'] = $this->startMessageId;
        if ($this->rev !== 0) $params['rev'] = $this->rev;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 20;
            $this->userId = 0;
            $this->peerId = 0;
            $this->startMessageId = 0;
            $this->rev = 0;
            $this->extended = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getHistory', $params);
    }
}