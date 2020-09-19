<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\PrettyCards\Create;
use ReactPHPVK\Actions\Sections\PrettyCards\Delete;
use ReactPHPVK\Actions\Sections\PrettyCards\Edit;
use ReactPHPVK\Actions\Sections\PrettyCards\Get;
use ReactPHPVK\Actions\Sections\PrettyCards\GetById;
use ReactPHPVK\Actions\Sections\PrettyCards\GetUploadURL;

class PrettyCards
{
    private Provider $_provider;

    private ?PrettyCards\Create $create = null;
    private ?PrettyCards\Delete $delete = null;
    private ?PrettyCards\Edit $edit = null;
    private ?PrettyCards\Get $get = null;
    private ?PrettyCards\GetById $getById = null;
    private ?PrettyCards\GetUploadURL $getUploadURL = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function create(): Create
    {
        if (!$this->create) {
            $this->create = new Create($this->_provider);
        }
        return $this->create;
    }

    /**
     * 
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * 
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * 
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * 
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * 
     */
    public function getUploadURL(): GetUploadURL
    {
        if (!$this->getUploadURL) {
            $this->getUploadURL = new GetUploadURL($this->_provider);
        }
        return $this->getUploadURL;
    }

}