<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of video albums owned by a user or community.
 */
class GetAlbums
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $offset = 0;
    private int $count = 50;
    private bool $extended = false;
    private bool $needSystem = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAlbums
     */
    public function _setCustom(array $value): GetAlbums
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video album(s).
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setOwnerId(int $value): GetAlbums
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of video albums.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setOffset(int $value): GetAlbums
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of video albums to return.
     * 
     * @param int $value
     * @return GetAlbums
     */
    public function setCount(int $value): GetAlbums
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return additional information about album privacy settings for the current user
     * 
     * @param bool $value
     * @return GetAlbums
     */
    public function setExtended(bool $value): GetAlbums
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetAlbums
     */
    public function setNeedSystem(bool $value): GetAlbums
    {
        $this->needSystem = $value;
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
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 50) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->needSystem !== false) $params['need_system'] = intval($this->needSystem);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->offset = 0;
            $this->count = 50;
            $this->extended = false;
            $this->needSystem = false;
            $this->_custom = [];
        }

        return $this->_provider->request('video.getAlbums', $params);
    }
}