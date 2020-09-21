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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Creates a new topic on a community's discussion board.
     */
    public function addTopic(): AddTopic
    {
        return new AddTopic($this->_provider);
    }

    /**
     * Closes a topic on a community's discussion board so that comments cannot be posted.
     */
    public function closeTopic(): CloseTopic
    {
        return new CloseTopic($this->_provider);
    }

    /**
     * Adds a comment on a topic on a community's discussion board.
     */
    public function createComment(): CreateComment
    {
        return new CreateComment($this->_provider);
    }

    /**
     * Deletes a comment on a topic on a community's discussion board.
     */
    public function deleteComment(): DeleteComment
    {
        return new DeleteComment($this->_provider);
    }

    /**
     * Deletes a topic from a community's discussion board.
     */
    public function deleteTopic(): DeleteTopic
    {
        return new DeleteTopic($this->_provider);
    }

    /**
     * Edits a comment on a topic on a community's discussion board.
     */
    public function editComment(): EditComment
    {
        return new EditComment($this->_provider);
    }

    /**
     * Edits the title of a topic on a community's discussion board.
     */
    public function editTopic(): EditTopic
    {
        return new EditTopic($this->_provider);
    }

    /**
     * Pins a topic (fixes its place) to the top of a community's discussion board.
     */
    public function fixTopic(): FixTopic
    {
        return new FixTopic($this->_provider);
    }

    /**
     * Returns a list of comments on a topic on a community's discussion board.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Returns a list of topics on a community's discussion board.
     */
    public function getTopics(): GetTopics
    {
        return new GetTopics($this->_provider);
    }

    /**
     * Re-opens a previously closed topic on a community's discussion board.
     */
    public function openTopic(): OpenTopic
    {
        return new OpenTopic($this->_provider);
    }

    /**
     * Restores a comment deleted from a topic on a community's discussion board.
     */
    public function restoreComment(): RestoreComment
    {
        return new RestoreComment($this->_provider);
    }

    /**
     * Unpins a pinned topic from the top of a community's discussion board.
     */
    public function unfixTopic(): UnfixTopic
    {
        return new UnfixTopic($this->_provider);
    }

}