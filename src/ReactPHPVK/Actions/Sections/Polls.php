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

    private ?Polls\AddVote $addVote = null;
    private ?Polls\Create $create = null;
    private ?Polls\DeleteVote $deleteVote = null;
    private ?Polls\Edit $edit = null;
    private ?Polls\GetById $getById = null;
    private ?Polls\GetVoters $getVoters = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds the current user's vote to the selected answer in the poll.
     */
    public function addVote(): AddVote
    {
        if (!$this->addVote) {
            $this->addVote = new AddVote($this->_provider);
        }
        return $this->addVote;
    }

    /**
     * Creates polls that can be attached to the users' or communities' posts.
     */
    public function create(): Create
    {
        if (!$this->create) {
            $this->create = new Create($this->_provider);
        }
        return $this->create;
    }

    /**
     * Deletes the current user's vote from the selected answer in the poll.
     */
    public function deleteVote(): DeleteVote
    {
        if (!$this->deleteVote) {
            $this->deleteVote = new DeleteVote($this->_provider);
        }
        return $this->deleteVote;
    }

    /**
     * Edits created polls
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Returns detailed information about a poll by its ID.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns a list of IDs of users who selected specific answers in the poll.
     */
    public function getVoters(): GetVoters
    {
        if (!$this->getVoters) {
            $this->getVoters = new GetVoters($this->_provider);
        }
        return $this->getVoters;
    }

}