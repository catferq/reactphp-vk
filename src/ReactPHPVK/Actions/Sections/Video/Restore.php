<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores a previously deleted video.
 */
class Restore
{
    private Provider $_provider;
    
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
     * @return Restore
     */
    public function _setCustom(array $value): Restore
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Video ID.
     * 
     * @param int $value
     * @return Restore
     */
    public function setVideoId(int $value): Restore
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video.
     * 
     * @param int $value
     * @return Restore
     */
    public function setOwnerId(int $value): Restore
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['video_id'] = $this->videoId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->videoId = 0;
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('video.restore', $params);
    }
}