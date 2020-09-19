<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reorders the video in the video album.
 */
class ReorderVideos
{
    private Provider $_provider;
    
    private int $targetId = 0;
    private int $albumId = 0;
    private int $ownerId = 0;
    private int $videoId = 0;
    private int $beforeOwnerId = 0;
    private int $beforeVideoId = 0;
    private int $afterOwnerId = 0;
    private int $afterVideoId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ReorderVideos
     */
    public function _setCustom(array $value): ReorderVideos
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the album with videos.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setTargetId(int $value): ReorderVideos
    {
        $this->targetId = $value;
        return $this;
    }

    /**
     * ID of the video album.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setAlbumId(int $value): ReorderVideos
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setOwnerId(int $value): ReorderVideos
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * ID of the video.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setVideoId(int $value): ReorderVideos
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video before which the video in question shall be placed.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setBeforeOwnerId(int $value): ReorderVideos
    {
        $this->beforeOwnerId = $value;
        return $this;
    }

    /**
     * ID of the video before which the video in question shall be placed.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setBeforeVideoId(int $value): ReorderVideos
    {
        $this->beforeVideoId = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video after which the photo in question shall be placed.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setAfterOwnerId(int $value): ReorderVideos
    {
        $this->afterOwnerId = $value;
        return $this;
    }

    /**
     * ID of the video after which the photo in question shall be placed.
     * 
     * @param int $value
     * @return ReorderVideos
     */
    public function setAfterVideoId(int $value): ReorderVideos
    {
        $this->afterVideoId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->targetId !== 0) $params['target_id'] = $this->targetId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        $params['owner_id'] = $this->ownerId;
        $params['video_id'] = $this->videoId;
        if ($this->beforeOwnerId !== 0) $params['before_owner_id'] = $this->beforeOwnerId;
        if ($this->beforeVideoId !== 0) $params['before_video_id'] = $this->beforeVideoId;
        if ($this->afterOwnerId !== 0) $params['after_owner_id'] = $this->afterOwnerId;
        if ($this->afterVideoId !== 0) $params['after_video_id'] = $this->afterVideoId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->targetId = 0;
            $this->albumId = 0;
            $this->ownerId = 0;
            $this->videoId = 0;
            $this->beforeOwnerId = 0;
            $this->beforeVideoId = 0;
            $this->afterOwnerId = 0;
            $this->afterVideoId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('video.reorderVideos', $params);
    }
}