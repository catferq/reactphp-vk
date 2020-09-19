<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Restores a deleted comment on a note.
 */
class RestoreComment
{
    private Provider $_provider;
    
    private int $commentId = 0;
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RestoreComment
     */
    public function _setCustom(array $value): RestoreComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Comment ID.
     * 
     * @param int $value
     * @return RestoreComment
     */
    public function setCommentId(int $value): RestoreComment
    {
        $this->commentId = $value;
        return $this;
    }

    /**
     * Note owner ID.
     * 
     * @param int $value
     * @return RestoreComment
     */
    public function setOwnerId(int $value): RestoreComment
    {
        $this->ownerId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->commentId = 0;
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('notes.restoreComment', $params);
    }
}