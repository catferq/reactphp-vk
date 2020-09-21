<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a comment on a user wall or community wall.
 */
class EditComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
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
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return EditComment
     */
    public function setOwnerId(int $value): EditComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Comment ID.
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
     * New comment text.
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
     * List of objects attached to the comment, in the following format: , "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. For example: "photo100172_166443618,photo66748_265827614"
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

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['comment_id'] = $this->commentId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->commentId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->_custom = [];
        }

        return $this->_provider->request('wall.editComment', $params);
    }
}