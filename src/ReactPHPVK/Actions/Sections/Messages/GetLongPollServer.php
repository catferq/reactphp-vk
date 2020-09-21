<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns data required for connection to a Long Poll server.
 */
class GetLongPollServer
{
    private Provider $_provider;
    
    private bool $needPts = false;
    private int $groupId = 0;
    private int $lpVersion = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLongPollServer
     */
    public function _setCustom(array $value): GetLongPollServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * '1' — to return the 'pts' field, needed for the [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
     * 
     * @param bool $value
     * @return GetLongPollServer
     */
    public function setNeedPts(bool $value): GetLongPollServer
    {
        $this->needPts = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return GetLongPollServer
     */
    public function setGroupId(int $value): GetLongPollServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Long poll version
     * 
     * @param int $value
     * @return GetLongPollServer
     */
    public function setLpVersion(int $value): GetLongPollServer
    {
        $this->lpVersion = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->needPts !== false) $params['need_pts'] = intval($this->needPts);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->lpVersion !== 0) $params['lp_version'] = $this->lpVersion;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->needPts = false;
            $this->groupId = 0;
            $this->lpVersion = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getLongPollServer', $params);
    }
}