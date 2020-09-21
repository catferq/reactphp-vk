<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Docs\Add;
use ReactPHPVK\Actions\Sections\Docs\Delete;
use ReactPHPVK\Actions\Sections\Docs\Edit;
use ReactPHPVK\Actions\Sections\Docs\Get;
use ReactPHPVK\Actions\Sections\Docs\GetById;
use ReactPHPVK\Actions\Sections\Docs\GetMessagesUploadServer;
use ReactPHPVK\Actions\Sections\Docs\GetTypes;
use ReactPHPVK\Actions\Sections\Docs\GetUploadServer;
use ReactPHPVK\Actions\Sections\Docs\GetWallUploadServer;
use ReactPHPVK\Actions\Sections\Docs\Save;
use ReactPHPVK\Actions\Sections\Docs\Search;

class Docs
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Copies a document to a user's or community's document list.
     */
    public function add(): Add
    {
        return new Add($this->_provider);
    }

    /**
     * Deletes a user or community document.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Edits a document.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Returns detailed information about user or community documents.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns information about documents by their IDs.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns the server address for document upload.
     */
    public function getMessagesUploadServer(): GetMessagesUploadServer
    {
        return new GetMessagesUploadServer($this->_provider);
    }

    /**
     * Returns documents types available for current user.
     */
    public function getTypes(): GetTypes
    {
        return new GetTypes($this->_provider);
    }

    /**
     * Returns the server address for document upload.
     */
    public function getUploadServer(): GetUploadServer
    {
        return new GetUploadServer($this->_provider);
    }

    /**
     * Returns the server address for document upload onto a user's or community's wall.
     */
    public function getWallUploadServer(): GetWallUploadServer
    {
        return new GetWallUploadServer($this->_provider);
    }

    /**
     * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
     */
    public function save(): Save
    {
        return new Save($this->_provider);
    }

    /**
     * Returns a list of documents matching the search criteria.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

}