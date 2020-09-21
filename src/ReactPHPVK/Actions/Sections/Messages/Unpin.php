<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Unpin
{
    private Provider $_provider;
    
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
     * @return Unpin
     */
    public function _setCustom(array $value): Unpin
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Unpin
     */
    public function setPeerId(int $value): Unpin
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Unpin
     */
    public function setGroupId(int $value): Unpin
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
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.unpin', $params);
    }
}