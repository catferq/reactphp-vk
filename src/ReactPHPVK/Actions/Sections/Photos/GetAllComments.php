<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments on a specific photo album or all albums of the user sorted in reverse chronological order.
 */
class GetAllComments
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
    private bool $needLikes = false;
    private int $offset = 0;
    private int $count = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAllComments
     */
    public function _setCustom(array $value): GetAllComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the album(s).
     * 
     * @param int $value
     * @return GetAllComments
     */
    public function setOwnerId(int $value): GetAllComments
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Album ID. If the parameter is not set, comments on all of the user's albums will be returned.
     * 
     * @param int $value
     * @return GetAllComments
     */
    public function setAlbumId(int $value): GetAllComments
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * '1' — to return an additional 'likes' field, '0' — (default)
     * 
     * @param bool $value
     * @return GetAllComments
     */
    public function setNeedLikes(bool $value): GetAllComments
    {
        $this->needLikes = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of comments. By default, '0'.
     * 
     * @param int $value
     * @return GetAllComments
     */
    public function setOffset(int $value): GetAllComments
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of comments to return. By default, '20'. Maximum value, '100'.
     * 
     * @param int $value
     * @return GetAllComments
     */
    public function setCount(int $value): GetAllComments
    {
        $this->count = $value;
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
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->needLikes !== false) $params['need_likes'] = intval($this->needLikes);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->needLikes = false;
            $this->offset = 0;
            $this->count = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getAllComments', $params);
    }
}