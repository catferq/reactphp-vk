<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Stories\BanOwner;
use ReactPHPVK\Actions\Sections\Stories\Delete;
use ReactPHPVK\Actions\Sections\Stories\Get;
use ReactPHPVK\Actions\Sections\Stories\GetBanned;
use ReactPHPVK\Actions\Sections\Stories\GetById;
use ReactPHPVK\Actions\Sections\Stories\GetPhotoUploadServer;
use ReactPHPVK\Actions\Sections\Stories\GetReplies;
use ReactPHPVK\Actions\Sections\Stories\GetStats;
use ReactPHPVK\Actions\Sections\Stories\GetVideoUploadServer;
use ReactPHPVK\Actions\Sections\Stories\GetViewers;
use ReactPHPVK\Actions\Sections\Stories\HideAllReplies;
use ReactPHPVK\Actions\Sections\Stories\HideReply;
use ReactPHPVK\Actions\Sections\Stories\Search;
use ReactPHPVK\Actions\Sections\Stories\UnbanOwner;

class Stories
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to hide stories from chosen sources from current user's feed.
     */
    public function banOwner(): BanOwner
    {
        return new BanOwner($this->_provider);
    }

    /**
     * Allows to delete story.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Returns stories available for current user.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns list of sources hidden from current user's feed.
     */
    public function getBanned(): GetBanned
    {
        return new GetBanned($this->_provider);
    }

    /**
     * Returns story by its ID.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns URL for uploading a story with photo.
     */
    public function getPhotoUploadServer(): GetPhotoUploadServer
    {
        return new GetPhotoUploadServer($this->_provider);
    }

    /**
     * Returns replies to the story.
     */
    public function getReplies(): GetReplies
    {
        return new GetReplies($this->_provider);
    }

    /**
     * Returns stories available for current user.
     */
    public function getStats(): GetStats
    {
        return new GetStats($this->_provider);
    }

    /**
     * Allows to receive URL for uploading story with video.
     */
    public function getVideoUploadServer(): GetVideoUploadServer
    {
        return new GetVideoUploadServer($this->_provider);
    }

    /**
     * Returns a list of story viewers.
     */
    public function getViewers(): GetViewers
    {
        return new GetViewers($this->_provider);
    }

    /**
     * Hides all replies in the last 24 hours from the user to current user's stories.
     */
    public function hideAllReplies(): HideAllReplies
    {
        return new HideAllReplies($this->_provider);
    }

    /**
     * Hides the reply to the current user's story.
     */
    public function hideReply(): HideReply
    {
        return new HideReply($this->_provider);
    }

    /**
     * 
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

    /**
     * Allows to show stories from hidden sources in current user's feed.
     */
    public function unbanOwner(): UnbanOwner
    {
        return new UnbanOwner($this->_provider);
    }

}