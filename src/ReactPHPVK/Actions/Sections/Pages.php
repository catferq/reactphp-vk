<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Pages
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Allows to clear the cache of particular 'external' pages which may be attached to VK posts.
     * 
     * @param string $url Address of the page where you need to refesh the cached version
     * @param array|null $custom
     * @return Promise
     */
    function clearCache(string $url, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['url'] = $url;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.clearCache', $sendParams);
    }

    /**
     * Returns information about a wiki page.
     * 
     * @param int|null $ownerId Page owner ID.
     * @param int|null $pageId Wiki page ID.
     * @param bool|null $global '1' — to return information about a global wiki page
     * @param bool|null $sitePreview '1' — resulting wiki page is a preview for the attached link
     * @param string|null $title Wiki page title.
     * @param bool|null $needSource
     * @param bool|null $needHtml '1' — to return the page as HTML,
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $ownerId = 0, ?int $pageId = 0, ?bool $global = false, ?bool $sitePreview = false, ?string $title = '', ?bool $needSource = false, ?bool $needHtml = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($pageId !== 0 && $pageId != null) $sendParams['page_id'] = $pageId;
        if ($global !== false && $global != null) $sendParams['global'] = intval($global);
        if ($sitePreview !== false && $sitePreview != null) $sendParams['site_preview'] = intval($sitePreview);
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($needSource !== false && $needSource != null) $sendParams['need_source'] = intval($needSource);
        if ($needHtml !== false && $needHtml != null) $sendParams['need_html'] = intval($needHtml);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.get', $sendParams);
    }

    /**
     * Returns a list of all previous versions of a wiki page.
     * 
     * @param int $pageId Wiki page ID.
     * @param int|null $groupId ID of the community that owns the wiki page.
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function getHistory(int $pageId, ?int $groupId = 0, ?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['page_id'] = $pageId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.getHistory', $sendParams);
    }

    /**
     * Returns a list of wiki pages in a group.
     * 
     * @param int|null $groupId ID of the community that owns the wiki page.
     * @param array|null $custom
     * @return Promise
     */
    function getTitles(?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.getTitles', $sendParams);
    }

    /**
     * Returns the text of one of the previous versions of a wiki page.
     * 
     * @param int $versionId
     * @param int|null $groupId ID of the community that owns the wiki page.
     * @param int|null $userId
     * @param bool|null $needHtml '1' — to return the page as HTML
     * @param array|null $custom
     * @return Promise
     */
    function getVersion(int $versionId, ?int $groupId = 0, ?int $userId = 0, ?bool $needHtml = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['version_id'] = $versionId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($needHtml !== false && $needHtml != null) $sendParams['need_html'] = intval($needHtml);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.getVersion', $sendParams);
    }

    /**
     * Returns HTML representation of the wiki markup.
     * 
     * @param string $text Text of the wiki page.
     * @param int|null $groupId ID of the group in the context of which this markup is interpreted.
     * @param array|null $custom
     * @return Promise
     */
    function parseWiki(string $text, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['text'] = $text;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.parseWiki', $sendParams);
    }

    /**
     * Saves the text of a wiki page.
     * 
     * @param string|null $text Text of the wiki page in wiki-format.
     * @param int|null $pageId Wiki page ID. The 'title' parameter can be passed instead of 'pid'.
     * @param int|null $groupId ID of the community that owns the wiki page.
     * @param int|null $userId User ID
     * @param string|null $title Wiki page title.
     * @param array|null $custom
     * @return Promise
     */
    function save(?string $text = '', ?int $pageId = 0, ?int $groupId = 0, ?int $userId = 0, ?string $title = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($text !== '' && $text != null) $sendParams['text'] = $text;
        if ($pageId !== 0 && $pageId != null) $sendParams['page_id'] = $pageId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.save', $sendParams);
    }

    /**
     * Saves modified read and edit access settings for a wiki page.
     * 
     * @param int $pageId Wiki page ID.
     * @param int|null $groupId ID of the community that owns the wiki page.
     * @param int|null $userId
     * @param int|null $view Who can view the wiki page: '1' — only community members, '2' — all users can view the page, '0' — only community managers
     * @param int|null $edit Who can edit the wiki page: '1' — only community members, '2' — all users can edit the page, '0' — only community managers
     * @param array|null $custom
     * @return Promise
     */
    function saveAccess(int $pageId, ?int $groupId = 0, ?int $userId = 0, ?int $view = 0, ?int $edit = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['page_id'] = $pageId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($view !== 0 && $view != null) $sendParams['view'] = $view;
        if ($edit !== 0 && $edit != null) $sendParams['edit'] = $edit;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('pages.saveAccess', $sendParams);
    }
}