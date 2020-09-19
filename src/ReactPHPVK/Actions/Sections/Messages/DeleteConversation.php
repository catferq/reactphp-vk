<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes all private messages in a conversation.
 */
class DeleteConversation
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $peerId = 0;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteConversation
     */
    public function _setCustom(array $value): DeleteConversation
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID. To clear a chat history use 'chat_id'
     * 
     * @param int $value
     * @return DeleteConversation
     */
    public function setUserId(int $value): DeleteConversation
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return DeleteConversation
     */
    public function setPeerId(int $value): DeleteConversation
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return DeleteConversation
     */
    public function setGroupId(int $value): DeleteConversation
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

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->peerId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.deleteConversation', $params);
    }
}