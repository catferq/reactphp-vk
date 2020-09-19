<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of a user's or community's photos.
 */
class Get
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $albumId = '';
    private array $photoIds = [];
    private bool $rev = false;
    private bool $extended = false;
    private string $feedType = '';
    private int $feed = 0;
    private bool $photoSizes = false;
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
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photos. Use a negative value to designate a community ID.
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
     * Photo album ID. To return information about photos from service albums, use the following string values: 'profile, wall, saved'.
     * 
     * @param string $value
     * @return Get
     */
    public function setAlbumId(string $value): Get
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * Photo IDs.
     * 
     * @param array $value
     * @return Get
     */
    public function setPhotoIds(array $value): Get
    {
        $this->photoIds = $value;
        return $this;
    }

    /**
     * Sort order: '1' — reverse chronological, '0' — chronological
     * 
     * @param bool $value
     * @return Get
     */
    public function setRev(bool $value): Get
    {
        $this->rev = $value;
        return $this;
    }

    /**
     * '1' — to return additional 'likes', 'comments', and 'tags' fields, '0' — (default)
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
     * Type of feed obtained in 'feed' field of the method.
     * 
     * @param string $value
     * @return Get
     */
    public function setFeedType(string $value): Get
    {
        $this->feedType = $value;
        return $this;
    }

    /**
     * unixtime, that can be obtained with [vk.com/dev/newsfeed.get|newsfeed.get] method in date field to get all photos uploaded by the user on a specific day, or photos the user has been tagged on. Also, 'uid' parameter of the user the event happened with shall be specified.
     * 
     * @param int $value
     * @return Get
     */
    public function setFeed(int $value): Get
    {
        $this->feed = $value;
        return $this;
    }

    /**
     * '1' — to return photo sizes in a [vk.com/dev/photo_sizes|special format]
     * 
     * @param bool $value
     * @return Get
     */
    public function setPhotoSizes(bool $value): Get
    {
        $this->photoSizes = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setCount(int $value): Get
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

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->albumId !== '') $params['album_id'] = $this->albumId;
        if ($this->photoIds !== []) $params['photo_ids'] = implode(',', $this->photoIds);
        if ($this->rev !== false) $params['rev'] = intval($this->rev);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->feedType !== '') $params['feed_type'] = $this->feedType;
        if ($this->feed !== 0) $params['feed'] = $this->feed;
        if ($this->photoSizes !== false) $params['photo_sizes'] = intval($this->photoSizes);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 50) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = '';
            $this->photoIds = [];
            $this->rev = false;
            $this->extended = false;
            $this->feedType = '';
            $this->feed = 0;
            $this->photoSizes = false;
            $this->offset = 0;
            $this->count = 50;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.get', $params);
    }
}