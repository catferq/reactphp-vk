<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments in the current user's newsfeed.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $count = 30;
    private array $filters = [];
    private string $reposts = '';
    private int $startTime = 0;
    private int $endTime = 0;
    private int $lastCommentsCount = 0;
    private string $startFrom = '';
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
     * Number of comments to return. For auto feed, you can use the 'new_offset' parameter returned by this method.
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
     * Filters to apply: 'post' — new comments on wall posts, 'photo' — new comments on photos, 'video' — new comments on videos, 'topic' — new comments on discussions, 'note' — new comments on notes,
     * 
     * @param array $value
     * @return GetComments
     */
    public function setFilters(array $value): GetComments
    {
        $this->filters = $value;
        return $this;
    }

    /**
     * Object ID, comments on repost of which shall be returned, e.g. 'wall1_45486'. (If the parameter is set, the 'filters' parameter is optional.),
     * 
     * @param string $value
     * @return GetComments
     */
    public function setReposts(string $value): GetComments
    {
        $this->reposts = $value;
        return $this;
    }

    /**
     * Earliest timestamp (in Unix time) of a comment to return. By default, 24 hours ago.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setStartTime(int $value): GetComments
    {
        $this->startTime = $value;
        return $this;
    }

    /**
     * Latest timestamp (in Unix time) of a comment to return. By default, the current time.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setEndTime(int $value): GetComments
    {
        $this->endTime = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setLastCommentsCount(int $value): GetComments
    {
        $this->lastCommentsCount = $value;
        return $this;
    }

    /**
     * Identificator needed to return the next page with results. Value for this parameter returns in 'next_from' field.
     * 
     * @param string $value
     * @return GetComments
     */
    public function setStartFrom(string $value): GetComments
    {
        $this->startFrom = $value;
        return $this;
    }

    /**
     * Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * 
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

        if ($this->count !== 30) $params['count'] = $this->count;
        if ($this->filters !== []) $params['filters'] = implode(',', $this->filters);
        if ($this->reposts !== '') $params['reposts'] = $this->reposts;
        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->lastCommentsCount !== 0) $params['last_comments_count'] = $this->lastCommentsCount;
        if ($this->startFrom !== '') $params['start_from'] = $this->startFrom;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->count = 30;
            $this->filters = [];
            $this->reposts = '';
            $this->startTime = 0;
            $this->endTime = 0;
            $this->lastCommentsCount = 0;
            $this->startFrom = '';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.getComments', $params);
    }
}