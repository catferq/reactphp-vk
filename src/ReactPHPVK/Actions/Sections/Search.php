<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Search\GetHints;

class Search
{
    private Provider $_provider;

    private ?Search\GetHints $getHints = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows the programmer to do a quick search for any substring.
     */
    public function getHints(): GetHints
    {
        if (!$this->getHints) {
            $this->getHints = new GetHints($this->_provider);
        }
        return $this->getHints;
    }

}