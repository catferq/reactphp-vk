<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns video album info
 */
class GetAlbumById
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
    
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
     * identifier of a user or community to add a video to. Use a negative value to designate a community ID.
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
     * Album ID.
     * 
     * @param int $value
     * @return GetAlbumById
     */
    public function setAlbumId(int $value): GetAlbumById
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['album_id'] = $this->albumId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('video.getAlbumById', $params);
    }
}