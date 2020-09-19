<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Unsubscribes a device from push notifications.
 */
class UnregisterDevice
{
    private Provider $_provider;
    
    private string $deviceId = '';
    private bool $sandbox = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return UnregisterDevice
     */
    public function _setCustom(array $value): UnregisterDevice
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Unique device ID.
     * 
     * @param string $value
     * @return UnregisterDevice
     */
    public function setDeviceId(string $value): UnregisterDevice
    {
        $this->deviceId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return UnregisterDevice
     */
    public function setSandbox(bool $value): UnregisterDevice
    {
        $this->sandbox = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->deviceId !== '') $params['device_id'] = $this->deviceId;
        if ($this->sandbox !== false) $params['sandbox'] = intval($this->sandbox);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->deviceId = '';
            $this->sandbox = false;
            $this->_custom = [];
        }

        return $this->_provider->request('account.unregisterDevice', $params);
    }
}