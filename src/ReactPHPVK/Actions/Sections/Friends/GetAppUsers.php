<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of IDs of the current user's friends who installed the application.
 */
class GetAppUsers
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
     * @return GetAppUsers
     */
    public function _setCustom(array $value): GetAppUsers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getAppUsers', $params);
    }
}