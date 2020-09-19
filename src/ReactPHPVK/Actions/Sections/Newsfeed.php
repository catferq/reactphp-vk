<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Newsfeed\AddBan;
use ReactPHPVK\Actions\Sections\Newsfeed\DeleteBan;
use ReactPHPVK\Actions\Sections\Newsfeed\DeleteList;
use ReactPHPVK\Actions\Sections\Newsfeed\Get;
use ReactPHPVK\Actions\Sections\Newsfeed\GetBanned;
use ReactPHPVK\Actions\Sections\Newsfeed\GetComments;
use ReactPHPVK\Actions\Sections\Newsfeed\GetLists;
use ReactPHPVK\Actions\Sections\Newsfeed\GetMentions;
use ReactPHPVK\Actions\Sections\Newsfeed\GetRecommended;
use ReactPHPVK\Actions\Sections\Newsfeed\GetSuggestedSources;
use ReactPHPVK\Actions\Sections\Newsfeed\IgnoreItem;
use ReactPHPVK\Actions\Sections\Newsfeed\SaveList;
use ReactPHPVK\Actions\Sections\Newsfeed\Search;
use ReactPHPVK\Actions\Sections\Newsfeed\UnignoreItem;
use ReactPHPVK\Actions\Sections\Newsfeed\Unsubscribe;

class Newsfeed
{
    private Provider $_provider;

    private ?Newsfeed\AddBan $addBan = null;
    private ?Newsfeed\DeleteBan $deleteBan = null;
    private ?Newsfeed\DeleteList $deleteList = null;
    private ?Newsfeed\Get $get = null;
    private ?Newsfeed\GetBanned $getBanned = null;
    private ?Newsfeed\GetComments $getComments = null;
    private ?Newsfeed\GetLists $getLists = null;
    private ?Newsfeed\GetMentions $getMentions = null;
    private ?Newsfeed\GetRecommended $getRecommended = null;
    private ?Newsfeed\GetSuggestedSources $getSuggestedSources = null;
    private ?Newsfeed\IgnoreItem $ignoreItem = null;
    private ?Newsfeed\SaveList $saveList = null;
    private ?Newsfeed\Search $search = null;
    private ?Newsfeed\UnignoreItem $unignoreItem = null;
    private ?Newsfeed\Unsubscribe $unsubscribe = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Prevents news from specified users and communities from appearing in the current user's newsfeed.
     */
    public function addBan(): AddBan
    {
        if (!$this->addBan) {
            $this->addBan = new AddBan($this->_provider);
        }
        return $this->addBan;
    }

    /**
     * Allows news from previously banned users and communities to be shown in the current user's newsfeed.
     */
    public function deleteBan(): DeleteBan
    {
        if (!$this->deleteBan) {
            $this->deleteBan = new DeleteBan($this->_provider);
        }
        return $this->deleteBan;
    }

    /**
     * 
     */
    public function deleteList(): DeleteList
    {
        if (!$this->deleteList) {
            $this->deleteList = new DeleteList($this->_provider);
        }
        return $this->deleteList;
    }

    /**
     * Returns data required to show newsfeed for the current user.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of users and communities banned from the current user's newsfeed.
     */
    public function getBanned(): GetBanned
    {
        if (!$this->getBanned) {
            $this->getBanned = new GetBanned($this->_provider);
        }
        return $this->getBanned;
    }

    /**
     * Returns a list of comments in the current user's newsfeed.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Returns a list of newsfeeds followed by the current user.
     */
    public function getLists(): GetLists
    {
        if (!$this->getLists) {
            $this->getLists = new GetLists($this->_provider);
        }
        return $this->getLists;
    }

    /**
     * Returns a list of posts on user walls in which the current user is mentioned.
     */
    public function getMentions(): GetMentions
    {
        if (!$this->getMentions) {
            $this->getMentions = new GetMentions($this->_provider);
        }
        return $this->getMentions;
    }

    /**
     * , Returns a list of newsfeeds recommended to the current user.
     */
    public function getRecommended(): GetRecommended
    {
        if (!$this->getRecommended) {
            $this->getRecommended = new GetRecommended($this->_provider);
        }
        return $this->getRecommended;
    }

    /**
     * Returns communities and users that current user is suggested to follow.
     */
    public function getSuggestedSources(): GetSuggestedSources
    {
        if (!$this->getSuggestedSources) {
            $this->getSuggestedSources = new GetSuggestedSources($this->_provider);
        }
        return $this->getSuggestedSources;
    }

    /**
     * Hides an item from the newsfeed.
     */
    public function ignoreItem(): IgnoreItem
    {
        if (!$this->ignoreItem) {
            $this->ignoreItem = new IgnoreItem($this->_provider);
        }
        return $this->ignoreItem;
    }

    /**
     * Creates and edits user newsfeed lists
     */
    public function saveList(): SaveList
    {
        if (!$this->saveList) {
            $this->saveList = new SaveList($this->_provider);
        }
        return $this->saveList;
    }

    /**
     * Returns search results by statuses.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

    /**
     * Returns a hidden item to the newsfeed.
     */
    public function unignoreItem(): UnignoreItem
    {
        if (!$this->unignoreItem) {
            $this->unignoreItem = new UnignoreItem($this->_provider);
        }
        return $this->unignoreItem;
    }

    /**
     * Unsubscribes the current user from specified newsfeeds.
     */
    public function unsubscribe(): Unsubscribe
    {
        if (!$this->unsubscribe) {
            $this->unsubscribe = new Unsubscribe($this->_provider);
        }
        return $this->unsubscribe;
    }

}