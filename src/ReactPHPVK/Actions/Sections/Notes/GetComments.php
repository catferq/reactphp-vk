<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments on a note.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $noteId = 0;
    private int $ownerId = 0;
    private int $sort = 0;
    private int $offset = 0;
    private int $count = 20;
    
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
     * Note ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setNoteId(int $value): GetComments
    {
        $this->noteId = $value;
        return $this;
    }

    /**
     * Note owner ID.
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
     * @param int $value
     * @return GetComments
     */
    public function setSort(int $value): GetComments
    {
        $this->sort = $value;
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
     * Number of comments to return.
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
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['note_id'] = $this->noteId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->noteId = 0;
            $this->ownerId = 0;
            $this->sort = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->_custom = [];
        }

        return $this->_provider->request('notes.getComments', $params);
    }
}