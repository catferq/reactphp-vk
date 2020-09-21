<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns comments list for an item.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $itemId = 0;
    private bool $needLikes = false;
    private int $startCommentId = 0;
    private int $offset = 0;
    private int $count = 20;
    private string $sort = 'asc';
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
     * @return GetComments
     */
    public function _setCustom(array $value): GetComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community
     * 
     * @param int $value
     * @return GetComments
     */
    public function setOwnerId(int $value): GetComments
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setItemId(int $value): GetComments
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * '1' — to return likes info.
     * 
     * @param bool $value
     * @return GetComments
     */
    public function setNeedLikes(bool $value): GetComments
    {
        $this->needLikes = $value;
        return $this;
    }

    /**
     * ID of a comment to start a list from (details below).
     * 
     * @param int $value
     * @return GetComments
     */
    public function setStartCommentId(int $value): GetComments
    {
        $this->startCommentId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setOffset(int $value): GetComments
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of results to return.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setCount(int $value): GetComments
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Sort order ('asc' — from old to new, 'desc' — from new to old)
     * 
     * @param string $value
     * @return GetComments
     */
    public function setSort(string $value): GetComments
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * '1' — comments will be returned as numbered objects, in addition lists of 'profiles' and 'groups' objects will be returned.
     * 
     * @param bool $value
     * @return GetComments
     */
    public function setExtended(bool $value): GetComments
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * List of additional profile fields to return. See the [vk.com/dev/fields|details]
     * 
     * @param array $value
     * @return GetComments
     */
    public function setFields(array $value): GetComments
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

        $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        if ($this->needLikes !== false) $params['need_likes'] = intval($this->needLikes);
        if ($this->startCommentId !== 0) $params['start_comment_id'] = $this->startCommentId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->sort !== 'asc') $params['sort'] = $this->sort;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->needLikes = false;
            $this->startCommentId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->sort = 'asc';
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('market.getComments', $params);
    }
}