<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Unpins the post on wall.
 */
class Unpin
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Unpin
     */
    public function _setCustom(array $value): Unpin
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Unpin
     */
    public function setOwnerId(int $value): Unpin
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Post ID.
     * 
     * @param int $value
     * @return Unpin
     */
    public function setPostId(int $value): Unpin
    {
        $this->postId = $value;
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
        $params['post_id'] = $this->postId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.unpin', $params);
    }
}