<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the server address for photo upload.
 */
class GetUploadServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $albumId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetUploadServer
     */
    public function _setCustom(array $value): GetUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of community that owns the album (if the photo will be uploaded to a community album).
     * 
     * @param int $value
     * @return GetUploadServer
     */
    public function setGroupId(int $value): GetUploadServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetUploadServer
     */
    public function setAlbumId(int $value): GetUploadServer
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->albumId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getUploadServer', $params);
    }
}