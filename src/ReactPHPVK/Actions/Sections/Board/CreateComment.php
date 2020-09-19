<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a comment on a topic on a community's discussion board.
 */
class CreateComment
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $topicId = 0;
    private string $message = '';
    private array $attachments = [];
    private bool $fromGroup = false;
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
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setGroupId(int $value): CreateComment
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * ID of the topic to be commented on.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setTopicId(int $value): CreateComment
    {
        $this->topicId = $value;
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
     * (Required if 'text' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media object: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID.
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
     * '1' — to post the comment as by the community, '0' — to post the comment as by the user (default)
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

        $params['group_id'] = $this->groupId;
        $params['topic_id'] = $this->topicId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->fromGroup !== false) $params['from_group'] = intval($this->fromGroup);
        if ($this->stickerId !== 0) $params['sticker_id'] = $this->stickerId;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->fromGroup = false;
            $this->stickerId = 0;
            $this->guid = '';
            $this->_custom = [];
        }

        return $this->_provider->request('board.createComment', $params);
    }
}