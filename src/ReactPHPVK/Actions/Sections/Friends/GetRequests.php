<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about the current user's incoming and outgoing friend requests.
 */
class GetRequests
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 100;
    private bool $extended = false;
    private bool $needMutual = false;
    private bool $out = false;
    private int $sort = 0;
    private bool $needViewed = false;
    private bool $suggested = false;
    private string $ref = '';
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetRequests
     */
    public function _setCustom(array $value): GetRequests
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of friend requests.
     * 
     * @param int $value
     * @return GetRequests
     */
    public function setOffset(int $value): GetRequests
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of friend requests to return (default 100, maximum 1000).
     * 
     * @param int $value
     * @return GetRequests
     */
    public function setCount(int $value): GetRequests
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return response messages from users who have sent a friend request or, if 'suggested' is set to '1', to return a list of suggested friends
     * 
     * @param bool $value
     * @return GetRequests
     */
    public function setExtended(bool $value): GetRequests
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * '1' — to return a list of mutual friends (up to 20), if any
     * 
     * @param bool $value
     * @return GetRequests
     */
    public function setNeedMutual(bool $value): GetRequests
    {
        $this->needMutual = $value;
        return $this;
    }

    /**
     * '1' — to return outgoing requests, '0' — to return incoming requests (default)
     * 
     * @param bool $value
     * @return GetRequests
     */
    public function setOut(bool $value): GetRequests
    {
        $this->out = $value;
        return $this;
    }

    /**
     * Sort order: '1' — by number of mutual friends, '0' — by date
     * 
     * @param int $value
     * @return GetRequests
     */
    public function setSort(int $value): GetRequests
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetRequests
     */
    public function setNeedViewed(bool $value): GetRequests
    {
        $this->needViewed = $value;
        return $this;
    }

    /**
     * '1' — to return a list of suggested friends, '0' — to return friend requests (default)
     * 
     * @param bool $value
     * @return GetRequests
     */
    public function setSuggested(bool $value): GetRequests
    {
        $this->suggested = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetRequests
     */
    public function setRef(string $value): GetRequests
    {
        $this->ref = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetRequests
     */
    public function setFields(array $value): GetRequests
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->needMutual !== false) $params['need_mutual'] = intval($this->needMutual);
        if ($this->out !== false) $params['out'] = intval($this->out);
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->needViewed !== false) $params['need_viewed'] = intval($this->needViewed);
        if ($this->suggested !== false) $params['suggested'] = intval($this->suggested);
        if ($this->ref !== '') $params['ref'] = $this->ref;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 100;
            $this->extended = false;
            $this->needMutual = false;
            $this->out = false;
            $this->sort = 0;
            $this->needViewed = false;
            $this->suggested = false;
            $this->ref = '';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getRequests', $params);
    }
}