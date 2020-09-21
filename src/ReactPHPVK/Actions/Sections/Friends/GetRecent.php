<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of user IDs of the current user's recently added friends.
 */
class GetRecent
{
    private Provider $_provider;
    
    private int $count = 100;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetRecent
     */
    public function _setCustom(array $value): GetRecent
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Number of recently added friends to return.
     * 
     * @param int $value
     * @return GetRecent
     */
    public function setCount(int $value): GetRecent
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getRecent', $params);
    }
}