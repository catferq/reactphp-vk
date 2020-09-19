<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a comment to a post on a user wall or community wall.
 */
class CreateComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    private int $fromGroup = 0;
    private string $message = '';
    private int $replyToComment = 0;
    private array $attachments = [];
    private int $stickerId = 0;
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
     * User ID or community ID. Use a negative value to designate a community ID.
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
     * Post ID.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setPostId(int $value): CreateComment
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * Group ID.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setFromGroup(int $value): CreateComment
    {
        $this->fromGroup = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the comment.
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
     * ID of comment to reply.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setReplyToComment(int $value): CreateComment
    {
        $this->replyToComment = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media ojbect: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. For example: "photo100172_166443618,photo66748_265827614"
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
     * Sticker ID.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setStickerId(int $value): CreateComment
    {
        $this->stickerId = $value;
        return $this;
    }

    /**
     * Unique identifier to avoid repeated comments.
     * 
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
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['post_id'] = $this->postId;
        if ($this->fromGroup !== 0) $params['from_group'] = $this->fromGroup;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->replyToComment !== 0) $params['reply_to_comment'] = $this->replyToComment;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->stickerId !== 0) $params['sticker_id'] = $this->stickerId;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->fromGroup = 0;
            $this->message = '';
            $this->replyToComment = 0;
            $this->attachments = [];
            $this->stickerId = 0;
            $this->guid = '';
            $this->_custom = [];
        }

        return $this->_provider->request('wall.createComment', $params);
    }
}