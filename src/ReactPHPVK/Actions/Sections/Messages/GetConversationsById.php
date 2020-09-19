<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns conversations by their IDs
 */
class GetConversationsById
{
    private Provider $_provider;
    
    private array $peerIds = [];
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
     * @return GetConversationsById
     */
    public function _setCustom(array $value): GetConversationsById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Destination IDs. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param array $value
     * @return GetConversationsById
     */
    public function setPeerIds(array $value): GetConversationsById
    {
        $this->peerIds = $value;
        return $this;
    }

    /**
     * Return extended properties
     * 
     * @param bool $value
     * @return GetConversationsById
     */
    public function setExtended(bool $value): GetConversationsById
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Profile and communities fields to return.
     * 
     * @param array $value
     * @return GetConversationsById
     */
    public function setFields(array $value): GetConversationsById
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetConversationsById
     */
    public function setGroupId(int $value): GetConversationsById
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

        $params['peer_ids'] = implode(',', $this->peerIds);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerIds = [];
            $this->extended = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getConversationsById', $params);
    }
}