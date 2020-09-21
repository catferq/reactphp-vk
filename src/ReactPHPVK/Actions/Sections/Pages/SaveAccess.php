<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves modified read and edit access settings for a wiki page.
 */
class SaveAccess
{
    private Provider $_provider;
    
    private int $pageId = 0;
    private int $groupId = 0;
    private int $userId = 0;
    private int $view = 0;
    private int $edit = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveAccess
     */
    public function _setCustom(array $value): SaveAccess
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Wiki page ID.
     * 
     * @param int $value
     * @return SaveAccess
     */
    public function setPageId(int $value): SaveAccess
    {
        $this->pageId = $value;
        return $this;
    }

    /**
     * ID of the community that owns the wiki page.
     * 
     * @param int $value
     * @return SaveAccess
     */
    public function setGroupId(int $value): SaveAccess
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SaveAccess
     */
    public function setUserId(int $value): SaveAccess
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Who can view the wiki page: '1' — only community members, '2' — all users can view the page, '0' — only community managers
     * 
     * @param int $value
     * @return SaveAccess
     */
    public function setView(int $value): SaveAccess
    {
        $this->view = $value;
        return $this;
    }

    /**
     * Who can edit the wiki page: '1' — only community members, '2' — all users can edit the page, '0' — only community managers
     * 
     * @param int $value
     * @return SaveAccess
     */
    public function setEdit(int $value): SaveAccess
    {
        $this->edit = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['page_id'] = $this->pageId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->view !== 0) $params['view'] = $this->view;
        if ($this->edit !== 0) $params['edit'] = $this->edit;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->pageId = 0;
            $this->groupId = 0;
            $this->userId = 0;
            $this->view = 0;
            $this->edit = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('pages.saveAccess', $params);
    }
}