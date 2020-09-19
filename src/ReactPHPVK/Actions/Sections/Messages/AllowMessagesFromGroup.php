<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows sending messages from community to the current user.
 */
class AllowMessagesFromGroup
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $key = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AllowMessagesFromGroup
     */
    public function _setCustom(array $value): AllowMessagesFromGroup
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Group ID.
     * 
     * @param int $value
     * @return AllowMessagesFromGroup
     */
    public function setGroupId(int $value): AllowMessagesFromGroup
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AllowMessagesFromGroup
     */
    public function setKey(string $value): AllowMessagesFromGroup
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->key !== '') $params['key'] = $this->key;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->key = '';
            $this->_custom = [];
        }

        return $this->_provider->request('messages.allowMessagesFromGroup', $params);
    }
}