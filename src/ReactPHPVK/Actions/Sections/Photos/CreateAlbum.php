<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates an empty photo album.
 */
class CreateAlbum
{
    private Provider $_provider;
    
    private string $title = '';
    private int $groupId = 0;
    private string $description = '';
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
     * @return CreateAlbum
     */
    public function _setCustom(array $value): CreateAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Album title.
     * 
     * @param string $value
     * @return CreateAlbum
     */
    public function setTitle(string $value): CreateAlbum
    {
        $this->title = $value;
        return $this;
    }

    /**
     * ID of the community in which the album will be created.
     * 
     * @param int $value
     * @return CreateAlbum
     */
    public function setGroupId(int $value): CreateAlbum
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Album description.
     * 
     * @param string $value
     * @return CreateAlbum
     */
    public function setDescription(string $value): CreateAlbum
    {
        $this->description = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return CreateAlbum
     */
    public function setPrivacyView(array $value): CreateAlbum
    {
        $this->privacyView = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return CreateAlbum
     */
    public function setPrivacyComment(array $value): CreateAlbum
    {
        $this->privacyComment = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return CreateAlbum
     */
    public function setUploadByAdminsOnly(bool $value): CreateAlbum
    {
        $this->uploadByAdminsOnly = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return CreateAlbum
     */
    public function setCommentsDisabled(bool $value): CreateAlbum
    {
        $this->commentsDisabled = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['title'] = $this->title;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->description !== '') $params['description'] = $this->description;
        if ($this->privacyView !== []) $params['privacy_view'] = implode(',', $this->privacyView);
        if ($this->privacyComment !== []) $params['privacy_comment'] = implode(',', $this->privacyComment);
        if ($this->uploadByAdminsOnly !== false) $params['upload_by_admins_only'] = intval($this->uploadByAdminsOnly);
        if ($this->commentsDisabled !== false) $params['comments_disabled'] = intval($this->commentsDisabled);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->title = '';
            $this->groupId = 0;
            $this->description = '';
            $this->privacyView = [];
            $this->privacyComment = [];
            $this->uploadByAdminsOnly = false;
            $this->commentsDisabled = false;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.createAlbum', $params);
    }
}