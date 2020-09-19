<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Changes the status of a user as typing in a conversation.
 */
class SetActivity
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $type = '';
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
     * @return SetActivity
     */
    public function _setCustom(array $value): SetActivity
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return SetActivity
     */
    public function setUserId(int $value): SetActivity
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * 'typing' — user has started to type.
     * 
     * @param string $value
     * @return SetActivity
     */
    public function setType(string $value): SetActivity
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return SetActivity
     */
    public function setPeerId(int $value): SetActivity
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return SetActivity
     */
    public function setGroupId(int $value): SetActivity
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
        if ($this->type !== '') $params['type'] = $this->type;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->type = '';
            $this->peerId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.setActivity', $params);
    }
}