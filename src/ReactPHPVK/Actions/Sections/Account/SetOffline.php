<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks a current user as offline.
 */
class SetOffline
{
    private Provider $_provider;
    
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetOffline
     */
    public function _setCustom(array $value): SetOffline
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->_custom = [];
        }

        return $this->_provider->request('account.setOffline', $params);
    }
}