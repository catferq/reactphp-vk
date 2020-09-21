<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Gets settings of push notifications.
 */
class GetPushSettings
{
    private Provider $_provider;
    
    private string $deviceId = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetPushSettings
     */
    public function _setCustom(array $value): GetPushSettings
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Unique device ID.
     * 
     * @param string $value
     * @return GetPushSettings
     */
    public function setDeviceId(string $value): GetPushSettings
    {
        $this->deviceId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->deviceId = '';
            $this->_custom = [];
        }

        return $this->_provider->request('account.getPushSettings', $params);
    }
}