<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a chat with several participants.
 */
class CreateChat
{
    private Provider $_provider;
    
    private array $userIds = [];
    private string $title = '';
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CreateChat
     */
    public function _setCustom(array $value): CreateChat
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * IDs of the users to be added to the chat.
     * 
     * @param array $value
     * @return CreateChat
     */
    public function setUserIds(array $value): CreateChat
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * Chat title.
     * 
     * @param string $value
     * @return CreateChat
     */
    public function setTitle(string $value): CreateChat
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CreateChat
     */
    public function setGroupId(int $value): CreateChat
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

        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->title = '';
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.createChat', $params);
    }
}