<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of notes created by a user.
 */
class Get
{
    private Provider $_provider;
    
    private array $noteIds = [];
    private int $userId = 0;
    private int $offset = 0;
    private int $count = 20;
    private int $sort = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Note IDs.
     * 
     * @param array $value
     * @return Get
     */
    public function setNoteIds(array $value): Get
    {
        $this->noteIds = $value;
        return $this;
    }

    /**
     * Note owner ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setUserId(int $value): Get
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of notes to return.
     * 
     * @param int $value
     * @return Get
     */
    public function setCount(int $value): Get
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setSort(int $value): Get
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->noteIds !== []) $params['note_ids'] = implode(',', $this->noteIds);
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->noteIds = [];
            $this->userId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->sort = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('notes.get', $params);
    }
}