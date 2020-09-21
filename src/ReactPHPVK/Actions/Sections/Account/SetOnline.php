<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks the current user as online for 15 minutes.
 */
class SetOnline
{
    private Provider $_provider;
    
    private bool $voip = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetOnline
     */
    public function _setCustom(array $value): SetOnline
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * '1' if videocalls are available for current device.
     * 
     * @param bool $value
     * @return SetOnline
     */
    public function setVoip(bool $value): SetOnline
    {
        $this->voip = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->voip !== false) $params['voip'] = intval($this->voip);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->voip = false;
            $this->_custom = [];
        }

        return $this->_provider->request('account.setOnline', $params);
    }
}