<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments on a topic on a community's discussion board.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $topicId = 0;
    private bool $needLikes = false;
    private int $startCommentId = 0;
    private int $offset = 0;
    private int $count = 20;
    private bool $extended = false;
    private string $sort = '';
    
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
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setGroupId(int $value): GetComments
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setTopicId(int $value): GetComments
    {
        $this->topicId = $value;
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
     * Number of comments to return.
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
     * '1' — to return information about users who posted comments, '0' — to return no additional fields (default)
     * 
     * @param bool $value
     * @return GetComments
     */
    public function setExtended(bool $value): GetComments
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Sort order: 'asc' — by creation date in chronological order, 'desc' — by creation date in reverse chronological order,
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['topic_id'] = $this->topicId;
        if ($this->needLikes !== false) $params['need_likes'] = intval($this->needLikes);
        if ($this->startCommentId !== 0) $params['start_comment_id'] = $this->startCommentId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->sort !== '') $params['sort'] = $this->sort;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->needLikes = false;
            $this->startCommentId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->extended = false;
            $this->sort = '';
            $this->_custom = [];
        }

        return $this->_provider->request('board.getComments', $params);
    }
}