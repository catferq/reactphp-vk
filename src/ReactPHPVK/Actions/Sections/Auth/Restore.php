<?php

namespace ReactPHPVK\Actions\Sections\Auth;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
 */
class Restore
{
    private Provider $_provider;
    
    private string $phone = '';
    private string $lastName = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Restore
     */
    public function _setCustom(array $value): Restore
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User phone number.
     * 
     * @param string $value
     * @return Restore
     */
    public function setPhone(string $value): Restore
    {
        $this->phone = $value;
        return $this;
    }

    /**
     * User last name.
     * 
     * @param string $value
     * @return Restore
     */
    public function setLastName(string $value): Restore
    {
        $this->lastName = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['phone'] = $this->phone;
        $params['last_name'] = $this->lastName;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->phone = '';
            $this->lastName = '';
            $this->_custom = [];
        }

        return $this->_provider->request('auth.restore', $params);
    }
}