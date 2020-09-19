<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Market\Add;
use ReactPHPVK\Actions\Sections\Market\AddAlbum;
use ReactPHPVK\Actions\Sections\Market\AddToAlbum;
use ReactPHPVK\Actions\Sections\Market\CreateComment;
use ReactPHPVK\Actions\Sections\Market\Delete;
use ReactPHPVK\Actions\Sections\Market\DeleteAlbum;
use ReactPHPVK\Actions\Sections\Market\DeleteComment;
use ReactPHPVK\Actions\Sections\Market\Edit;
use ReactPHPVK\Actions\Sections\Market\EditAlbum;
use ReactPHPVK\Actions\Sections\Market\EditComment;
use ReactPHPVK\Actions\Sections\Market\Get;
use ReactPHPVK\Actions\Sections\Market\GetAlbumById;
use ReactPHPVK\Actions\Sections\Market\GetAlbums;
use ReactPHPVK\Actions\Sections\Market\GetById;
use ReactPHPVK\Actions\Sections\Market\GetCategories;
use ReactPHPVK\Actions\Sections\Market\GetComments;
use ReactPHPVK\Actions\Sections\Market\RemoveFromAlbum;
use ReactPHPVK\Actions\Sections\Market\ReorderAlbums;
use ReactPHPVK\Actions\Sections\Market\ReorderItems;
use ReactPHPVK\Actions\Sections\Market\Report;
use ReactPHPVK\Actions\Sections\Market\ReportComment;
use ReactPHPVK\Actions\Sections\Market\Restore;
use ReactPHPVK\Actions\Sections\Market\RestoreComment;
use ReactPHPVK\Actions\Sections\Market\Search;

class Market
{
    private Provider $_provider;

    private ?Market\Add $add = null;
    private ?Market\AddAlbum $addAlbum = null;
    private ?Market\AddToAlbum $addToAlbum = null;
    private ?Market\CreateComment $createComment = null;
    private ?Market\Delete $delete = null;
    private ?Market\DeleteAlbum $deleteAlbum = null;
    private ?Market\DeleteComment $deleteComment = null;
    private ?Market\Edit $edit = null;
    private ?Market\EditAlbum $editAlbum = null;
    private ?Market\EditComment $editComment = null;
    private ?Market\Get $get = null;
    private ?Market\GetAlbumById $getAlbumById = null;
    private ?Market\GetAlbums $getAlbums = null;
    private ?Market\GetById $getById = null;
    private ?Market\GetCategories $getCategories = null;
    private ?Market\GetComments $getComments = null;
    private ?Market\RemoveFromAlbum $removeFromAlbum = null;
    private ?Market\ReorderAlbums $reorderAlbums = null;
    private ?Market\ReorderItems $reorderItems = null;
    private ?Market\Report $report = null;
    private ?Market\ReportComment $reportComment = null;
    private ?Market\Restore $restore = null;
    private ?Market\RestoreComment $restoreComment = null;
    private ?Market\Search $search = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Ads a new item to the market.
     */
    public function add(): Add
    {
        if (!$this->add) {
            $this->add = new Add($this->_provider);
        }
        return $this->add;
    }

    /**
     * Creates new collection of items
     */
    public function addAlbum(): AddAlbum
    {
        if (!$this->addAlbum) {
            $this->addAlbum = new AddAlbum($this->_provider);
        }
        return $this->addAlbum;
    }

    /**
     * Adds an item to one or multiple collections.
     */
    public function addToAlbum(): AddToAlbum
    {
        if (!$this->addToAlbum) {
            $this->addToAlbum = new AddToAlbum($this->_provider);
        }
        return $this->addToAlbum;
    }

    /**
     * Creates a new comment for an item.
     */
    public function createComment(): CreateComment
    {
        if (!$this->createComment) {
            $this->createComment = new CreateComment($this->_provider);
        }
        return $this->createComment;
    }

    /**
     * Deletes an item.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Deletes a collection of items.
     */
    public function deleteAlbum(): DeleteAlbum
    {
        if (!$this->deleteAlbum) {
            $this->deleteAlbum = new DeleteAlbum($this->_provider);
        }
        return $this->deleteAlbum;
    }

    /**
     * Deletes an item's comment
     */
    public function deleteComment(): DeleteComment
    {
        if (!$this->deleteComment) {
            $this->deleteComment = new DeleteComment($this->_provider);
        }
        return $this->deleteComment;
    }

    /**
     * Edits an item.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Edits a collection of items
     */
    public function editAlbum(): EditAlbum
    {
        if (!$this->editAlbum) {
            $this->editAlbum = new EditAlbum($this->_provider);
        }
        return $this->editAlbum;
    }

    /**
     * Chages item comment's text
     */
    public function editComment(): EditComment
    {
        if (!$this->editComment) {
            $this->editComment = new EditComment($this->_provider);
        }
        return $this->editComment;
    }

    /**
     * Returns items list for a community.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns items album's data
     */
    public function getAlbumById(): GetAlbumById
    {
        if (!$this->getAlbumById) {
            $this->getAlbumById = new GetAlbumById($this->_provider);
        }
        return $this->getAlbumById;
    }

    /**
     * Returns community's collections list.
     */
    public function getAlbums(): GetAlbums
    {
        if (!$this->getAlbums) {
            $this->getAlbums = new GetAlbums($this->_provider);
        }
        return $this->getAlbums;
    }

    /**
     * Returns information about market items by their ids.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns a list of market categories.
     */
    public function getCategories(): GetCategories
    {
        if (!$this->getCategories) {
            $this->getCategories = new GetCategories($this->_provider);
        }
        return $this->getCategories;
    }

    /**
     * Returns comments list for an item.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Removes an item from one or multiple collections.
     */
    public function removeFromAlbum(): RemoveFromAlbum
    {
        if (!$this->removeFromAlbum) {
            $this->removeFromAlbum = new RemoveFromAlbum($this->_provider);
        }
        return $this->removeFromAlbum;
    }

    /**
     * Reorders the collections list.
     */
    public function reorderAlbums(): ReorderAlbums
    {
        if (!$this->reorderAlbums) {
            $this->reorderAlbums = new ReorderAlbums($this->_provider);
        }
        return $this->reorderAlbums;
    }

    /**
     * Changes item place in a collection.
     */
    public function reorderItems(): ReorderItems
    {
        if (!$this->reorderItems) {
            $this->reorderItems = new ReorderItems($this->_provider);
        }
        return $this->reorderItems;
    }

    /**
     * Sends a complaint to the item.
     */
    public function report(): Report
    {
        if (!$this->report) {
            $this->report = new Report($this->_provider);
        }
        return $this->report;
    }

    /**
     * Sends a complaint to the item's comment.
     */
    public function reportComment(): ReportComment
    {
        if (!$this->reportComment) {
            $this->reportComment = new ReportComment($this->_provider);
        }
        return $this->reportComment;
    }

    /**
     * Restores recently deleted item
     */
    public function restore(): Restore
    {
        if (!$this->restore) {
            $this->restore = new Restore($this->_provider);
        }
        return $this->restore;
    }

    /**
     * Restores a recently deleted comment
     */
    public function restoreComment(): RestoreComment
    {
        if (!$this->restoreComment) {
            $this->restoreComment = new RestoreComment($this->_provider);
        }
        return $this->restoreComment;
    }

    /**
     * Searches market items in a community's catalog
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

}