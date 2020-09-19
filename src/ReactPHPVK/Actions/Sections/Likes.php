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

    private ?Likes\Add $add = null;
    private ?Likes\Delete $delete = null;
    private ?Likes\GetList $getList = null;
    private ?Likes\IsLiked $isLiked = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds the specified object to the 'Likes' list of the current user.
     */
    public function add(): Add
    {
        if (!$this->add) {
            $this->add = new Add($this->_provider);
        }
        return $this->add;
    }

    /**
     * Deletes the specified object from the 'Likes' list of the current user.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Returns a list of IDs of users who added the specified object to their 'Likes' list.
     */
    public function getList(): GetList
    {
        if (!$this->getList) {
            $this->getList = new GetList($this->_provider);
        }
        return $this->getList;
    }

    /**
     * Checks for the object in the 'Likes' list of the specified user.
     */
    public function isLiked(): IsLiked
    {
        if (!$this->isLiked) {
            $this->isLiked = new IsLiked($this->_provider);
        }
        return $this->isLiked;
    }

}