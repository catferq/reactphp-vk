<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a comment on a video.
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
     * ID of the user or community that owns the video.
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
     * ID of the comment to be deleted.
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
    public function execute(bool $withClear = true): Promise
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

        return $this->_provider->request('video.deleteComment', $params);
    }
}