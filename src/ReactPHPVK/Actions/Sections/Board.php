<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Board\AddTopic;
use ReactPHPVK\Actions\Sections\Board\CloseTopic;
use ReactPHPVK\Actions\Sections\Board\CreateComment;
use ReactPHPVK\Actions\Sections\Board\DeleteComment;
use ReactPHPVK\Actions\Sections\Board\DeleteTopic;
use ReactPHPVK\Actions\Sections\Board\EditComment;
use ReactPHPVK\Actions\Sections\Board\EditTopic;
use ReactPHPVK\Actions\Sections\Board\FixTopic;
use ReactPHPVK\Actions\Sections\Board\GetComments;
use ReactPHPVK\Actions\Sections\Board\GetTopics;
use ReactPHPVK\Actions\Sections\Board\OpenTopic;
use ReactPHPVK\Actions\Sections\Board\RestoreComment;
use ReactPHPVK\Actions\Sections\Board\UnfixTopic;

class Board
{
    private Provider $_provider;

    private ?Board\AddTopic $addTopic = null;
    private ?Board\CloseTopic $closeTopic = null;
    private ?Board\CreateComment $createComment = null;
    private ?Board\DeleteComment $deleteComment = null;
    private ?Board\DeleteTopic $deleteTopic = null;
    private ?Board\EditComment $editComment = null;
    private ?Board\EditTopic $editTopic = null;
    private ?Board\FixTopic $fixTopic = null;
    private ?Board\GetComments $getComments = null;
    private ?Board\GetTopics $getTopics = null;
    private ?Board\OpenTopic $openTopic = null;
    private ?Board\RestoreComment $restoreComment = null;
    private ?Board\UnfixTopic $unfixTopic = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Creates a new topic on a community's discussion board.
     */
    public function addTopic(): AddTopic
    {
        if (!$this->addTopic) {
            $this->addTopic = new AddTopic($this->_provider);
        }
        return $this->addTopic;
    }

    /**
     * Closes a topic on a community's discussion board so that comments cannot be posted.
     */
    public function closeTopic(): CloseTopic
    {
        if (!$this->closeTopic) {
            $this->closeTopic = new CloseTopic($this->_provider);
        }
        return $this->closeTopic;
    }

    /**
     * Adds a comment on a topic on a community's discussion board.
     */
    public function createComment(): CreateComment
    {
        if (!$this->createComment) {
            $this->createComment = new CreateComment($this->_provider);
        }
        return $this->createComment;
    }

    /**
     * Deletes a comment on a topic on a community's discussion board.
     */
    public function deleteComment(): DeleteComment
    {
        if (!$this->deleteComment) {
            $this->deleteComment = new DeleteComment($this->_provider);
        }
        return $this->deleteComment;
    }

    /**
     * Deletes a topic from a community's discussion board.
     */
    public function deleteTopic(): DeleteTopic
    {
        if (!$this->deleteTopic) {
            $this->deleteTopic = new DeleteTopic($this->_provider);
        }
        return $this->deleteTopic;
    }

    /**
     * Edits a comment on a topic on a community's discussion board.
     */
    public function editComment(): EditComment
    {
        if (!$this->editComment) {
            $this->editComment = new EditComment($this->_provider);
        }
        return $this->editComment;
    }

    /**
     * Edits the title of a topic on a community's discussion board.
     */
    public function editTopic(): EditTopic
    {
        if (!$this->editTopic) {
            $this->editTopic = new EditTopic($this->_provider);
        }
        return $this->editTopic;
    }

    /**
     * Pins a topic (fixes its place) to the top of a community's discussion board.
     */
    public function fixTopic(): FixTopic
    {
        if (!$this->fixTopic) {
            $this->fixTopic = new FixTopic($this->_provider);
        }
        return $this->fixTopic;
    }

    /**
     * Returns a list of comments on a topic on a community's discussion board.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Returns a list of topics on a community's discussion board.
     */
    public function getTopics(): GetTopics
    {
        if (!$this->getTopics) {
            $this->getTopics = new GetTopics($this->_provider);
        }
        return $this->getTopics;
    }

    /**
     * Re-opens a previously closed topic on a community's discussion board.
     */
    public function openTopic(): OpenTopic
    {
        if (!$this->openTopic) {
            $this->openTopic = new OpenTopic($this->_provider);
        }
        return $this->openTopic;
    }

    /**
     * Restores a comment deleted from a topic on a community's discussion board.
     */
    public function restoreComment(): RestoreComment
    {
        if (!$this->restoreComment) {
            $this->restoreComment = new RestoreComment($this->_provider);
        }
        return $this->restoreComment;
    }

    /**
     * Unpins a pinned topic from the top of a community's discussion board.
     */
    public function unfixTopic(): UnfixTopic
    {
        if (!$this->unfixTopic) {
            $this->unfixTopic = new UnfixTopic($this->_provider);
        }
        return $this->unfixTopic;
    }

}