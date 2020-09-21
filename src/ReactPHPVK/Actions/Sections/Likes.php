<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Likes\Add;
use ReactPHPVK\Actions\Sections\Likes\Delete;
use ReactPHPVK\Actions\Sections\Likes\GetList;
use ReactPHPVK\Actions\Sections\Likes\IsLiked;

class Likes
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds the specified object to the 'Likes' list of the current user.
     */
    public function add(): Add
    {
        return new Add($this->_provider);
    }

    /**
     * Deletes the specified object from the 'Likes' list of the current user.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Returns a list of IDs of users who added the specified object to their 'Likes' list.
     */
    public function getList(): GetList
    {
        return new GetList($this->_provider);
    }

    /**
     * Checks for the object in the 'Likes' list of the specified user.
     */
    public function isLiked(): IsLiked
    {
        return new IsLiked($this->_provider);
    }

}