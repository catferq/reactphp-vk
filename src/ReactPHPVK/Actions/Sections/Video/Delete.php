<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a video from a user or community page.
 */
class Delete
{
    private Provider $_provider;
    
    private int $videoId = 0;
    private int $ownerId = 0;
    private int $targetId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Delete
     */
    public function _setCustom(array $value): Delete
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Video ID.
     * 
     * @param int $value
     * @return Delete
     */
    public function setVideoId(int $value): Delete
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video.
     * 
     * @param int $value
     * @return Delete
     */
    public function setOwnerId(int $value): Delete
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Delete
     */
    public function setTargetId(int $value): Delete
    {
        $this->targetId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['video_id'] = $this->videoId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->targetId !== 0) $params['target_id'] = $this->targetId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->videoId = 0;
            $this->ownerId = 0;
            $this->targetId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('video.delete', $params);
    }
}