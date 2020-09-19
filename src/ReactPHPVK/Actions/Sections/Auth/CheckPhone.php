<?php

namespace ReactPHPVK\Actions\Sections\Auth;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Checks a user's phone number for correctness.
 */
class CheckPhone
{
    private Provider $_provider;
    
    private string $phone = '';
    private int $clientId = 0;
    private string $clientSecret = '';
    private bool $authByPhone = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CheckPhone
     */
    public function _setCustom(array $value): CheckPhone
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Phone number.
     * 
     * @param string $value
     * @return CheckPhone
     */
    public function setPhone(string $value): CheckPhone
    {
        $this->phone = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return CheckPhone
     */
    public function setClientId(int $value): CheckPhone
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return CheckPhone
     */
    public function setClientSecret(string $value): CheckPhone
    {
        $this->clientSecret = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return CheckPhone
     */
    public function setAuthByPhone(bool $value): CheckPhone
    {
        $this->authByPhone = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['phone'] = $this->phone;
        if ($this->clientId !== 0) $params['client_id'] = $this->clientId;
        if ($this->clientSecret !== '') $params['client_secret'] = $this->clientSecret;
        if ($this->authByPhone !== false) $params['auth_by_phone'] = intval($this->authByPhone);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->phone = '';
            $this->clientId = 0;
            $this->clientSecret = '';
            $this->authByPhone = false;
            $this->_custom = [];
        }

        return $this->_provider->request('auth.checkPhone', $params);
    }
}