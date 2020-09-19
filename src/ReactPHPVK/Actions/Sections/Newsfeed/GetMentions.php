<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of posts on user walls in which the current user is mentioned.
 */
class GetMentions
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $startTime = 0;
    private int $endTime = 0;
    private int $offset = 0;
    private int $count = 20;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMentions
     */
    public function _setCustom(array $value): GetMentions
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Owner ID.
     * 
     * @param int $value
     * @return GetMentions
     */
    public function setOwnerId(int $value): GetMentions
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Earliest timestamp (in Unix time) of a post to return. By default, 24 hours ago.
     * 
     * @param int $value
     * @return GetMentions
     */
    public function setStartTime(int $value): GetMentions
    {
        $this->startTime = $value;
        return $this;
    }

    /**
     * Latest timestamp (in Unix time) of a post to return. By default, the current time.
     * 
     * @param int $value
     * @return GetMentions
     */
    public function setEndTime(int $value): GetMentions
    {
        $this->endTime = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of posts.
     * 
     * @param int $value
     * @return GetMentions
     */
    public function setOffset(int $value): GetMentions
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of posts to return.
     * 
     * @param int $value
     * @return GetMentions
     */
    public function setCount(int $value): GetMentions
    {
        $this->count = $value;
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
        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->startTime = 0;
            $this->endTime = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.getMentions', $params);
    }
}