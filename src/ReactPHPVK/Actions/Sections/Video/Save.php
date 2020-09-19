<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a server address (required for upload) and video data.
 */
class Save
{
    private Provider $_provider;
    
    private string $name = '';
    private string $description = '';
    private bool $isPrivate = false;
    private bool $wallpost = false;
    private string $link = '';
    private int $groupId = 0;
    private int $albumId = 0;
    private array $privacyView = [];
    private array $privacyComment = [];
    private bool $noComments = false;
    private bool $repeat = false;
    private bool $compression = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Save
     */
    public function _setCustom(array $value): Save
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Name of the video.
     * 
     * @param string $value
     * @return Save
     */
    public function setName(string $value): Save
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Description of the video.
     * 
     * @param string $value
     * @return Save
     */
    public function setDescription(string $value): Save
    {
        $this->description = $value;
        return $this;
    }

    /**
     * '1' — to designate the video as private (send it via a private message), the video will not appear on the user's video list and will not be available by ID for other users, '0' — not to designate the video as private
     * 
     * @param bool $value
     * @return Save
     */
    public function setIsPrivate(bool $value): Save
    {
        $this->isPrivate = $value;
        return $this;
    }

    /**
     * '1' — to post the saved video on a user's wall, '0' — not to post the saved video on a user's wall
     * 
     * @param bool $value
     * @return Save
     */
    public function setWallpost(bool $value): Save
    {
        $this->wallpost = $value;
        return $this;
    }

    /**
     * URL for embedding the video from an external website.
     * 
     * @param string $value
     * @return Save
     */
    public function setLink(string $value): Save
    {
        $this->link = $value;
        return $this;
    }

    /**
     * ID of the community in which the video will be saved. By default, the current user's page.
     * 
     * @param int $value
     * @return Save
     */
    public function setGroupId(int $value): Save
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * ID of the album to which the saved video will be added.
     * 
     * @param int $value
     * @return Save
     */
    public function setAlbumId(int $value): Save
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Save
     */
    public function setPrivacyView(array $value): Save
    {
        $this->privacyView = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Save
     */
    public function setPrivacyComment(array $value): Save
    {
        $this->privacyComment = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Save
     */
    public function setNoComments(bool $value): Save
    {
        $this->noComments = $value;
        return $this;
    }

    /**
     * '1' — to repeat the playback of the video, '0' — to play the video once,
     * 
     * @param bool $value
     * @return Save
     */
    public function setRepeat(bool $value): Save
    {
        $this->repeat = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Save
     */
    public function setCompression(bool $value): Save
    {
        $this->compression = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->name !== '') $params['name'] = $this->name;
        if ($this->description !== '') $params['description'] = $this->description;
        if ($this->isPrivate !== false) $params['is_private'] = intval($this->isPrivate);
        if ($this->wallpost !== false) $params['wallpost'] = intval($this->wallpost);
        if ($this->link !== '') $params['link'] = $this->link;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->albumId !== 0) $params['album_id'] = $this->albumId;
        if ($this->privacyView !== []) $params['privacy_view'] = implode(',', $this->privacyView);
        if ($this->privacyComment !== []) $params['privacy_comment'] = implode(',', $this->privacyComment);
        if ($this->noComments !== false) $params['no_comments'] = intval($this->noComments);
        if ($this->repeat !== false) $params['repeat'] = intval($this->repeat);
        if ($this->compression !== false) $params['compression'] = intval($this->compression);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->name = '';
            $this->description = '';
            $this->isPrivate = false;
            $this->wallpost = false;
            $this->link = '';
            $this->groupId = 0;
            $this->albumId = 0;
            $this->privacyView = [];
            $this->privacyComment = [];
            $this->noComments = false;
            $this->repeat = false;
            $this->compression = false;
            $this->_custom = [];
        }

        return $this->_provider->request('video.save', $params);
    }
}