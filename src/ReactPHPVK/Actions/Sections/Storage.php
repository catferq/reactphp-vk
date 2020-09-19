<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Storage\Get;
use ReactPHPVK\Actions\Sections\Storage\GetKeys;
use ReactPHPVK\Actions\Sections\Storage\Set;

class Storage
{
    private Provider $_provider;

    private ?Storage\Get $get = null;
    private ?Storage\GetKeys $getKeys = null;
    private ?Storage\Set $set = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns a value of variable with the name set by key parameter.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns the names of all variables.
     */
    public function getKeys(): GetKeys
    {
        if (!$this->getKeys) {
            $this->getKeys = new GetKeys($this->_provider);
        }
        return $this->getKeys;
    }

    /**
     * Saves a value of variable with the name set by 'key' parameter.
     */
    public function set(): Set
    {
        if (!$this->set) {
            $this->set = new Set($this->_provider);
        }
        return $this->set;
    }

}