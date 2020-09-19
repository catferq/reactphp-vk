<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of communities matching the search criteria.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private string $type = '';
    private int $countryId = 0;
    private int $cityId = 0;
    private bool $future = false;
    private bool $market = false;
    private int $sort = 0;
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
     * @return Search
     */
    public function _setCustom(array $value): Search
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query string.
     * 
     * @param string $value
     * @return Search
     */
    public function setQ(string $value): Search
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Community type. Possible values: 'group, page, event.'
     * 
     * @param string $value
     * @return Search
     */
    public function setType(string $value): Search
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Country ID.
     * 
     * @param int $value
     * @return Search
     */
    public function setCountryId(int $value): Search
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * City ID. If this parameter is transmitted, country_id is ignored.
     * 
     * @param int $value
     * @return Search
     */
    public function setCityId(int $value): Search
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * '1' — to return only upcoming events. Works with the 'type' = 'event' only.
     * 
     * @param bool $value
     * @return Search
     */
    public function setFuture(bool $value): Search
    {
        $this->future = $value;
        return $this;
    }

    /**
     * '1' — to return communities with enabled market only.
     * 
     * @param bool $value
     * @return Search
     */
    public function setMarket(bool $value): Search
    {
        $this->market = $value;
        return $this;
    }

    /**
     * Sort order. Possible values: *'0' — default sorting (similar the full version of the site),, *'1' — by growth speed,, *'2'— by the "day attendance/members number" ratio,, *'3' — by the "Likes number/members number" ratio,, *'4' — by the "comments number/members number" ratio,, *'5' — by the "boards entries number/members number" ratio.
     * 
     * @param int $value
     * @return Search
     */
    public function setSort(int $value): Search
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return Search
     */
    public function setOffset(int $value): Search
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of communities to return. "Note that you can not receive more than first thousand of results, regardless of 'count' and 'offset' values."
     * 
     * @param int $value
     * @return Search
     */
    public function setCount(int $value): Search
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

        $params['q'] = $this->q;
        if ($this->type !== '') $params['type'] = $this->type;
        if ($this->countryId !== 0) $params['country_id'] = $this->countryId;
        if ($this->cityId !== 0) $params['city_id'] = $this->cityId;
        if ($this->future !== false) $params['future'] = intval($this->future);
        if ($this->market !== false) $params['market'] = intval($this->market);
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->type = '';
            $this->countryId = 0;
            $this->cityId = 0;
            $this->future = false;
            $this->market = false;
            $this->sort = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.search', $params);
    }
}