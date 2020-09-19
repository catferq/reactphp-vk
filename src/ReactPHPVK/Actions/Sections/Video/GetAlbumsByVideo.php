<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetAlbumsByVideo
{
    private Provider $_provider;
    
    private int $targetId = 0;
    private int $ownerId = 0;
    private int $videoId = 0;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAlbumsByVideo
     */
    public function _setCustom(array $value): GetAlbumsByVideo
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetAlbumsByVideo
     */
    public function setTargetId(int $value): GetAlbumsByVideo
    {
        $this->targetId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetAlbumsByVideo
     */
    public function setOwnerId(int $value): GetAlbumsByVideo
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetAlbumsByVideo
     */
    public function setVideoId(int $value): GetAlbumsByVideo
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetAlbumsByVideo
     */
    public function setExtended(bool $value): GetAlbumsByVideo
    {
        $this->extended = $value;
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
        $params['owner_id'] = $this->ownerId;
        $params['video_id'] = $this->videoId;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->targetId = 0;
            $this->ownerId = 0;
            $this->videoId = 0;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('video.getAlbumsByVideo', $params);
    }
}