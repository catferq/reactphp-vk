<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a photo album belonging to the current user.
 */
class DeleteAlbum
{
    private Provider $_provider;
    
    private int $albumId = 0;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteAlbum
     */
    public function _setCustom(array $value): DeleteAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Album ID.
     * 
     * @param int $value
     * @return DeleteAlbum
     */
    public function setAlbumId(int $value): DeleteAlbum
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * ID of the community that owns the album.
     * 
     * @param int $value
     * @return DeleteAlbum
     */
    public function setGroupId(int $value): DeleteAlbum
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['album_id'] = $this->albumId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->albumId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.deleteAlbum', $params);
    }
}