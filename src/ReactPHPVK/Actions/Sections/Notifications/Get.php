<?php

namespace ReactPHPVK\Actions\Sections\Notifications;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of notifications about other users' feedback to the current user's wall posts.
 */
class Get
{
    private Provider $_provider;
    
    private int $count = 30;
    private string $startFrom = '';
    private array $filters = [];
    private int $startTime = 0;
    private int $endTime = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Number of notifications to return.
     * 
     * @param int $value
     * @return Get
     */
    public function setCount(int $value): Get
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Get
     */
    public function setStartFrom(string $value): Get
    {
        $this->startFrom = $value;
        return $this;
    }

    /**
     * Type of notifications to return: 'wall' — wall posts, 'mentions' — mentions in wall posts, comments, or topics, 'comments' — comments to wall posts, photos, and videos, 'likes' — likes, 'reposted' — wall posts that are copied from the current user's wall, 'followers' — new followers, 'friends' — accepted friend requests
     * 
     * @param array $value
     * @return Get
     */
    public function setFilters(array $value): Get
    {
        $this->filters = $value;
        return $this;
    }

    /**
     * Earliest timestamp (in Unix time) of a notification to return. By default, 24 hours ago.
     * 
     * @param int $value
     * @return Get
     */
    public function setStartTime(int $value): Get
    {
        $this->startTime = $value;
        return $this;
    }

    /**
     * Latest timestamp (in Unix time) of a notification to return. By default, the current time.
     * 
     * @param int $value
     * @return Get
     */
    public function setEndTime(int $value): Get
    {
        $this->endTime = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->count !== 30) $params['count'] = $this->count;
        if ($this->startFrom !== '') $params['start_from'] = $this->startFrom;
        if ($this->filters !== []) $params['filters'] = implode(',', $this->filters);
        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->count = 30;
            $this->startFrom = '';
            $this->filters = [];
            $this->startTime = 0;
            $this->endTime = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('notifications.get', $params);
    }
}