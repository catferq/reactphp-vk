<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Leads\CheckUser;
use ReactPHPVK\Actions\Sections\Leads\Complete;
use ReactPHPVK\Actions\Sections\Leads\GetStats;
use ReactPHPVK\Actions\Sections\Leads\GetUsers;
use ReactPHPVK\Actions\Sections\Leads\MetricHit;
use ReactPHPVK\Actions\Sections\Leads\Start;

class Leads
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Checks if the user can start the lead.
     */
    public function checkUser(): CheckUser
    {
        return new CheckUser($this->_provider);
    }

    /**
     * Completes the lead started by user.
     */
    public function complete(): Complete
    {
        return new Complete($this->_provider);
    }

    /**
     * Returns lead stats data.
     */
    public function getStats(): GetStats
    {
        return new GetStats($this->_provider);
    }

    /**
     * Returns a list of last user actions for the offer.
     */
    public function getUsers(): GetUsers
    {
        return new GetUsers($this->_provider);
    }

    /**
     * Counts the metric event.
     */
    public function metricHit(): MetricHit
    {
        return new MetricHit($this->_provider);
    }

    /**
     * Creates new session for the user passing the offer.
     */
    public function start(): Start
    {
        return new Start($this->_provider);
    }

}