<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments on a video.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $videoId = 0;
    private bool $needLikes = false;
    private int $startCommentId = 0;
    private int $offset = 0;
    private int $count = 20;
    private string $sort = '';
    private bool $extended = false;
    private array $fields = [];
    
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
     * ID of the user or community that owns the video.
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
     * Video ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setVideoId(int $value): GetComments
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * '1' — to return an additional 'likes' field
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
     * Sort order: 'asc' — oldest comment first, 'desc' — newest comment first
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['video_id'] = $this->videoId;
        if ($this->needLikes !== false) $params['need_likes'] = intval($this->needLikes);
        if ($this->startCommentId !== 0) $params['start_comment_id'] = $this->startCommentId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->sort !== '') $params['sort'] = $this->sort;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->videoId = 0;
            $this->needLikes = false;
            $this->startCommentId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->sort = '';
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('video.getComments', $params);
    }
}