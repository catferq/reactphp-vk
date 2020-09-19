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

    private ?Notes\Add $add = null;
    private ?Notes\CreateComment $createComment = null;
    private ?Notes\Delete $delete = null;
    private ?Notes\DeleteComment $deleteComment = null;
    private ?Notes\Edit $edit = null;
    private ?Notes\EditComment $editComment = null;
    private ?Notes\Get $get = null;
    private ?Notes\GetById $getById = null;
    private ?Notes\GetComments $getComments = null;
    private ?Notes\RestoreComment $restoreComment = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Creates a new note for the current user.
     */
    public function add(): Add
    {
        if (!$this->add) {
            $this->add = new Add($this->_provider);
        }
        return $this->add;
    }

    /**
     * Adds a new comment on a note.
     */
    public function createComment(): CreateComment
    {
        if (!$this->createComment) {
            $this->createComment = new CreateComment($this->_provider);
        }
        return $this->createComment;
    }

    /**
     * Deletes a note of the current user.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Deletes a comment on a note.
     */
    public function deleteComment(): DeleteComment
    {
        if (!$this->deleteComment) {
            $this->deleteComment = new DeleteComment($this->_provider);
        }
        return $this->deleteComment;
    }

    /**
     * Edits a note of the current user.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Edits a comment on a note.
     */
    public function editComment(): EditComment
    {
        if (!$this->editComment) {
            $this->editComment = new EditComment($this->_provider);
        }
        return $this->editComment;
    }

    /**
     * Returns a list of notes created by a user.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a note by its ID.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns a list of comments on a note.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Restores a deleted comment on a note.
     */
    public function restoreComment(): RestoreComment
    {
        if (!$this->restoreComment) {
            $this->restoreComment = new RestoreComment($this->_provider);
        }
        return $this->restoreComment;
    }

}