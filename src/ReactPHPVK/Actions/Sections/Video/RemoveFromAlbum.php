<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class RemoveFromAlbum
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
     * @return RemoveFromAlbum
     */
    public function _setCustom(array $value): RemoveFromAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveFromAlbum
     */
    public function setTargetId(int $value): RemoveFromAlbum
    {
        $this->targetId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveFromAlbum
     */
    public function setAlbumId(int $value): RemoveFromAlbum
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return RemoveFromAlbum
     */
    public function setAlbumIds(array $value): RemoveFromAlbum
    {
        $this->albumIds = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveFromAlbum
     */
    public function setOwnerId(int $value): RemoveFromAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveFromAlbum
     */
    public function setVideoId(int $value): RemoveFromAlbum
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

        return $this->_provider->request('video.removeFromAlbum', $params);
    }
}