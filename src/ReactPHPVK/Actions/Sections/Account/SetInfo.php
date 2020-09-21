<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to edit the current account info.
 */
class SetInfo
{
    private Provider $_provider;
    
    private string $name = '';
    private string $value = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetInfo
     */
    public function _setCustom(array $value): SetInfo
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Setting name.
     * 
     * @param string $value
     * @return SetInfo
     */
    public function setName(string $value): SetInfo
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Setting value.
     * 
     * @param string $value
     * @return SetInfo
     */
    public function setValue(string $value): SetInfo
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

        if ($this->name !== '') $params['name'] = $this->name;
        if ($this->value !== '') $params['value'] = $this->value;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->name = '';
            $this->value = '';
            $this->_custom = [];
        }

        return $this->_provider->request('account.setInfo', $params);
    }
}