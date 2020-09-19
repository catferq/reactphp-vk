<?php

namespace ReactPHPVK\Actions\Sections\Stats;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns statistics of a community or an application.
 */
class Get
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $appId = 0;
    private int $timestampFrom = 0;
    private int $timestampTo = 0;
    private string $interval = 'day';
    private int $intervalsCount = 0;
    private array $filters = [];
    private array $statsGroups = [];
    private bool $extended = true;
    
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
     * Community ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setGroupId(int $value): Get
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Application ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setAppId(int $value): Get
    {
        $this->appId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setTimestampFrom(int $value): Get
    {
        $this->timestampFrom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setTimestampTo(int $value): Get
    {
        $this->timestampTo = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Get
     */
    public function setInterval(string $value): Get
    {
        $this->interval = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setIntervalsCount(int $value): Get
    {
        $this->intervalsCount = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Get
     */
    public function setFilters(array $value): Get
    {
        $this->filters = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Get
     */
    public function setStatsGroups(array $value): Get
    {
        $this->statsGroups = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Get
     */
    public function setExtended(bool $value): Get
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->appId !== 0) $params['app_id'] = $this->appId;
        if ($this->timestampFrom !== 0) $params['timestamp_from'] = $this->timestampFrom;
        if ($this->timestampTo !== 0) $params['timestamp_to'] = $this->timestampTo;
        if ($this->interval !== 'day') $params['interval'] = $this->interval;
        if ($this->intervalsCount !== 0) $params['intervals_count'] = $this->intervalsCount;
        if ($this->filters !== []) $params['filters'] = implode(',', $this->filters);
        if ($this->statsGroups !== []) $params['stats_groups'] = implode(',', $this->statsGroups);
        if ($this->extended !== true) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->appId = 0;
            $this->timestampFrom = 0;
            $this->timestampTo = 0;
            $this->interval = 'day';
            $this->intervalsCount = 0;
            $this->filters = [];
            $this->statsGroups = [];
            $this->extended = true;
            $this->_custom = [];
        }

        return $this->_provider->request('stats.get', $params);
    }
}