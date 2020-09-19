<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments on a post on a user wall or community wall.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    private bool $needLikes = false;
    private int $startCommentId = 0;
    private int $offset = 0;
    private int $count = 0;
    private string $sort = '';
    private int $previewLength = 0;
    private bool $extended = false;
    private array $fields = [];
    private int $commentId = 0;
    private int $threadItemsCount = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetComments
     */
    public function _setCustom(array $value): GetComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setOwnerId(int $value): GetComments
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Post ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setPostId(int $value): GetComments
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * '1' — to return the 'likes' field, '0' — not to return the 'likes' field (default)
     * 
     * @param bool $value
     * @return GetComments
     */
    public function setNeedLikes(bool $value): GetComments
    {
        $this->needLikes = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setStartCommentId(int $value): GetComments
    {
        $this->startCommentId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of comments.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setOffset(int $value): GetComments
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of comments to return (maximum 100).
     * 
     * @param int $value
     * @return GetComments
     */
    public function setCount(int $value): GetComments
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Sort order: 'asc' — chronological, 'desc' — reverse chronological
     * 
     * @param string $value
     * @return GetComments
     */
    public function setSort(string $value): GetComments
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * Number of characters at which to truncate comments when previewed. By default, '90'. Specify '0' if you do not want to truncate comments.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setPreviewLength(int $value): GetComments
    {
        $this->previewLength = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetComments
     */
    public function setExtended(bool $value): GetComments
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetComments
     */
    public function setFields(array $value): GetComments
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Comment ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setCommentId(int $value): GetComments
    {
        $this->commentId = $value;
        return $this;
    }

    /**
     * Count items in threads.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setThreadItemsCount(int $value): GetComments
    {
        $this->threadItemsCount = $value;
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
        if ($this->needLikes !== false) $params['need_likes'] = intval($this->needLikes);
        if ($this->startCommentId !== 0) $params['start_comment_id'] = $this->startCommentId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->sort !== '') $params['sort'] = $this->sort;
        if ($this->previewLength !== 0) $params['preview_length'] = $this->previewLength;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->commentId !== 0) $params['comment_id'] = $this->commentId;
        if ($this->threadItemsCount !== 0) $params['thread_items_count'] = $this->threadItemsCount;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->needLikes = false;
            $this->startCommentId = 0;
            $this->offset = 0;
            $this->count = 0;
            $this->sort = '';
            $this->previewLength = 0;
            $this->extended = false;
            $this->fields = [];
            $this->commentId = 0;
            $this->threadItemsCount = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.getComments', $params);
    }
}