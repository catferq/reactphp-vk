<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Friends\Add;
use ReactPHPVK\Actions\Sections\Friends\AddList;
use ReactPHPVK\Actions\Sections\Friends\AreFriends;
use ReactPHPVK\Actions\Sections\Friends\Delete;
use ReactPHPVK\Actions\Sections\Friends\DeleteAllRequests;
use ReactPHPVK\Actions\Sections\Friends\DeleteList;
use ReactPHPVK\Actions\Sections\Friends\Edit;
use ReactPHPVK\Actions\Sections\Friends\EditList;
use ReactPHPVK\Actions\Sections\Friends\Get;
use ReactPHPVK\Actions\Sections\Friends\GetAppUsers;
use ReactPHPVK\Actions\Sections\Friends\GetByPhones;
use ReactPHPVK\Actions\Sections\Friends\GetLists;
use ReactPHPVK\Actions\Sections\Friends\GetMutual;
use ReactPHPVK\Actions\Sections\Friends\GetOnline;
use ReactPHPVK\Actions\Sections\Friends\GetRecent;
use ReactPHPVK\Actions\Sections\Friends\GetRequests;
use ReactPHPVK\Actions\Sections\Friends\GetSuggestions;
use ReactPHPVK\Actions\Sections\Friends\Search;

class Friends
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Approves or creates a friend request.
     */
    public function add(): Add
    {
        return new Add($this->_provider);
    }

    /**
     * Creates a new friend list for the current user.
     */
    public function addList(): AddList
    {
        return new AddList($this->_provider);
    }

    /**
     * Checks the current user's friendship status with other specified users.
     */
    public function areFriends(): AreFriends
    {
        return new AreFriends($this->_provider);
    }

    /**
     * Declines a friend request or deletes a user from the current user's friend list.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Marks all incoming friend requests as viewed.
     */
    public function deleteAllRequests(): DeleteAllRequests
    {
        return new DeleteAllRequests($this->_provider);
    }

    /**
     * Deletes a friend list of the current user.
     */
    public function deleteList(): DeleteList
    {
        return new DeleteList($this->_provider);
    }

    /**
     * Edits the friend lists of the selected user.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Edits a friend list of the current user.
     */
    public function editList(): EditList
    {
        return new EditList($this->_provider);
    }

    /**
     * Returns a list of user IDs or detailed information about a user's friends.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of IDs of the current user's friends who installed the application.
     */
    public function getAppUsers(): GetAppUsers
    {
        return new GetAppUsers($this->_provider);
    }

    /**
     * Returns a list of the current user's friends whose phone numbers, validated or specified in a profile, are in a given list.
     */
    public function getByPhones(): GetByPhones
    {
        return new GetByPhones($this->_provider);
    }

    /**
     * Returns a list of the user's friend lists.
     */
    public function getLists(): GetLists
    {
        return new GetLists($this->_provider);
    }

    /**
     * Returns a list of user IDs of the mutual friends of two users.
     */
    public function getMutual(): GetMutual
    {
        return new GetMutual($this->_provider);
    }

    /**
     * Returns a list of user IDs of a user's friends who are online.
     */
    public function getOnline(): GetOnline
    {
        return new GetOnline($this->_provider);
    }

    /**
     * Returns a list of user IDs of the current user's recently added friends.
     */
    public function getRecent(): GetRecent
    {
        return new GetRecent($this->_provider);
    }

    /**
     * Returns information about the current user's incoming and outgoing friend requests.
     */
    public function getRequests(): GetRequests
    {
        return new GetRequests($this->_provider);
    }

    /**
     * Returns a list of profiles of users whom the current user may know.
     */
    public function getSuggestions(): GetSuggestions
    {
        return new GetSuggestions($this->_provider);
    }

    /**
     * Returns a list of friends matching the search criteria.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

}