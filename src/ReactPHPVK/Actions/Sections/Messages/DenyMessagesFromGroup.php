<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Denies sending message from community to the current user.
 */
class DenyMessagesFromGroup
{
    private Provider $_provider;
    
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DenyMessagesFromGroup
     */
    public function _setCustom(array $value): DenyMessagesFromGroup
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Group ID.
     * 
     * @param int $value
     * @return DenyMessagesFromGroup
     */
    public function setGroupId(int $value): DenyMessagesFromGroup
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

        $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.denyMessagesFromGroup', $params);
    }
}