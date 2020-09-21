<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetInviteLink
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private bool $reset = false;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetInviteLink
     */
    public function _setCustom(array $value): GetInviteLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Destination ID.
     * 
     * @param int $value
     * @return GetInviteLink
     */
    public function setPeerId(int $value): GetInviteLink
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * 1 — to generate new link (revoke previous), 0 — to return previous link.
     * 
     * @param bool $value
     * @return GetInviteLink
     */
    public function setReset(bool $value): GetInviteLink
    {
        $this->reset = $value;
        return $this;
    }

    /**
     * Group ID
     * 
     * @param int $value
     * @return GetInviteLink
     */
    public function setGroupId(int $value): GetInviteLink
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

        $params['peer_id'] = $this->peerId;
        if ($this->reset !== false) $params['reset'] = intval($this->reset);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->reset = false;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getInviteLink', $params);
    }
}