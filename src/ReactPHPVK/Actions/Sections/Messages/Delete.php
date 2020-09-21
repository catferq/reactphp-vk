<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes one or more messages.
 */
class Delete
{
    private Provider $_provider;
    
    private array $messageIds = [];
    private bool $spam = false;
    private int $groupId = 0;
    private bool $deleteForAll = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Delete
     */
    public function _setCustom(array $value): Delete
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Message IDs.
     * 
     * @param array $value
     * @return Delete
     */
    public function setMessageIds(array $value): Delete
    {
        $this->messageIds = $value;
        return $this;
    }

    /**
     * '1' — to mark message as spam.
     * 
     * @param bool $value
     * @return Delete
     */
    public function setSpam(bool $value): Delete
    {
        $this->spam = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return Delete
     */
    public function setGroupId(int $value): Delete
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * '1' — delete message for for all.
     * 
     * @param bool $value
     * @return Delete
     */
    public function setDeleteForAll(bool $value): Delete
    {
        $this->deleteForAll = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->messageIds !== []) $params['message_ids'] = implode(',', $this->messageIds);
        if ($this->spam !== false) $params['spam'] = intval($this->spam);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->deleteForAll !== false) $params['delete_for_all'] = intval($this->deleteForAll);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->messageIds = [];
            $this->spam = false;
            $this->groupId = 0;
            $this->deleteForAll = false;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.delete', $params);
    }
}