<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a video to a user or community page.
 */
class Add
{
    private Provider $_provider;
    
    private int $targetId = 0;
    private int $videoId = 0;
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Add
     */
    public function _setCustom(array $value): Add
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * identifier of a user or community to add a video to. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setTargetId(int $value): Add
    {
        $this->targetId = $value;
        return $this;
    }

    /**
     * Video ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setVideoId(int $value): Add
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setOwnerId(int $value): Add
    {
        $this->ownerId = $value;
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
        $params['video_id'] = $this->videoId;
        $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->targetId = 0;
            $this->videoId = 0;
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('video.add', $params);
    }
}