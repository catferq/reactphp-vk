<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a comment on a note.
 */
class EditComment
{
    private Provider $_provider;
    
    private int $commentId = 0;
    private int $ownerId = 0;
    private string $message = '';
    
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
     * Note owner ID.
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['comment_id'] = $this->commentId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['message'] = $this->message;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->commentId = 0;
            $this->ownerId = 0;
            $this->message = '';
            $this->_custom = [];
        }

        return $this->_provider->request('notes.editComment', $params);
    }
}