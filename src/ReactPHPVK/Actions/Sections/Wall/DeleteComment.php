<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a comment on a post on a user wall or community wall.
 */
class DeleteComment
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
     * @return DeleteComment
     */
    public function _setCustom(array $value): DeleteComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return DeleteComment
     */
    public function setOwnerId(int $value): DeleteComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Comment ID.
     * 
     * @param int $value
     * @return DeleteComment
     */
    public function setCommentId(int $value): DeleteComment
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

        return $this->_provider->request('wall.deleteComment', $params);
    }
}