<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores a comment deleted from a topic on a community's discussion board.
 */
class RestoreComment
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $topicId = 0;
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
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return RestoreComment
     */
    public function setGroupId(int $value): RestoreComment
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic ID.
     * 
     * @param int $value
     * @return RestoreComment
     */
    public function setTopicId(int $value): RestoreComment
    {
        $this->topicId = $value;
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
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['topic_id'] = $this->topicId;
        $params['comment_id'] = $this->commentId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->commentId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('board.restoreComment', $params);
    }
}