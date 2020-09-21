<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Notes\Add;
use ReactPHPVK\Actions\Sections\Notes\CreateComment;
use ReactPHPVK\Actions\Sections\Notes\Delete;
use ReactPHPVK\Actions\Sections\Notes\DeleteComment;
use ReactPHPVK\Actions\Sections\Notes\Edit;
use ReactPHPVK\Actions\Sections\Notes\EditComment;
use ReactPHPVK\Actions\Sections\Notes\Get;
use ReactPHPVK\Actions\Sections\Notes\GetById;
use ReactPHPVK\Actions\Sections\Notes\GetComments;
use ReactPHPVK\Actions\Sections\Notes\RestoreComment;

class Notes
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Creates a new note for the current user.
     */
    public function add(): Add
    {
        return new Add($this->_provider);
    }

    /**
     * Adds a new comment on a note.
     */
    public function createComment(): CreateComment
    {
        return new CreateComment($this->_provider);
    }

    /**
     * Deletes a note of the current user.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Deletes a comment on a note.
     */
    public function deleteComment(): DeleteComment
    {
        return new DeleteComment($this->_provider);
    }

    /**
     * Edits a note of the current user.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Edits a comment on a note.
     */
    public function editComment(): EditComment
    {
        return new EditComment($this->_provider);
    }

    /**
     * Returns a list of notes created by a user.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a note by its ID.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns a list of comments on a note.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Restores a deleted comment on a note.
     */
    public function restoreComment(): RestoreComment
    {
        return new RestoreComment($this->_provider);
    }

}