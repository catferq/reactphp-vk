<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetCallbackServers
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private array $serverIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCallbackServers
     */
    public function _setCustom(array $value): GetCallbackServers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetCallbackServers
     */
    public function setGroupId(int $value): GetCallbackServers
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetCallbackServers
     */
    public function setServerIds(array $value): GetCallbackServers
    {
        $this->serverIds = $value;
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
        if ($this->serverIds !== []) $params['server_ids'] = implode(',', $this->serverIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->serverIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getCallbackServers', $params);
    }
}