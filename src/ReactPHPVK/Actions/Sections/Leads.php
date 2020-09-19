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

    private ?Leads\CheckUser $checkUser = null;
    private ?Leads\Complete $complete = null;
    private ?Leads\GetStats $getStats = null;
    private ?Leads\GetUsers $getUsers = null;
    private ?Leads\MetricHit $metricHit = null;
    private ?Leads\Start $start = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Checks if the user can start the lead.
     */
    public function checkUser(): CheckUser
    {
        if (!$this->checkUser) {
            $this->checkUser = new CheckUser($this->_provider);
        }
        return $this->checkUser;
    }

    /**
     * Completes the lead started by user.
     */
    public function complete(): Complete
    {
        if (!$this->complete) {
            $this->complete = new Complete($this->_provider);
        }
        return $this->complete;
    }

    /**
     * Returns lead stats data.
     */
    public function getStats(): GetStats
    {
        if (!$this->getStats) {
            $this->getStats = new GetStats($this->_provider);
        }
        return $this->getStats;
    }

    /**
     * Returns a list of last user actions for the offer.
     */
    public function getUsers(): GetUsers
    {
        if (!$this->getUsers) {
            $this->getUsers = new GetUsers($this->_provider);
        }
        return $this->getUsers;
    }

    /**
     * Counts the metric event.
     */
    public function metricHit(): MetricHit
    {
        if (!$this->metricHit) {
            $this->metricHit = new MetricHit($this->_provider);
        }
        return $this->metricHit;
    }

    /**
     * Creates new session for the user passing the offer.
     */
    public function start(): Start
    {
        if (!$this->start) {
            $this->start = new Start($this->_provider);
        }
        return $this->start;
    }

}