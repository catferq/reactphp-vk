<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes an item's comment
 */
class DeleteComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $commentId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteComment
     */
    public function _setCustom(array $value): DeleteComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * 
     * @param int $value
     * @return DeleteComment
     */
    public function setOwnerId(int $value): DeleteComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * comment id
     * 
     * @param int $value
     * @return DeleteComment
     */
    public function setCommentId(int $value): DeleteComment
    {
        $this->commentId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['comment_id'] = $this->commentId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->commentId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.deleteComment', $params);
    }
}