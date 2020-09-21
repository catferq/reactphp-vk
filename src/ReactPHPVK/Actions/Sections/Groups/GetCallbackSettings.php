<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns [vk.com/dev/callback_api|Callback API] notifications settings.
 */
class GetCallbackSettings
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $serverId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCallbackSettings
     */
    public function _setCustom(array $value): GetCallbackSettings
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return GetCallbackSettings
     */
    public function setGroupId(int $value): GetCallbackSettings
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Server ID.
     * 
     * @param int $value
     * @return GetCallbackSettings
     */
    public function setServerId(int $value): GetCallbackSettings
    {
        $this->serverId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->serverId !== 0) $params['server_id'] = $this->serverId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->serverId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getCallbackSettings', $params);
    }
}