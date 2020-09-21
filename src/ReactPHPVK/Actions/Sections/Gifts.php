<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Gifts\Get;

class Gifts
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns a list of user gifts.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

}