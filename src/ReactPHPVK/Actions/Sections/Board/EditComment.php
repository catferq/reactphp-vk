<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a comment on a topic on a community's discussion board.
 */
class EditComment
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $topicId = 0;
    private int $commentId = 0;
    private string $message = '';
    private array $attachments = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditComment
     */
    public function _setCustom(array $value): EditComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return EditComment
     */
    public function setGroupId(int $value): EditComment
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic ID.
     * 
     * @param int $value
     * @return EditComment
     */
    public function setTopicId(int $value): EditComment
    {
        $this->topicId = $value;
        return $this;
    }

    /**
     * ID of the comment on the topic.
     * 
     * @param int $value
     * @return EditComment
     */
    public function setCommentId(int $value): EditComment
    {
        $this->commentId = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set). New comment text.
     * 
     * @param string $value
     * @return EditComment
     */
    public function setMessage(string $value): EditComment
    {
        $this->message = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media object: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. Example: "photo100172_166443618,photo66748_265827614"
     * 
     * @param array $value
     * @return EditComment
     */
    public function setAttachments(array $value): EditComment
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['topic_id'] = $this->topicId;
        $params['comment_id'] = $this->commentId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->commentId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->_custom = [];
        }

        return $this->_provider->request('board.editComment', $params);
    }
}