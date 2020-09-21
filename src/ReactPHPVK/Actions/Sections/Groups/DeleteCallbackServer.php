<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class DeleteCallbackServer
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
     * @return DeleteCallbackServer
     */
    public function _setCustom(array $value): DeleteCallbackServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return DeleteCallbackServer
     */
    public function setGroupId(int $value): DeleteCallbackServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return DeleteCallbackServer
     */
    public function setServerId(int $value): DeleteCallbackServer
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
        $params['server_id'] = $this->serverId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->serverId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.deleteCallbackServer', $params);
    }
}