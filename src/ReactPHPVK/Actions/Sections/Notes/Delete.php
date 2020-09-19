<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a note of the current user.
 */
class Delete
{
    private Provider $_provider;
    
    private int $noteId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Delete
     */
    public function _setCustom(array $value): Delete
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Note ID.
     * 
     * @param int $value
     * @return Delete
     */
    public function setNoteId(int $value): Delete
    {
        $this->noteId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->noteId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('notes.delete', $params);
    }
}