<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * , Returns a list of newsfeeds recommended to the current user.
 */
class GetRecommended
{
    private Provider $_provider;
    
    private int $startTime = 0;
    private int $endTime = 0;
    private int $maxPhotos = 0;
    private string $startFrom = '';
    private int $count = 0;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetRecommended
     */
    public function _setCustom(array $value): GetRecommended
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * 
     * @param int $value
     * @return GetRecommended
     */
    public function setStartTime(int $value): GetRecommended
    {
        $this->startTime = $value;
        return $this;
    }

    /**
     * Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * 
     * @param int $value
     * @return GetRecommended
     */
    public function setEndTime(int $value): GetRecommended
    {
        $this->endTime = $value;
        return $this;
    }

    /**
     * Maximum number of photos to return. By default, '5'.
     * 
     * @param int $value
     * @return GetRecommended
     */
    public function setMaxPhotos(int $value): GetRecommended
    {
        $this->maxPhotos = $value;
        return $this;
    }

    /**
     * 'new_from' value obtained in previous call.
     * 
     * @param string $value
     * @return GetRecommended
     */
    public function setStartFrom(string $value): GetRecommended
    {
        $this->startFrom = $value;
        return $this;
    }

    /**
     * Number of news items to return.
     * 
     * @param int $value
     * @return GetRecommended
     */
    public function setCount(int $value): GetRecommended
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * 
     * @param array $value
     * @return GetRecommended
     */
    public function setFields(array $value): GetRecommended
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->startTime !== 0) $params['start_time'] = $this->startTime;
        if ($this->endTime !== 0) $params['end_time'] = $this->endTime;
        if ($this->maxPhotos !== 0) $params['max_photos'] = $this->maxPhotos;
        if ($this->startFrom !== '') $params['start_from'] = $this->startFrom;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->startTime = 0;
            $this->endTime = 0;
            $this->maxPhotos = 0;
            $this->startFrom = '';
            $this->count = 0;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.getRecommended', $params);
    }
}