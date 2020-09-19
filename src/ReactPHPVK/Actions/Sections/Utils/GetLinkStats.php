<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns stats data for shortened link.
 */
class GetLinkStats
{
    private Provider $_provider;
    
    private string $key = '';
    private string $source = 'vk_cc';
    private string $accessKey = '';
    private string $interval = 'day';
    private int $intervalsCount = 1;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLinkStats
     */
    public function _setCustom(array $value): GetLinkStats
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Link key (characters after vk.cc/).
     * 
     * @param string $value
     * @return GetLinkStats
     */
    public function setKey(string $value): GetLinkStats
    {
        $this->key = $value;
        return $this;
    }

    /**
     * Source of scope
     * 
     * @param string $value
     * @return GetLinkStats
     */
    public function setSource(string $value): GetLinkStats
    {
        $this->source = $value;
        return $this;
    }

    /**
     * Access key for private link stats.
     * 
     * @param string $value
     * @return GetLinkStats
     */
    public function setAccessKey(string $value): GetLinkStats
    {
        $this->accessKey = $value;
        return $this;
    }

    /**
     * Interval.
     * 
     * @param string $value
     * @return GetLinkStats
     */
    public function setInterval(string $value): GetLinkStats
    {
        $this->interval = $value;
        return $this;
    }

    /**
     * Number of intervals to return.
     * 
     * @param int $value
     * @return GetLinkStats
     */
    public function setIntervalsCount(int $value): GetLinkStats
    {
        $this->intervalsCount = $value;
        return $this;
    }

    /**
     * 1 — to return extended stats data (sex, age, geo). 0 — to return views number only.
     * 
     * @param bool $value
     * @return GetLinkStats
     */
    public function setExtended(bool $value): GetLinkStats
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

        $params['key'] = $this->key;
        if ($this->source !== 'vk_cc') $params['source'] = $this->source;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->interval !== 'day') $params['interval'] = $this->interval;
        if ($this->intervalsCount !== 1) $params['intervals_count'] = $this->intervalsCount;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->key = '';
            $this->source = 'vk_cc';
            $this->accessKey = '';
            $this->interval = 'day';
            $this->intervalsCount = 1;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('utils.getLinkStats', $params);
    }
}