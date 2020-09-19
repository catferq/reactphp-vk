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

    private ?Stories\BanOwner $banOwner = null;
    private ?Stories\Delete $delete = null;
    private ?Stories\Get $get = null;
    private ?Stories\GetBanned $getBanned = null;
    private ?Stories\GetById $getById = null;
    private ?Stories\GetPhotoUploadServer $getPhotoUploadServer = null;
    private ?Stories\GetReplies $getReplies = null;
    private ?Stories\GetStats $getStats = null;
    private ?Stories\GetVideoUploadServer $getVideoUploadServer = null;
    private ?Stories\GetViewers $getViewers = null;
    private ?Stories\HideAllReplies $hideAllReplies = null;
    private ?Stories\HideReply $hideReply = null;
    private ?Stories\Search $search = null;
    private ?Stories\UnbanOwner $unbanOwner = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to hide stories from chosen sources from current user's feed.
     */
    public function banOwner(): BanOwner
    {
        if (!$this->banOwner) {
            $this->banOwner = new BanOwner($this->_provider);
        }
        return $this->banOwner;
    }

    /**
     * Allows to delete story.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Returns stories available for current user.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns list of sources hidden from current user's feed.
     */
    public function getBanned(): GetBanned
    {
        if (!$this->getBanned) {
            $this->getBanned = new GetBanned($this->_provider);
        }
        return $this->getBanned;
    }

    /**
     * Returns story by its ID.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns URL for uploading a story with photo.
     */
    public function getPhotoUploadServer(): GetPhotoUploadServer
    {
        if (!$this->getPhotoUploadServer) {
            $this->getPhotoUploadServer = new GetPhotoUploadServer($this->_provider);
        }
        return $this->getPhotoUploadServer;
    }

    /**
     * Returns replies to the story.
     */
    public function getReplies(): GetReplies
    {
        if (!$this->getReplies) {
            $this->getReplies = new GetReplies($this->_provider);
        }
        return $this->getReplies;
    }

    /**
     * Returns stories available for current user.
     */
    public function getStats(): GetStats
    {
        if (!$this->getStats) {
            $this->getStats = new GetStats($this->_provider);
        }
        return $this->getStats;
    }

    /**
     * Allows to receive URL for uploading story with video.
     */
    public function getVideoUploadServer(): GetVideoUploadServer
    {
        if (!$this->getVideoUploadServer) {
            $this->getVideoUploadServer = new GetVideoUploadServer($this->_provider);
        }
        return $this->getVideoUploadServer;
    }

    /**
     * Returns a list of story viewers.
     */
    public function getViewers(): GetViewers
    {
        if (!$this->getViewers) {
            $this->getViewers = new GetViewers($this->_provider);
        }
        return $this->getViewers;
    }

    /**
     * Hides all replies in the last 24 hours from the user to current user's stories.
     */
    public function hideAllReplies(): HideAllReplies
    {
        if (!$this->hideAllReplies) {
            $this->hideAllReplies = new HideAllReplies($this->_provider);
        }
        return $this->hideAllReplies;
    }

    /**
     * Hides the reply to the current user's story.
     */
    public function hideReply(): HideReply
    {
        if (!$this->hideReply) {
            $this->hideReply = new HideReply($this->_provider);
        }
        return $this->hideReply;
    }

    /**
     * 
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

    /**
     * Allows to show stories from hidden sources in current user's feed.
     */
    public function unbanOwner(): UnbanOwner
    {
        if (!$this->unbanOwner) {
            $this->unbanOwner = new UnbanOwner($this->_provider);
        }
        return $this->unbanOwner;
    }

}