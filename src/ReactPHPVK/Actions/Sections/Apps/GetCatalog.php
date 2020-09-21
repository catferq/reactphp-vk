<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of applications (apps) available to users in the App Catalog.
 */
class GetCatalog
{
    private Provider $_provider;
    
    private string $sort = '';
    private int $offset = 0;
    private int $count = 100;
    private string $platform = '';
    private bool $extended = false;
    private bool $returnFriends = false;
    private array $fields = [];
    private string $nameCase = '';
    private string $q = '';
    private int $genreId = 0;
    private string $filter = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCatalog
     */
    public function _setCustom(array $value): GetCatalog
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Sort order: 'popular_today' — popular for one day (default), 'visitors' — by visitors number , 'create_date' — by creation date, 'growth_rate' — by growth rate, 'popular_week' — popular for one week
     * 
     * @param string $value
     * @return GetCatalog
     */
    public function setSort(string $value): GetCatalog
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * Offset required to return a specific subset of apps.
     * 
     * @param int $value
     * @return GetCatalog
     */
    public function setOffset(int $value): GetCatalog
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of apps to return.
     * 
     * @param int $value
     * @return GetCatalog
     */
    public function setCount(int $value): GetCatalog
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetCatalog
     */
    public function setPlatform(string $value): GetCatalog
    {
        $this->platform = $value;
        return $this;
    }

    /**
     * '1' — to return additional fields 'screenshots', 'MAU', 'catalog_position', and 'international'. If set, 'count' must be less than or equal to '100'. '0' — not to return additional fields (default).
     * 
     * @param bool $value
     * @return GetCatalog
     */
    public function setExtended(bool $value): GetCatalog
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetCatalog
     */
    public function setReturnFriends(bool $value): GetCatalog
    {
        $this->returnFriends = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetCatalog
     */
    public function setFields(array $value): GetCatalog
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetCatalog
     */
    public function setNameCase(string $value): GetCatalog
    {
        $this->nameCase = $value;
        return $this;
    }

    /**
     * Search query string.
     * 
     * @param string $value
     * @return GetCatalog
     */
    public function setQ(string $value): GetCatalog
    {
        $this->q = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetCatalog
     */
    public function setGenreId(int $value): GetCatalog
    {
        $this->genreId = $value;
        return $this;
    }

    /**
     * 'installed' — to return list of installed apps (only for mobile platform).
     * 
     * @param string $value
     * @return GetCatalog
     */
    public function setFilter(string $value): GetCatalog
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->sort !== '') $params['sort'] = $this->sort;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        $params['count'] = $this->count;
        if ($this->platform !== '') $params['platform'] = $this->platform;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->returnFriends !== false) $params['return_friends'] = intval($this->returnFriends);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->genreId !== 0) $params['genre_id'] = $this->genreId;
        if ($this->filter !== '') $params['filter'] = $this->filter;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->sort = '';
            $this->offset = 0;
            $this->count = 100;
            $this->platform = '';
            $this->extended = false;
            $this->returnFriends = false;
            $this->fields = [];
            $this->nameCase = '';
            $this->q = '';
            $this->genreId = 0;
            $this->filter = '';
            $this->_custom = [];
        }

        return $this->_provider->request('apps.getCatalog', $params);
    }
}