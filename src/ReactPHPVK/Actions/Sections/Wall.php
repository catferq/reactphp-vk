<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Wall\CloseComments;
use ReactPHPVK\Actions\Sections\Wall\CreateComment;
use ReactPHPVK\Actions\Sections\Wall\Delete;
use ReactPHPVK\Actions\Sections\Wall\DeleteComment;
use ReactPHPVK\Actions\Sections\Wall\Edit;
use ReactPHPVK\Actions\Sections\Wall\EditAdsStealth;
use ReactPHPVK\Actions\Sections\Wall\EditComment;
use ReactPHPVK\Actions\Sections\Wall\Get;
use ReactPHPVK\Actions\Sections\Wall\GetById;
use ReactPHPVK\Actions\Sections\Wall\GetComment;
use ReactPHPVK\Actions\Sections\Wall\GetComments;
use ReactPHPVK\Actions\Sections\Wall\GetReposts;
use ReactPHPVK\Actions\Sections\Wall\OpenComments;
use ReactPHPVK\Actions\Sections\Wall\Pin;
use ReactPHPVK\Actions\Sections\Wall\Post;
use ReactPHPVK\Actions\Sections\Wall\PostAdsStealth;
use ReactPHPVK\Actions\Sections\Wall\ReportComment;
use ReactPHPVK\Actions\Sections\Wall\ReportPost;
use ReactPHPVK\Actions\Sections\Wall\Repost;
use ReactPHPVK\Actions\Sections\Wall\Restore;
use ReactPHPVK\Actions\Sections\Wall\RestoreComment;
use ReactPHPVK\Actions\Sections\Wall\Search;
use ReactPHPVK\Actions\Sections\Wall\Unpin;

class Wall
{
    private Provider $_provider;

    private ?Wall\CloseComments $closeComments = null;
    private ?Wall\CreateComment $createComment = null;
    private ?Wall\Delete $delete = null;
    private ?Wall\DeleteComment $deleteComment = null;
    private ?Wall\Edit $edit = null;
    private ?Wall\EditAdsStealth $editAdsStealth = null;
    private ?Wall\EditComment $editComment = null;
    private ?Wall\Get $get = null;
    private ?Wall\GetById $getById = null;
    private ?Wall\GetComment $getComment = null;
    private ?Wall\GetComments $getComments = null;
    private ?Wall\GetReposts $getReposts = null;
    private ?Wall\OpenComments $openComments = null;
    private ?Wall\Pin $pin = null;
    private ?Wall\Post $post = null;
    private ?Wall\PostAdsStealth $postAdsStealth = null;
    private ?Wall\ReportComment $reportComment = null;
    private ?Wall\ReportPost $reportPost = null;
    private ?Wall\Repost $repost = null;
    private ?Wall\Restore $restore = null;
    private ?Wall\RestoreComment $restoreComment = null;
    private ?Wall\Search $search = null;
    private ?Wall\Unpin $unpin = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function closeComments(): CloseComments
    {
        if (!$this->closeComments) {
            $this->closeComments = new CloseComments($this->_provider);
        }
        return $this->closeComments;
    }

    /**
     * Adds a comment to a post on a user wall or community wall.
     */
    public function createComment(): CreateComment
    {
        if (!$this->createComment) {
            $this->createComment = new CreateComment($this->_provider);
        }
        return $this->createComment;
    }

    /**
     * Deletes a post from a user wall or community wall.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Deletes a comment on a post on a user wall or community wall.
     */
    public function deleteComment(): DeleteComment
    {
        if (!$this->deleteComment) {
            $this->deleteComment = new DeleteComment($this->_provider);
        }
        return $this->deleteComment;
    }

    /**
     * Edits a post on a user wall or community wall.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Allows to edit hidden post.
     */
    public function editAdsStealth(): EditAdsStealth
    {
        if (!$this->editAdsStealth) {
            $this->editAdsStealth = new EditAdsStealth($this->_provider);
        }
        return $this->editAdsStealth;
    }

    /**
     * Edits a comment on a user wall or community wall.
     */
    public function editComment(): EditComment
    {
        if (!$this->editComment) {
            $this->editComment = new EditComment($this->_provider);
        }
        return $this->editComment;
    }

    /**
     * Returns a list of posts on a user wall or community wall.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of posts from user or community walls by their IDs.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns a comment on a post on a user wall or community wall.
     */
    public function getComment(): GetComment
    {
        if (!$this->getComment) {
            $this->getComment = new GetComment($this->_provider);
        }
        return $this->getComment;
    }

    /**
     * Returns a list of comments on a post on a user wall or community wall.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Returns information about reposts of a post on user wall or community wall.
     */
    public function getReposts(): GetReposts
    {
        if (!$this->getReposts) {
            $this->getReposts = new GetReposts($this->_provider);
        }
        return $this->getReposts;
    }

    /**
     * 
     */
    public function openComments(): OpenComments
    {
        if (!$this->openComments) {
            $this->openComments = new OpenComments($this->_provider);
        }
        return $this->openComments;
    }

    /**
     * Pins the post on wall.
     */
    public function pin(): Pin
    {
        if (!$this->pin) {
            $this->pin = new Pin($this->_provider);
        }
        return $this->pin;
    }

    /**
     * Adds a new post on a user wall or community wall. Can also be used to publish suggested or scheduled posts.
     */
    public function post(): Post
    {
        if (!$this->post) {
            $this->post = new Post($this->_provider);
        }
        return $this->post;
    }

    /**
     * Allows to create hidden post which will not be shown on the community's wall and can be used for creating an ad with type "Community post".
     */
    public function postAdsStealth(): PostAdsStealth
    {
        if (!$this->postAdsStealth) {
            $this->postAdsStealth = new PostAdsStealth($this->_provider);
        }
        return $this->postAdsStealth;
    }

    /**
     * Reports (submits a complaint about) a comment on a post on a user wall or community wall.
     */
    public function reportComment(): ReportComment
    {
        if (!$this->reportComment) {
            $this->reportComment = new ReportComment($this->_provider);
        }
        return $this->reportComment;
    }

    /**
     * Reports (submits a complaint about) a post on a user wall or community wall.
     */
    public function reportPost(): ReportPost
    {
        if (!$this->reportPost) {
            $this->reportPost = new ReportPost($this->_provider);
        }
        return $this->reportPost;
    }

    /**
     * Reposts (copies) an object to a user wall or community wall.
     */
    public function repost(): Repost
    {
        if (!$this->repost) {
            $this->repost = new Repost($this->_provider);
        }
        return $this->repost;
    }

    /**
     * Restores a post deleted from a user wall or community wall.
     */
    public function restore(): Restore
    {
        if (!$this->restore) {
            $this->restore = new Restore($this->_provider);
        }
        return $this->restore;
    }

    /**
     * Restores a comment deleted from a user wall or community wall.
     */
    public function restoreComment(): RestoreComment
    {
        if (!$this->restoreComment) {
            $this->restoreComment = new RestoreComment($this->_provider);
        }
        return $this->restoreComment;
    }

    /**
     * Allows to search posts on user or community walls.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

    /**
     * Unpins the post on wall.
     */
    public function unpin(): Unpin
    {
        if (!$this->unpin) {
            $this->unpin = new Unpin($this->_provider);
        }
        return $this->unpin;
    }

}