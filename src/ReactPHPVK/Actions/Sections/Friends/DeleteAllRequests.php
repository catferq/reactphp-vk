<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks all incoming friend requests as viewed.
 */
class DeleteAllRequests
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
     * @return DeleteAllRequests
     */
    public function _setCustom(array $value): DeleteAllRequests
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

        return $this->_provider->request('friends.deleteAllRequests', $params);
    }
}