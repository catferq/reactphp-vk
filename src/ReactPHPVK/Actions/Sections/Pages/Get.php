<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about a wiki page.
 */
class Get
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $pageId = 0;
    private bool $global = false;
    private bool $sitePreview = false;
    private string $title = '';
    private bool $needSource = false;
    private bool $needHtml = false;
    
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
     * Page owner ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setOwnerId(int $value): Get
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Wiki page ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setPageId(int $value): Get
    {
        $this->pageId = $value;
        return $this;
    }

    /**
     * '1' — to return information about a global wiki page
     * 
     * @param bool $value
     * @return Get
     */
    public function setGlobal(bool $value): Get
    {
        $this->global = $value;
        return $this;
    }

    /**
     * '1' — resulting wiki page is a preview for the attached link
     * 
     * @param bool $value
     * @return Get
     */
    public function setSitePreview(bool $value): Get
    {
        $this->sitePreview = $value;
        return $this;
    }

    /**
     * Wiki page title.
     * 
     * @param string $value
     * @return Get
     */
    public function setTitle(string $value): Get
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Get
     */
    public function setNeedSource(bool $value): Get
    {
        $this->needSource = $value;
        return $this;
    }

    /**
     * '1' — to return the page as HTML,
     * 
     * @param bool $value
     * @return Get
     */
    public function setNeedHtml(bool $value): Get
    {
        $this->needHtml = $value;
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
        if ($this->pageId !== 0) $params['page_id'] = $this->pageId;
        if ($this->global !== false) $params['global'] = intval($this->global);
        if ($this->sitePreview !== false) $params['site_preview'] = intval($this->sitePreview);
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->needSource !== false) $params['need_source'] = intval($this->needSource);
        if ($this->needHtml !== false) $params['need_html'] = intval($this->needHtml);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->pageId = 0;
            $this->global = false;
            $this->sitePreview = false;
            $this->title = '';
            $this->needSource = false;
            $this->needHtml = false;
            $this->_custom = [];
        }

        return $this->_provider->request('pages.get', $params);
    }
}