<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Stats\Get;
use ReactPHPVK\Actions\Sections\Stats\GetPostReach;
use ReactPHPVK\Actions\Sections\Stats\TrackVisitor;

class Stats
{
    private Provider $_provider;

    private ?Stats\Get $get = null;
    private ?Stats\GetPostReach $getPostReach = null;
    private ?Stats\TrackVisitor $trackVisitor = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns statistics of a community or an application.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns stats for a wall post.
     */
    public function getPostReach(): GetPostReach
    {
        if (!$this->getPostReach) {
            $this->getPostReach = new GetPostReach($this->_provider);
        }
        return $this->getPostReach;
    }

    /**
     * 
     */
    public function trackVisitor(): TrackVisitor
    {
        if (!$this->trackVisitor) {
            $this->trackVisitor = new TrackVisitor($this->_provider);
        }
        return $this->trackVisitor;
    }

}