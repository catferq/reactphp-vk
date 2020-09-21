<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Stats\Get;
use ReactPHPVK\Actions\Sections\Stats\GetPostReach;
use ReactPHPVK\Actions\Sections\Stats\TrackVisitor;

class Stats
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns statistics of a community or an application.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns stats for a wall post.
     */
    public function getPostReach(): GetPostReach
    {
        return new GetPostReach($this->_provider);
    }

    /**
     * 
     */
    public function trackVisitor(): TrackVisitor
    {
        return new TrackVisitor($this->_provider);
    }

}