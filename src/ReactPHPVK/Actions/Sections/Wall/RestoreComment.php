<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores a comment deleted from a user wall or community wall.
 */
class RestoreComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $commentId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RestoreComment
     */
    public function _setCustom(array $value): RestoreComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return RestoreComment
     */
    public function setOwnerId(int $value): RestoreComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Comment ID.
     * 
     * @param int $value
     * @return RestoreComment
     */
    public function setCommentId(int $value): RestoreComment
    {
        $this->commentId = $value;
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
        $params['comment_id'] = $this->commentId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->commentId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.restoreComment', $params);
    }
}