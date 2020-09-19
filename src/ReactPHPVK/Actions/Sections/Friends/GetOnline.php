<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of user IDs of a user's friends who are online.
 */
class GetOnline
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $listId = 0;
    private bool $onlineMobile = false;
    private string $order = '';
    private int $count = 0;
    private int $offset = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetOnline
     */
    public function _setCustom(array $value): GetOnline
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return GetOnline
     */
    public function setUserId(int $value): GetOnline
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Friend list ID. If this parameter is not set, information about all online friends is returned.
     * 
     * @param int $value
     * @return GetOnline
     */
    public function setListId(int $value): GetOnline
    {
        $this->listId = $value;
        return $this;
    }

    /**
     * '1' — to return an additional 'online_mobile' field, '0' — (default),
     * 
     * @param bool $value
     * @return GetOnline
     */
    public function setOnlineMobile(bool $value): GetOnline
    {
        $this->onlineMobile = $value;
        return $this;
    }

    /**
     * Sort order: 'random' — random order
     * 
     * @param string $value
     * @return GetOnline
     */
    public function setOrder(string $value): GetOnline
    {
        $this->order = $value;
        return $this;
    }

    /**
     * Number of friends to return.
     * 
     * @param int $value
     * @return GetOnline
     */
    public function setCount(int $value): GetOnline
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of friends.
     * 
     * @param int $value
     * @return GetOnline
     */
    public function setOffset(int $value): GetOnline
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->listId !== 0) $params['list_id'] = $this->listId;
        if ($this->onlineMobile !== false) $params['online_mobile'] = intval($this->onlineMobile);
        if ($this->order !== '') $params['order'] = $this->order;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->listId = 0;
            $this->onlineMobile = false;
            $this->order = '';
            $this->count = 0;
            $this->offset = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getOnline', $params);
    }
}