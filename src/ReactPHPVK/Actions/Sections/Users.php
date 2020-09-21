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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns detailed information on users.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of IDs of followers of the user in question, sorted by date added, most recent first.
     */
    public function getFollowers(): GetFollowers
    {
        return new GetFollowers($this->_provider);
    }

    /**
     * Returns a list of IDs of users and communities followed by the user.
     */
    public function getSubscriptions(): GetSubscriptions
    {
        return new GetSubscriptions($this->_provider);
    }

    /**
     * Reports (submits a complain about) a user.
     */
    public function report(): Report
    {
        return new Report($this->_provider);
    }

    /**
     * Returns a list of users matching the search criteria.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

}