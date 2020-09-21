<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Searches market items in a community's catalog
 */
class Search
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
    private string $q = '';
    private int $priceFrom = 0;
    private int $priceTo = 0;
    private int $sort = 0;
    private int $rev = 1;
    private int $offset = 0;
    private int $count = 20;
    private bool $extended = false;
    private int $status = 0;
    
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
     * ID of an items owner community.
     * 
     * @param int $value
     * @return Search
     */
    public function setOwnerId(int $value): Search
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setAlbumId(int $value): Search
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * Search query, for example "pink slippers".
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
     * Minimum item price value.
     * 
     * @param int $value
     * @return Search
     */
    public function setPriceFrom(int $value): Search
    {
        $this->priceFrom = $value;
        return $this;
    }

    /**
     * Maximum item price value.
     * 
     * @param int $value
     * @return Search
     */
    public function setPriceTo(int $value): Search
    {
        $this->priceTo = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setSort(int $value): Search
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * '0' — do not use reverse order, '1' — use reverse order
     * 
     * @param int $value
     * @return Search
     */
    public function setRev(int $value): Search
    {
        $this->rev = $value;
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
     * Number of items to return.
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
     * '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
     * 
     * @param bool $value
     * @return Search
     */
    public function setExtended(bool $value): Search
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setStatus(int $value): Search
    {
        $this->status = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->priceFrom !== 0) $params['price_from'] = $this->priceFrom;
        if ($this->priceTo !== 0) $params['price_to'] = $this->priceTo;
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->rev !== 1) $params['rev'] = $this->rev;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->status !== 0) $params['status'] = $this->status;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->q = '';
            $this->priceFrom = 0;
            $this->priceTo = 0;
            $this->sort = 0;
            $this->rev = 1;
            $this->offset = 0;
            $this->count = 20;
            $this->extended = false;
            $this->status = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.search', $params);
    }
}