<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns detailed information about videos.
 */
class Get
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private array $videos = [];
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
     * ID of the user or community that owns the video(s).
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
     * Video IDs, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", Use a negative value to designate a community ID. Example: "-4363_136089719,13245770_137352259"
     * 
     * @param array $value
     * @return Get
     */
    public function setVideos(array $value): Get
    {
        $this->videos = $value;
        return $this;
    }

    /**
     * ID of the album containing the video(s).
     * 
     * @param int $value
     * @return Get
     */
    public function setAlbumId(int $value): Get
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * Number of videos to return.
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
     * Offset needed to return a specific subset of videos.
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
     * '1' — to return an extended response with additional fields
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

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->videos !== []) $params['videos'] = implode(',', $this->videos);
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->videos = [];
            $this->albumId = 0;
            $this->count = 100;
            $this->offset = 0;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('video.get', $params);
    }
}