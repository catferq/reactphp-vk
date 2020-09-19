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

    private ?Friends\Add $add = null;
    private ?Friends\AddList $addList = null;
    private ?Friends\AreFriends $areFriends = null;
    private ?Friends\Delete $delete = null;
    private ?Friends\DeleteAllRequests $deleteAllRequests = null;
    private ?Friends\DeleteList $deleteList = null;
    private ?Friends\Edit $edit = null;
    private ?Friends\EditList $editList = null;
    private ?Friends\Get $get = null;
    private ?Friends\GetAppUsers $getAppUsers = null;
    private ?Friends\GetByPhones $getByPhones = null;
    private ?Friends\GetLists $getLists = null;
    private ?Friends\GetMutual $getMutual = null;
    private ?Friends\GetOnline $getOnline = null;
    private ?Friends\GetRecent $getRecent = null;
    private ?Friends\GetRequests $getRequests = null;
    private ?Friends\GetSuggestions $getSuggestions = null;
    private ?Friends\Search $search = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Approves or creates a friend request.
     */
    public function add(): Add
    {
        if (!$this->add) {
            $this->add = new Add($this->_provider);
        }
        return $this->add;
    }

    /**
     * Creates a new friend list for the current user.
     */
    public function addList(): AddList
    {
        if (!$this->addList) {
            $this->addList = new AddList($this->_provider);
        }
        return $this->addList;
    }

    /**
     * Checks the current user's friendship status with other specified users.
     */
    public function areFriends(): AreFriends
    {
        if (!$this->areFriends) {
            $this->areFriends = new AreFriends($this->_provider);
        }
        return $this->areFriends;
    }

    /**
     * Declines a friend request or deletes a user from the current user's friend list.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Marks all incoming friend requests as viewed.
     */
    public function deleteAllRequests(): DeleteAllRequests
    {
        if (!$this->deleteAllRequests) {
            $this->deleteAllRequests = new DeleteAllRequests($this->_provider);
        }
        return $this->deleteAllRequests;
    }

    /**
     * Deletes a friend list of the current user.
     */
    public function deleteList(): DeleteList
    {
        if (!$this->deleteList) {
            $this->deleteList = new DeleteList($this->_provider);
        }
        return $this->deleteList;
    }

    /**
     * Edits the friend lists of the selected user.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Edits a friend list of the current user.
     */
    public function editList(): EditList
    {
        if (!$this->editList) {
            $this->editList = new EditList($this->_provider);
        }
        return $this->editList;
    }

    /**
     * Returns a list of user IDs or detailed information about a user's friends.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of IDs of the current user's friends who installed the application.
     */
    public function getAppUsers(): GetAppUsers
    {
        if (!$this->getAppUsers) {
            $this->getAppUsers = new GetAppUsers($this->_provider);
        }
        return $this->getAppUsers;
    }

    /**
     * Returns a list of the current user's friends whose phone numbers, validated or specified in a profile, are in a given list.
     */
    public function getByPhones(): GetByPhones
    {
        if (!$this->getByPhones) {
            $this->getByPhones = new GetByPhones($this->_provider);
        }
        return $this->getByPhones;
    }

    /**
     * Returns a list of the user's friend lists.
     */
    public function getLists(): GetLists
    {
        if (!$this->getLists) {
            $this->getLists = new GetLists($this->_provider);
        }
        return $this->getLists;
    }

    /**
     * Returns a list of user IDs of the mutual friends of two users.
     */
    public function getMutual(): GetMutual
    {
        if (!$this->getMutual) {
            $this->getMutual = new GetMutual($this->_provider);
        }
        return $this->getMutual;
    }

    /**
     * Returns a list of user IDs of a user's friends who are online.
     */
    public function getOnline(): GetOnline
    {
        if (!$this->getOnline) {
            $this->getOnline = new GetOnline($this->_provider);
        }
        return $this->getOnline;
    }

    /**
     * Returns a list of user IDs of the current user's recently added friends.
     */
    public function getRecent(): GetRecent
    {
        if (!$this->getRecent) {
            $this->getRecent = new GetRecent($this->_provider);
        }
        return $this->getRecent;
    }

    /**
     * Returns information about the current user's incoming and outgoing friend requests.
     */
    public function getRequests(): GetRequests
    {
        if (!$this->getRequests) {
            $this->getRequests = new GetRequests($this->_provider);
        }
        return $this->getRequests;
    }

    /**
     * Returns a list of profiles of users whom the current user may know.
     */
    public function getSuggestions(): GetSuggestions
    {
        if (!$this->getSuggestions) {
            $this->getSuggestions = new GetSuggestions($this->_provider);
        }
        return $this->getSuggestions;
    }

    /**
     * Returns a list of friends matching the search criteria.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

}