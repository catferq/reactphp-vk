<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Status\Get;
use ReactPHPVK\Actions\Sections\Status\Set;

class Status
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns data required to show the status of a user or community.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Sets a new status for the current user.
     */
    public function set(): Set
    {
        return new Set($this->_provider);
    }

}