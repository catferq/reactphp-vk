<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private int $placeId = 0;
    private float $latitude = 0;
    private float $longitude = 0;
    private int $radius = 0;
    private int $mentionedId = 0;
    private int $count = 20;
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
     * @return Search
     */
    public function _setCustom(array $value): Search
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Search
     */
    public function setQ(string $value): Search
    {
        $this->q = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setPlaceId(int $value): Search
    {
        $this->placeId = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Search
     */
    public function setLatitude(float $value): Search
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Search
     */
    public function setLongitude(float $value): Search
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setRadius(int $value): Search
    {
        $this->radius = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setMentionedId(int $value): Search
    {
        $this->mentionedId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setCount(int $value): Search
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Search
     */
    public function setExtended(bool $value): Search
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Search
     */
    public function setFields(array $value): Search
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

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->placeId !== 0) $params['place_id'] = $this->placeId;
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->radius !== 0) $params['radius'] = $this->radius;
        if ($this->mentionedId !== 0) $params['mentioned_id'] = $this->mentionedId;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->placeId = 0;
            $this->latitude = 0;
            $this->longitude = 0;
            $this->radius = 0;
            $this->mentionedId = 0;
            $this->count = 20;
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stories.search', $params);
    }
}