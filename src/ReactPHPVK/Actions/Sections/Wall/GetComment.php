<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a comment on a post on a user wall or community wall.
 */
class GetComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $commentId = 0;
    private bool $extended = false;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetComment
     */
    public function _setCustom(array $value): GetComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetComment
     */
    public function setOwnerId(int $value): GetComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Comment ID.
     * 
     * @param int $value
     * @return GetComment
     */
    public function setCommentId(int $value): GetComment
    {
        $this->commentId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetComment
     */
    public function setExtended(bool $value): GetComment
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetComment
     */
    public function setFields(array $value): GetComment
    {
        $this->fields = $value;
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
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->commentId = 0;
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('wall.getComment', $params);
    }
}