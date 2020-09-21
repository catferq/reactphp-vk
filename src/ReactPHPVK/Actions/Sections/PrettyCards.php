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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function create(): Create
    {
        return new Create($this->_provider);
    }

    /**
     * 
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * 
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * 
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * 
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * 
     */
    public function getUploadURL(): GetUploadURL
    {
        return new GetUploadURL($this->_provider);
    }

}