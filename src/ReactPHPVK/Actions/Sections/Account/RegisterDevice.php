<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Subscribes an iOS/Android/Windows Phone-based device to receive push notifications
 */
class RegisterDevice
{
    private Provider $_provider;
    
    private string $token = '';
    private string $deviceModel = '';
    private int $deviceYear = 0;
    private string $deviceId = '';
    private string $systemVersion = '';
    private string $settings = '';
    private bool $sandbox = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RegisterDevice
     */
    public function _setCustom(array $value): RegisterDevice
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Device token used to send notifications. (for mpns, the token shall be URL for sending of notifications)
     * 
     * @param string $value
     * @return RegisterDevice
     */
    public function setToken(string $value): RegisterDevice
    {
        $this->token = $value;
        return $this;
    }

    /**
     * String name of device model.
     * 
     * @param string $value
     * @return RegisterDevice
     */
    public function setDeviceModel(string $value): RegisterDevice
    {
        $this->deviceModel = $value;
        return $this;
    }

    /**
     * Device year.
     * 
     * @param int $value
     * @return RegisterDevice
     */
    public function setDeviceYear(int $value): RegisterDevice
    {
        $this->deviceYear = $value;
        return $this;
    }

    /**
     * Unique device ID.
     * 
     * @param string $value
     * @return RegisterDevice
     */
    public function setDeviceId(string $value): RegisterDevice
    {
        $this->deviceId = $value;
        return $this;
    }

    /**
     * String version of device operating system.
     * 
     * @param string $value
     * @return RegisterDevice
     */
    public function setSystemVersion(string $value): RegisterDevice
    {
        $this->systemVersion = $value;
        return $this;
    }

    /**
     * Push settings in a [vk.com/dev/push_settings|special format].
     * 
     * @param string $value
     * @return RegisterDevice
     */
    public function setSettings(string $value): RegisterDevice
    {
        $this->settings = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return RegisterDevice
     */
    public function setSandbox(bool $value): RegisterDevice
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

        $params['token'] = $this->token;
        if ($this->deviceModel !== '') $params['device_model'] = $this->deviceModel;
        if ($this->deviceYear !== 0) $params['device_year'] = $this->deviceYear;
        $params['device_id'] = $this->deviceId;
        if ($this->systemVersion !== '') $params['system_version'] = $this->systemVersion;
        if ($this->settings !== '') $params['settings'] = $this->settings;
        if ($this->sandbox !== false) $params['sandbox'] = intval($this->sandbox);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->token = '';
            $this->deviceModel = '';
            $this->deviceYear = 0;
            $this->deviceId = '';
            $this->systemVersion = '';
            $this->settings = '';
            $this->sandbox = false;
            $this->_custom = [];
        }

        return $this->_provider->request('account.registerDevice', $params);
    }
}