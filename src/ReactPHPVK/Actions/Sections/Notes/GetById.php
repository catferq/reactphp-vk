<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a note by its ID.
 */
class GetById
{
    private Provider $_provider;
    
    private int $noteId = 0;
    private int $ownerId = 0;
    private bool $needWiki = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Note ID.
     * 
     * @param int $value
     * @return GetById
     */
    public function setNoteId(int $value): GetById
    {
        $this->noteId = $value;
        return $this;
    }

    /**
     * Note owner ID.
     * 
     * @param int $value
     * @return GetById
     */
    public function setOwnerId(int $value): GetById
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetById
     */
    public function setNeedWiki(bool $value): GetById
    {
        $this->needWiki = $value;
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
        if ($this->needWiki !== false) $params['need_wiki'] = intval($this->needWiki);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->noteId = 0;
            $this->ownerId = 0;
            $this->needWiki = false;
            $this->_custom = [];
        }

        return $this->_provider->request('notes.getById', $params);
    }
}