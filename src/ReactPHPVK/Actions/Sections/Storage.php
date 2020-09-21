<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Storage\Get;
use ReactPHPVK\Actions\Sections\Storage\GetKeys;
use ReactPHPVK\Actions\Sections\Storage\Set;

class Storage
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns a value of variable with the name set by key parameter.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns the names of all variables.
     */
    public function getKeys(): GetKeys
    {
        return new GetKeys($this->_provider);
    }

    /**
     * Saves a value of variable with the name set by 'key' parameter.
     */
    public function set(): Set
    {
        return new Set($this->_provider);
    }

}