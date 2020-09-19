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

    private ?Docs\Add $add = null;
    private ?Docs\Delete $delete = null;
    private ?Docs\Edit $edit = null;
    private ?Docs\Get $get = null;
    private ?Docs\GetById $getById = null;
    private ?Docs\GetMessagesUploadServer $getMessagesUploadServer = null;
    private ?Docs\GetTypes $getTypes = null;
    private ?Docs\GetUploadServer $getUploadServer = null;
    private ?Docs\GetWallUploadServer $getWallUploadServer = null;
    private ?Docs\Save $save = null;
    private ?Docs\Search $search = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Copies a document to a user's or community's document list.
     */
    public function add(): Add
    {
        if (!$this->add) {
            $this->add = new Add($this->_provider);
        }
        return $this->add;
    }

    /**
     * Deletes a user or community document.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Edits a document.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Returns detailed information about user or community documents.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns information about documents by their IDs.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns the server address for document upload.
     */
    public function getMessagesUploadServer(): GetMessagesUploadServer
    {
        if (!$this->getMessagesUploadServer) {
            $this->getMessagesUploadServer = new GetMessagesUploadServer($this->_provider);
        }
        return $this->getMessagesUploadServer;
    }

    /**
     * Returns documents types available for current user.
     */
    public function getTypes(): GetTypes
    {
        if (!$this->getTypes) {
            $this->getTypes = new GetTypes($this->_provider);
        }
        return $this->getTypes;
    }

    /**
     * Returns the server address for document upload.
     */
    public function getUploadServer(): GetUploadServer
    {
        if (!$this->getUploadServer) {
            $this->getUploadServer = new GetUploadServer($this->_provider);
        }
        return $this->getUploadServer;
    }

    /**
     * Returns the server address for document upload onto a user's or community's wall.
     */
    public function getWallUploadServer(): GetWallUploadServer
    {
        if (!$this->getWallUploadServer) {
            $this->getWallUploadServer = new GetWallUploadServer($this->_provider);
        }
        return $this->getWallUploadServer;
    }

    /**
     * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
     */
    public function save(): Save
    {
        if (!$this->save) {
            $this->save = new Save($this->_provider);
        }
        return $this->save;
    }

    /**
     * Returns a list of documents matching the search criteria.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

}