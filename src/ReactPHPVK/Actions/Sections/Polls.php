<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Polls\AddVote;
use ReactPHPVK\Actions\Sections\Polls\Create;
use ReactPHPVK\Actions\Sections\Polls\DeleteVote;
use ReactPHPVK\Actions\Sections\Polls\Edit;
use ReactPHPVK\Actions\Sections\Polls\GetById;
use ReactPHPVK\Actions\Sections\Polls\GetVoters;

class Polls
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds the current user's vote to the selected answer in the poll.
     */
    public function addVote(): AddVote
    {
        return new AddVote($this->_provider);
    }

    /**
     * Creates polls that can be attached to the users' or communities' posts.
     */
    public function create(): Create
    {
        return new Create($this->_provider);
    }

    /**
     * Deletes the current user's vote from the selected answer in the poll.
     */
    public function deleteVote(): DeleteVote
    {
        return new DeleteVote($this->_provider);
    }

    /**
     * Edits created polls
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Returns detailed information about a poll by its ID.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns a list of IDs of users who selected specific answers in the poll.
     */
    public function getVoters(): GetVoters
    {
        return new GetVoters($this->_provider);
    }

}