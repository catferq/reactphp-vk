<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddToAlbum
{
    private Provider $_provider;
    
    private int $targetId = 0;
    private int $albumId = 0;
    private array $albumIds = [];
    private int $ownerId = 0;
    private int $videoId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddToAlbum
     */
    public function _setCustom(array $value): AddToAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddToAlbum
     */
    public function setTargetId(int $value): AddToAlbum
    {
        $this->targetId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddToAlbum
     */
    public function setAlbumId(int $value): AddToAlbum
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return AddToAlbum
     */
    public function setAlbumIds(array $value): AddToAlbum
    {
        $this->albumIds = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddToAlbum
     */
    public function setOwnerId(int $value): AddToAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddToAlbum
     */
    public function setVideoId(int $value): AddToAlbum
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->targetId !== 0) $params['target_id'] = $this->targetId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->albumIds !== []) $params['album_ids'] = implode(',', $this->albumIds);
        $params['owner_id'] = $this->ownerId;
        $params['video_id'] = $this->videoId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->targetId = 0;
            $this->albumId = 0;
            $this->albumIds = [];
            $this->ownerId = 0;
            $this->videoId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('video.addToAlbum', $params);
    }
}