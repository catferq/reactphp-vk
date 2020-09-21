<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores a post deleted from a user wall or community wall.
 */
class Restore
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
     * @return Restore
     */
    public function _setCustom(array $value): Restore
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID from whose wall the post was deleted. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Restore
     */
    public function setOwnerId(int $value): Restore
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * ID of the post to be restored.
     * 
     * @param int $value
     * @return Restore
     */
    public function setPostId(int $value): Restore
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->postId !== 0) $params['post_id'] = $this->postId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.restore', $params);
    }
}