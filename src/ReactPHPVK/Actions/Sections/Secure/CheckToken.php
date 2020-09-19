<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Checks the user authentication in 'IFrame' and 'Flash' apps using the 'access_token' parameter.
 */
class CheckToken
{
    private Provider $_provider;
    
    private string $token = '';
    private string $ip = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CheckToken
     */
    public function _setCustom(array $value): CheckToken
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * client 'access_token'
     * 
     * @param string $value
     * @return CheckToken
     */
    public function setToken(string $value): CheckToken
    {
        $this->token = $value;
        return $this;
    }

    /**
     * user 'ip address'. Note that user may access using the 'ipv6' address, in this case it is required to transmit the 'ipv6' address. If not transmitted, the address will not be checked.
     * 
     * @param string $value
     * @return CheckToken
     */
    public function setIp(string $value): CheckToken
    {
        $this->ip = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->token !== '') $params['token'] = $this->token;
        if ($this->ip !== '') $params['ip'] = $this->ip;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->token = '';
            $this->ip = '';
            $this->_custom = [];
        }

        return $this->_provider->request('secure.checkToken', $params);
    }
}