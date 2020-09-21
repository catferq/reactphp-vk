<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of photos in which a user is tagged.
 */
class GetUserPhotos
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $offset = 0;
    private int $count = 20;
    private bool $extended = false;
    private string $sort = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetUserPhotos
     */
    public function _setCustom(array $value): GetUserPhotos
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return GetUserPhotos
     */
    public function setUserId(int $value): GetUserPhotos
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of photos. By default, '0'.
     * 
     * @param int $value
     * @return GetUserPhotos
     */
    public function setOffset(int $value): GetUserPhotos
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of photos to return. Maximum value is 1000.
     * 
     * @param int $value
     * @return GetUserPhotos
     */
    public function setCount(int $value): GetUserPhotos
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return an additional 'likes' field, '0' — (default)
     * 
     * @param bool $value
     * @return GetUserPhotos
     */
    public function setExtended(bool $value): GetUserPhotos
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Sort order: '1' — by date the tag was added in ascending order, '0' — by date the tag was added in descending order
     * 
     * @param string $value
     * @return GetUserPhotos
     */
    public function setSort(string $value): GetUserPhotos
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->sort !== '') $params['sort'] = $this->sort;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->extended = false;
            $this->sort = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getUserPhotos', $params);
    }
}