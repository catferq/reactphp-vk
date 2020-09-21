<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits the title of a video album.
 */
class EditAlbum
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $albumId = 0;
    private string $title = '';
    private array $privacy = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditAlbum
     */
    public function _setCustom(array $value): EditAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID (if the album edited is owned by a community).
     * 
     * @param int $value
     * @return EditAlbum
     */
    public function setGroupId(int $value): EditAlbum
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Album ID.
     * 
     * @param int $value
     * @return EditAlbum
     */
    public function setAlbumId(int $value): EditAlbum
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * New album title.
     * 
     * @param string $value
     * @return EditAlbum
     */
    public function setTitle(string $value): EditAlbum
    {
        $this->title = $value;
        return $this;
    }

    /**
     * new access permissions for the album. Possible values: , *'0' – all users,, *'1' – friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
     * 
     * @param array $value
     * @return EditAlbum
     */
    public function setPrivacy(array $value): EditAlbum
    {
        $this->privacy = $value;
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
        $params['album_id'] = $this->albumId;
        $params['title'] = $this->title;
        if ($this->privacy !== []) $params['privacy'] = implode(',', $this->privacy);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->albumId = 0;
            $this->title = '';
            $this->privacy = [];
            $this->_custom = [];
        }

        return $this->_provider->request('video.editAlbum', $params);
    }
}