<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns items album's data
 */
class GetAlbumById
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private array $albumIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAlbumById
     */
    public function _setCustom(array $value): GetAlbumById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * identifier of an album owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * 
     * @param int $value
     * @return GetAlbumById
     */
    public function setOwnerId(int $value): GetAlbumById
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * collections identifiers to obtain data from
     * 
     * @param array $value
     * @return GetAlbumById
     */
    public function setAlbumIds(array $value): GetAlbumById
    {
        $this->albumIds = $value;
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
        $params['album_ids'] = implode(',', $this->albumIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('market.getAlbumById', $params);
    }
}