<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a new comment on the photo.
 */
class CreateComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private string $message = '';
    private array $attachments = [];
    private bool $fromGroup = false;
    private int $replyToComment = 0;
    private int $stickerId = 0;
    private string $accessKey = '';
    private string $guid = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CreateComment
     */
    public function _setCustom(array $value): CreateComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setOwnerId(int $value): CreateComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setPhotoId(int $value): CreateComment
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * Comment text.
     * 
     * @param string $value
     * @return CreateComment
     */
    public function setMessage(string $value): CreateComment
    {
        $this->message = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — Media attachment owner ID. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
     * 
     * @param array $value
     * @return CreateComment
     */
    public function setAttachments(array $value): CreateComment
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * '1' — to post a comment from the community
     * 
     * @param bool $value
     * @return CreateComment
     */
    public function setFromGroup(bool $value): CreateComment
    {
        $this->fromGroup = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CreateComment
     */
    public function setReplyToComment(int $value): CreateComment
    {
        $this->replyToComment = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CreateComment
     */
    public function setStickerId(int $value): CreateComment
    {
        $this->stickerId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return CreateComment
     */
    public function setAccessKey(string $value): CreateComment
    {
        $this->accessKey = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return CreateComment
     */
    public function setGuid(string $value): CreateComment
    {
        $this->guid = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['photo_id'] = $this->photoId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->fromGroup !== false) $params['from_group'] = intval($this->fromGroup);
        if ($this->replyToComment !== 0) $params['reply_to_comment'] = $this->replyToComment;
        if ($this->stickerId !== 0) $params['sticker_id'] = $this->stickerId;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->fromGroup = false;
            $this->replyToComment = 0;
            $this->stickerId = 0;
            $this->accessKey = '';
            $this->guid = '';
            $this->_custom = [];
        }

        return $this->_provider->request('photos.createComment', $params);
    }
}