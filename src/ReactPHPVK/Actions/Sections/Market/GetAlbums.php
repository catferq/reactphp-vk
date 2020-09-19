<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns community's collections list.
 */
class GetAlbums
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $offset = 0;
    private int $count = 50;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAlbums
     */
    public function _setCustom(array $value): GetAlbums
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an items owner community.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setOwnerId(int $value): GetAlbums
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setOffset(int $value): GetAlbums
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of items to return.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setCount(int $value): GetAlbums
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

        $params['owner_id'] = $this->ownerId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 50) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->offset = 0;
            $this->count = 50;
            $this->_custom = [];
        }

        return $this->_provider->request('market.getAlbums', $params);
    }
}