<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Users\Get;
use ReactPHPVK\Actions\Sections\Users\GetFollowers;
use ReactPHPVK\Actions\Sections\Users\GetSubscriptions;
use ReactPHPVK\Actions\Sections\Users\Report;
use ReactPHPVK\Actions\Sections\Users\Search;

class Users
{
    private Provider $_provider;

    private ?Users\Get $get = null;
    private ?Users\GetFollowers $getFollowers = null;
    private ?Users\GetSubscriptions $getSubscriptions = null;
    private ?Users\Report $report = null;
    private ?Users\Search $search = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns detailed information on users.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of IDs of followers of the user in question, sorted by date added, most recent first.
     */
    public function getFollowers(): GetFollowers
    {
        if (!$this->getFollowers) {
            $this->getFollowers = new GetFollowers($this->_provider);
        }
        return $this->getFollowers;
    }

    /**
     * Returns a list of IDs of users and communities followed by the user.
     */
    public function getSubscriptions(): GetSubscriptions
    {
        if (!$this->getSubscriptions) {
            $this->getSubscriptions = new GetSubscriptions($this->_provider);
        }
        return $this->getSubscriptions;
    }

    /**
     * Reports (submits a complain about) a user.
     */
    public function report(): Report
    {
        if (!$this->report) {
            $this->report = new Report($this->_provider);
        }
        return $this->report;
    }

    /**
     * Returns a list of users matching the search criteria.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

}