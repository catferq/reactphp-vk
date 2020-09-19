<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves the text of a wiki page.
 */
class Save
{
    private Provider $_provider;
    
    private string $text = '';
    private int $pageId = 0;
    private int $groupId = 0;
    private int $userId = 0;
    private string $title = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Save
     */
    public function _setCustom(array $value): Save
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Text of the wiki page in wiki-format.
     * 
     * @param string $value
     * @return Save
     */
    public function setText(string $value): Save
    {
        $this->text = $value;
        return $this;
    }

    /**
     * Wiki page ID. The 'title' parameter can be passed instead of 'pid'.
     * 
     * @param int $value
     * @return Save
     */
    public function setPageId(int $value): Save
    {
        $this->pageId = $value;
        return $this;
    }

    /**
     * ID of the community that owns the wiki page.
     * 
     * @param int $value
     * @return Save
     */
    public function setGroupId(int $value): Save
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * User ID
     * 
     * @param int $value
     * @return Save
     */
    public function setUserId(int $value): Save
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Wiki page title.
     * 
     * @param string $value
     * @return Save
     */
    public function setTitle(string $value): Save
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->pageId !== 0) $params['page_id'] = $this->pageId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->text = '';
            $this->pageId = 0;
            $this->groupId = 0;
            $this->userId = 0;
            $this->title = '';
            $this->_custom = [];
        }

        return $this->_provider->request('pages.save', $params);
    }
}