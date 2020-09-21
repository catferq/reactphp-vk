<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns data required to show newsfeed for the current user.
 */
class Get
{
    private Provider $_provider;
    
    private array $filters = [];
    private bool $returnBanned = false;
    private int $startTime = 0;
    private int $endTime = 0;
    private int $maxPhotos = 0;
    private string $sourceIds = '';
    private string $startFrom = '';
    private int $count = 0;
    private array $fields = [];
    private string $section = '';
    
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
     * Filters to apply: 'post' — new wall posts, 'photo' — new photos, 'photo_tag' — new photo tags, 'wall_photo' — new wall photos, 'friend' — new friends, 'note' — new notes
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
     * '1' — to return news items from banned sources
     * 
     * @param bool $value
     * @return Get
     */
    public function setReturnBanned(bool $value): Get
    {
        $this->returnBanned = $value;
        return $this;
    }

    /**
     * Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
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
     * Latest timestamp (in Unix time) of a news item to return. By default, the current time.
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
     * Maximum number of photos to return. By default, '5'.
     * 
     * @param int $value
     * @return Get
     */
    public function setMaxPhotos(int $value): Get
    {
        $this->maxPhotos = $value;
        return $this;
    }

    /**
     * Sources to obtain news from, separated by commas. User IDs can be specified in formats '' or 'u' , where '' is the user's friend ID. Community IDs can be specified in formats '-' or 'g' , where '' is the community ID. If the parameter is not set, all of the user's friends and communities are returned, except for banned sources, which can be obtained with the [vk.com/dev/newsfeed.getBanned|newsfeed.getBanned] method.
     * 
     * @param string $value
     * @return Get
     */
    public function setSourceIds(string $value): Get
    {
        $this->sourceIds = $value;
        return $this;
    }

    /**
     * identifier required to get the next page of results. Value for this parameter is returned in 'next_from' field in a reply.
     * 
     * @param string $value
     * @return Get
     */
    public function setStartFrom(string $value): Get
    {
        $this->startFrom = $value;
        return $this;
    }

    /**
     * Number of news items to return (default 50, maximum 100). For auto feed, you can use the 'new_offset' parameter returned by this method.
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
     * Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * 
     * @param array $value
     * @return Get
     */
    public function setFields(array $value): Get
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Get
     */
    public function setSection(string $value): Get
    {
        $this->section = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->filters !== []) $params['filters'] = implode(',', $this->filters);
        if ($this->returnBanned !== false) $params['return_banned'] = intval($this->returnBanned);
        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->maxPhotos !== 0) $params['max_photos'] = $this->maxPhotos;
        if ($this->sourceIds !== '') $params['source_ids'] = $this->sourceIds;
        if ($this->startFrom !== '') $params['start_from'] = $this->startFrom;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->section !== '') $params['section'] = $this->section;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->filters = [];
            $this->returnBanned = false;
            $this->startTime = 0;
            $this->endTime = 0;
            $this->maxPhotos = 0;
            $this->sourceIds = '';
            $this->startFrom = '';
            $this->count = 0;
            $this->fields = [];
            $this->section = '';
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.get', $params);
    }
}