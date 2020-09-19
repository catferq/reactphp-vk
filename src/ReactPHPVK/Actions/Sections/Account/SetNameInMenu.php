<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sets an application screen name (up to 17 characters), that is shown to the user in the left menu.
 */
class SetNameInMenu
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $name = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetNameInMenu
     */
    public function _setCustom(array $value): SetNameInMenu
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return SetNameInMenu
     */
    public function setUserId(int $value): SetNameInMenu
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Application screen name.
     * 
     * @param string $value
     * @return SetNameInMenu
     */
    public function setName(string $value): SetNameInMenu
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        if ($this->name !== '') $params['name'] = $this->name;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->name = '';
            $this->_custom = [];
        }

        return $this->_provider->request('account.setNameInMenu', $params);
    }
}