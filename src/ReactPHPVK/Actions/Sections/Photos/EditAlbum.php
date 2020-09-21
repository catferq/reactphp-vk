<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits information about a photo album.
 */
class EditAlbum
{
    private Provider $_provider;
    
    private int $albumId = 0;
    private string $title = '';
    private string $description = '';
    private int $ownerId = 0;
    private array $privacyView = [];
    private array $privacyComment = [];
    private bool $uploadByAdminsOnly = false;
    private bool $commentsDisabled = false;
    
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
     * ID of the photo album to be edited.
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
     * New album description.
     * 
     * @param string $value
     * @return EditAlbum
     */
    public function setDescription(string $value): EditAlbum
    {
        $this->description = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the album.
     * 
     * @param int $value
     * @return EditAlbum
     */
    public function setOwnerId(int $value): EditAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return EditAlbum
     */
    public function setPrivacyView(array $value): EditAlbum
    {
        $this->privacyView = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return EditAlbum
     */
    public function setPrivacyComment(array $value): EditAlbum
    {
        $this->privacyComment = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return EditAlbum
     */
    public function setUploadByAdminsOnly(bool $value): EditAlbum
    {
        $this->uploadByAdminsOnly = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return EditAlbum
     */
    public function setCommentsDisabled(bool $value): EditAlbum
    {
        $this->commentsDisabled = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['album_id'] = $this->albumId;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->description !== '') $params['description'] = $this->description;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->privacyView !== []) $params['privacy_view'] = implode(',', $this->privacyView);
        if ($this->privacyComment !== []) $params['privacy_comment'] = implode(',', $this->privacyComment);
        if ($this->uploadByAdminsOnly !== false) $params['upload_by_admins_only'] = intval($this->uploadByAdminsOnly);
        if ($this->commentsDisabled !== false) $params['comments_disabled'] = intval($this->commentsDisabled);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->albumId = 0;
            $this->title = '';
            $this->description = '';
            $this->ownerId = 0;
            $this->privacyView = [];
            $this->privacyComment = [];
            $this->uploadByAdminsOnly = false;
            $this->commentsDisabled = false;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.editAlbum', $params);
    }
}