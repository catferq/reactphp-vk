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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Prevents news from specified users and communities from appearing in the current user's newsfeed.
     */
    public function addBan(): AddBan
    {
        return new AddBan($this->_provider);
    }

    /**
     * Allows news from previously banned users and communities to be shown in the current user's newsfeed.
     */
    public function deleteBan(): DeleteBan
    {
        return new DeleteBan($this->_provider);
    }

    /**
     * 
     */
    public function deleteList(): DeleteList
    {
        return new DeleteList($this->_provider);
    }

    /**
     * Returns data required to show newsfeed for the current user.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of users and communities banned from the current user's newsfeed.
     */
    public function getBanned(): GetBanned
    {
        return new GetBanned($this->_provider);
    }

    /**
     * Returns a list of comments in the current user's newsfeed.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Returns a list of newsfeeds followed by the current user.
     */
    public function getLists(): GetLists
    {
        return new GetLists($this->_provider);
    }

    /**
     * Returns a list of posts on user walls in which the current user is mentioned.
     */
    public function getMentions(): GetMentions
    {
        return new GetMentions($this->_provider);
    }

    /**
     * , Returns a list of newsfeeds recommended to the current user.
     */
    public function getRecommended(): GetRecommended
    {
        return new GetRecommended($this->_provider);
    }

    /**
     * Returns communities and users that current user is suggested to follow.
     */
    public function getSuggestedSources(): GetSuggestedSources
    {
        return new GetSuggestedSources($this->_provider);
    }

    /**
     * Hides an item from the newsfeed.
     */
    public function ignoreItem(): IgnoreItem
    {
        return new IgnoreItem($this->_provider);
    }

    /**
     * Creates and edits user newsfeed lists
     */
    public function saveList(): SaveList
    {
        return new SaveList($this->_provider);
    }

    /**
     * Returns search results by statuses.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

    /**
     * Returns a hidden item to the newsfeed.
     */
    public function unignoreItem(): UnignoreItem
    {
        return new UnignoreItem($this->_provider);
    }

    /**
     * Unsubscribes the current user from specified newsfeeds.
     */
    public function unsubscribe(): Unsubscribe
    {
        return new Unsubscribe($this->_provider);
    }

}