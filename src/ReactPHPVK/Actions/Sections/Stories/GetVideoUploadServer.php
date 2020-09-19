<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to receive URL for uploading story with video.
 */
class GetVideoUploadServer
{
    private Provider $_provider;
    
    private bool $addToNews = false;
    private array $userIds = [];
    private string $replyToStory = '';
    private string $linkText = '';
    private string $linkUrl = '';
    private int $groupId = 0;
    private string $clickableStickers = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetVideoUploadServer
     */
    public function _setCustom(array $value): GetVideoUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * 1 — to add the story to friend's feed.
     * 
     * @param bool $value
     * @return GetVideoUploadServer
     */
    public function setAddToNews(bool $value): GetVideoUploadServer
    {
        $this->addToNews = $value;
        return $this;
    }

    /**
     * List of users IDs who can see the story.
     * 
     * @param array $value
     * @return GetVideoUploadServer
     */
    public function setUserIds(array $value): GetVideoUploadServer
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * ID of the story to reply with the current.
     * 
     * @param string $value
     * @return GetVideoUploadServer
     */
    public function setReplyToStory(string $value): GetVideoUploadServer
    {
        $this->replyToStory = $value;
        return $this;
    }

    /**
     * Link text (for community's stories only).
     * 
     * @param string $value
     * @return GetVideoUploadServer
     */
    public function setLinkText(string $value): GetVideoUploadServer
    {
        $this->linkText = $value;
        return $this;
    }

    /**
     * Link URL. Internal links on https://vk.com only.
     * 
     * @param string $value
     * @return GetVideoUploadServer
     */
    public function setLinkUrl(string $value): GetVideoUploadServer
    {
        $this->linkUrl = $value;
        return $this;
    }

    /**
     * ID of the community to upload the story (should be verified or with the "fire" icon).
     * 
     * @param int $value
     * @return GetVideoUploadServer
     */
    public function setGroupId(int $value): GetVideoUploadServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetVideoUploadServer
     */
    public function setClickableStickers(string $value): GetVideoUploadServer
    {
        $this->clickableStickers = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->addToNews !== false) $params['add_to_news'] = intval($this->addToNews);
        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->replyToStory !== '') $params['reply_to_story'] = $this->replyToStory;
        if ($this->linkText !== '') $params['link_text'] = $this->linkText;
        if ($this->linkUrl !== '') $params['link_url'] = $this->linkUrl;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->clickableStickers !== '') $params['clickable_stickers'] = $this->clickableStickers;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->addToNews = false;
            $this->userIds = [];
            $this->replyToStory = '';
            $this->linkText = '';
            $this->linkUrl = '';
            $this->groupId = 0;
            $this->clickableStickers = '';
            $this->_custom = [];
        }

        return $this->_provider->request('stories.getVideoUploadServer', $params);
    }
}