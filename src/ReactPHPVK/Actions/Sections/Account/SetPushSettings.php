<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Change push settings.
 */
class SetPushSettings
{
    private Provider $_provider;
    
    private string $deviceId = '';
    private string $settings = '';
    private string $key = '';
    private array $value = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetPushSettings
     */
    public function _setCustom(array $value): SetPushSettings
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Unique device ID.
     * 
     * @param string $value
     * @return SetPushSettings
     */
    public function setDeviceId(string $value): SetPushSettings
    {
        $this->deviceId = $value;
        return $this;
    }

    /**
     * Push settings in a [vk.com/dev/push_settings|special format].
     * 
     * @param string $value
     * @return SetPushSettings
     */
    public function setSettings(string $value): SetPushSettings
    {
        $this->settings = $value;
        return $this;
    }

    /**
     * Notification key.
     * 
     * @param string $value
     * @return SetPushSettings
     */
    public function setKey(string $value): SetPushSettings
    {
        $this->key = $value;
        return $this;
    }

    /**
     * New value for the key in a [vk.com/dev/push_settings|special format].
     * 
     * @param array $value
     * @return SetPushSettings
     */
    public function setValue(array $value): SetPushSettings
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['device_id'] = $this->deviceId;
        if ($this->settings !== '') $params['settings'] = $this->settings;
        if ($this->key !== '') $params['key'] = $this->key;
        if ($this->value !== []) $params['value'] = implode(',', $this->value);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->deviceId = '';
            $this->settings = '';
            $this->key = '';
            $this->value = [];
            $this->_custom = [];
        }

        return $this->_provider->request('account.setPushSettings', $params);
    }
}