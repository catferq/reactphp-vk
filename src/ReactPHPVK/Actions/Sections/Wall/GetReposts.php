<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about reposts of a post on user wall or community wall.
 */
class GetReposts
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    private int $offset = 0;
    private int $count = 20;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetReposts
     */
    public function _setCustom(array $value): GetReposts
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. By default, current user ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetReposts
     */
    public function setOwnerId(int $value): GetReposts
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Post ID.
     * 
     * @param int $value
     * @return GetReposts
     */
    public function setPostId(int $value): GetReposts
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of reposts.
     * 
     * @param int $value
     * @return GetReposts
     */
    public function setOffset(int $value): GetReposts
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of reposts to return.
     * 
     * @param int $value
     * @return GetReposts
     */
    public function setCount(int $value): GetReposts
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->postId !== 0) $params['post_id'] = $this->postId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.getReposts', $params);
    }
}