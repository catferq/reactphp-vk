<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a new comment on a note.
 */
class CreateComment
{
    private Provider $_provider;
    
    private int $noteId = 0;
    private int $ownerId = 0;
    private int $replyTo = 0;
    private string $message = '';
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
     * Note ID.
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setNoteId(int $value): CreateComment
    {
        $this->noteId = $value;
        return $this;
    }

    /**
     * Note owner ID.
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
     * ID of the user to whom the reply is addressed (if the comment is a reply to another comment).
     * 
     * @param int $value
     * @return CreateComment
     */
    public function setReplyTo(int $value): CreateComment
    {
        $this->replyTo = $value;
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

        $params['note_id'] = $this->noteId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->replyTo !== 0) $params['reply_to'] = $this->replyTo;
        $params['message'] = $this->message;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->noteId = 0;
            $this->ownerId = 0;
            $this->replyTo = 0;
            $this->message = '';
            $this->guid = '';
            $this->_custom = [];
        }

        return $this->_provider->request('notes.createComment', $params);
    }
}