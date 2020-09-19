<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Status\Get;
use ReactPHPVK\Actions\Sections\Status\Set;

class Status
{
    private Provider $_provider;

    private ?Status\Get $get = null;
    private ?Status\Set $set = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns data required to show the status of a user or community.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Sets a new status for the current user.
     */
    public function set(): Set
    {
        if (!$this->set) {
            $this->set = new Set($this->_provider);
        }
        return $this->set;
    }

}