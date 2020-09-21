<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns one of the previously set game levels of one or more users in the application.
 */
class GetUserLevel
{
    private Provider $_provider;
    
    private array $userIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetUserLevel
     */
    public function _setCustom(array $value): GetUserLevel
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetUserLevel
     */
    public function setUserIds(array $value): GetUserLevel
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['user_ids'] = implode(',', $this->userIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('secure.getUserLevel', $params);
    }
}