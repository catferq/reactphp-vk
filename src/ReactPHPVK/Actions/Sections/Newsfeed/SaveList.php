<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates and edits user newsfeed lists
 */
class SaveList
{
    private Provider $_provider;
    
    private int $listId = 0;
    private string $title = '';
    private array $sourceIds = [];
    private bool $noReposts = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveList
     */
    public function _setCustom(array $value): SaveList
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * numeric list identifier (if not sent, will be set automatically).
     * 
     * @param int $value
     * @return SaveList
     */
    public function setListId(int $value): SaveList
    {
        $this->listId = $value;
        return $this;
    }

    /**
     * list name.
     * 
     * @param string $value
     * @return SaveList
     */
    public function setTitle(string $value): SaveList
    {
        $this->title = $value;
        return $this;
    }

    /**
     * users and communities identifiers to be added to the list. Community identifiers must be negative numbers.
     * 
     * @param array $value
     * @return SaveList
     */
    public function setSourceIds(array $value): SaveList
    {
        $this->sourceIds = $value;
        return $this;
    }

    /**
     * reposts display on and off ('1' is for off).
     * 
     * @param bool $value
     * @return SaveList
     */
    public function setNoReposts(bool $value): SaveList
    {
        $this->noReposts = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->listId !== 0) $params['list_id'] = $this->listId;
        $params['title'] = $this->title;
        if ($this->sourceIds !== []) $params['source_ids'] = implode(',', $this->sourceIds);
        if ($this->noReposts !== false) $params['no_reposts'] = intval($this->noReposts);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->listId = 0;
            $this->title = '';
            $this->sourceIds = [];
            $this->noReposts = false;
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.saveList', $params);
    }
}