<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns items list for a community.
 */
class Get
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
    private int $count = 100;
    private int $offset = 0;
    private bool $extended = false;
    
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
     * ID of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * 
     * @param int $value
     * @return Get
     */
    public function setOwnerId(int $value): Get
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setAlbumId(int $value): Get
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * Number of items to return.
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
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * '1' – method will return additional fields: 'likes, can_comment, car_repost, photos'. These parameters are not returned by default.
     * 
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
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->count = 100;
            $this->offset = 0;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('market.get', $params);
    }
}