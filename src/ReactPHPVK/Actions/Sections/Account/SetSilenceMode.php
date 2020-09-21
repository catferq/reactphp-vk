<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Mutes push notifications for the set period of time.
 */
class SetSilenceMode
{
    private Provider $_provider;
    
    private string $deviceId = '';
    private int $time = 0;
    private int $peerId = 0;
    private int $sound = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetSilenceMode
     */
    public function _setCustom(array $value): SetSilenceMode
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Unique device ID.
     * 
     * @param string $value
     * @return SetSilenceMode
     */
    public function setDeviceId(string $value): SetSilenceMode
    {
        $this->deviceId = $value;
        return $this;
    }

    /**
     * Time in seconds for what notifications should be disabled. '-1' to disable forever.
     * 
     * @param int $value
     * @return SetSilenceMode
     */
    public function setTime(int $value): SetSilenceMode
    {
        $this->time = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return SetSilenceMode
     */
    public function setPeerId(int $value): SetSilenceMode
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * '1' — to enable sound in this dialog, '0' — to disable sound. Only if 'peer_id' contains user or community ID.
     * 
     * @param int $value
     * @return SetSilenceMode
     */
    public function setSound(int $value): SetSilenceMode
    {
        $this->sound = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->deviceId !== '') $params['device_id'] = $this->deviceId;
        if ($this->time !== 0) $params['time'] = $this->time;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->sound !== 0) $params['sound'] = $this->sound;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->deviceId = '';
            $this->time = 0;
            $this->peerId = 0;
            $this->sound = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('account.setSilenceMode', $params);
    }
}