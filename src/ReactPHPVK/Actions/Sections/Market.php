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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Ads a new item to the market.
     */
    public function add(): Add
    {
        return new Add($this->_provider);
    }

    /**
     * Creates new collection of items
     */
    public function addAlbum(): AddAlbum
    {
        return new AddAlbum($this->_provider);
    }

    /**
     * Adds an item to one or multiple collections.
     */
    public function addToAlbum(): AddToAlbum
    {
        return new AddToAlbum($this->_provider);
    }

    /**
     * Creates a new comment for an item.
     */
    public function createComment(): CreateComment
    {
        return new CreateComment($this->_provider);
    }

    /**
     * Deletes an item.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Deletes a collection of items.
     */
    public function deleteAlbum(): DeleteAlbum
    {
        return new DeleteAlbum($this->_provider);
    }

    /**
     * Deletes an item's comment
     */
    public function deleteComment(): DeleteComment
    {
        return new DeleteComment($this->_provider);
    }

    /**
     * Edits an item.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Edits a collection of items
     */
    public function editAlbum(): EditAlbum
    {
        return new EditAlbum($this->_provider);
    }

    /**
     * Chages item comment's text
     */
    public function editComment(): EditComment
    {
        return new EditComment($this->_provider);
    }

    /**
     * Returns items list for a community.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns items album's data
     */
    public function getAlbumById(): GetAlbumById
    {
        return new GetAlbumById($this->_provider);
    }

    /**
     * Returns community's collections list.
     */
    public function getAlbums(): GetAlbums
    {
        return new GetAlbums($this->_provider);
    }

    /**
     * Returns information about market items by their ids.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns a list of market categories.
     */
    public function getCategories(): GetCategories
    {
        return new GetCategories($this->_provider);
    }

    /**
     * Returns comments list for an item.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Removes an item from one or multiple collections.
     */
    public function removeFromAlbum(): RemoveFromAlbum
    {
        return new RemoveFromAlbum($this->_provider);
    }

    /**
     * Reorders the collections list.
     */
    public function reorderAlbums(): ReorderAlbums
    {
        return new ReorderAlbums($this->_provider);
    }

    /**
     * Changes item place in a collection.
     */
    public function reorderItems(): ReorderItems
    {
        return new ReorderItems($this->_provider);
    }

    /**
     * Sends a complaint to the item.
     */
    public function report(): Report
    {
        return new Report($this->_provider);
    }

    /**
     * Sends a complaint to the item's comment.
     */
    public function reportComment(): ReportComment
    {
        return new ReportComment($this->_provider);
    }

    /**
     * Restores recently deleted item
     */
    public function restore(): Restore
    {
        return new Restore($this->_provider);
    }

    /**
     * Restores a recently deleted comment
     */
    public function restoreComment(): RestoreComment
    {
        return new RestoreComment($this->_provider);
    }

    /**
     * Searches market items in a community's catalog
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

}