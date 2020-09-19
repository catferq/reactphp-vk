<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a new comment for an item.
 */
class CreateComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $itemId = 0;
    private string $message = '';
    private array $attachments = [];
    private bool $fromGroup = false;
    private int $replyToComment = 0;
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
     * ID of an item owner community.
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
     * Item ID.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setItemId(int $value): CreateComment
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Comment text (required if 'attachments' parameter is not specified)
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
     * Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
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
     * '1' - comment will be published on behalf of a community, '0' - on behalf of a user (by default).
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
     * ID of a comment to reply with current comment to.
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
     * Random value to avoid resending one comment.
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

        $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->fromGroup !== false) $params['from_group'] = intval($this->fromGroup);
        if ($this->replyToComment !== 0) $params['reply_to_comment'] = $this->replyToComment;
        if ($this->stickerId !== 0) $params['sticker_id'] = $this->stickerId;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->fromGroup = false;
            $this->replyToComment = 0;
            $this->stickerId = 0;
            $this->guid = '';
            $this->_custom = [];
        }

        return $this->_provider->request('market.createComment', $params);
    }
}