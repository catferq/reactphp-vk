<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores a deleted message.
 */
class Restore
{
    private Provider $_provider;
    
    private int $messageId = 0;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Restore
     */
    public function _setCustom(array $value): Restore
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of a previously-deleted message to restore.
     * 
     * @param int $value
     * @return Restore
     */
    public function setMessageId(int $value): Restore
    {
        $this->messageId = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return Restore
     */
    public function setGroupId(int $value): Restore
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

        $params['message_id'] = $this->messageId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->messageId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.restore', $params);
    }
}