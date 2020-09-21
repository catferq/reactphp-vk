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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function closeComments(): CloseComments
    {
        return new CloseComments($this->_provider);
    }

    /**
     * Adds a comment to a post on a user wall or community wall.
     */
    public function createComment(): CreateComment
    {
        return new CreateComment($this->_provider);
    }

    /**
     * Deletes a post from a user wall or community wall.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Deletes a comment on a post on a user wall or community wall.
     */
    public function deleteComment(): DeleteComment
    {
        return new DeleteComment($this->_provider);
    }

    /**
     * Edits a post on a user wall or community wall.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Allows to edit hidden post.
     */
    public function editAdsStealth(): EditAdsStealth
    {
        return new EditAdsStealth($this->_provider);
    }

    /**
     * Edits a comment on a user wall or community wall.
     */
    public function editComment(): EditComment
    {
        return new EditComment($this->_provider);
    }

    /**
     * Returns a list of posts on a user wall or community wall.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of posts from user or community walls by their IDs.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns a comment on a post on a user wall or community wall.
     */
    public function getComment(): GetComment
    {
        return new GetComment($this->_provider);
    }

    /**
     * Returns a list of comments on a post on a user wall or community wall.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Returns information about reposts of a post on user wall or community wall.
     */
    public function getReposts(): GetReposts
    {
        return new GetReposts($this->_provider);
    }

    /**
     * 
     */
    public function openComments(): OpenComments
    {
        return new OpenComments($this->_provider);
    }

    /**
     * Pins the post on wall.
     */
    public function pin(): Pin
    {
        return new Pin($this->_provider);
    }

    /**
     * Adds a new post on a user wall or community wall. Can also be used to publish suggested or scheduled posts.
     */
    public function post(): Post
    {
        return new Post($this->_provider);
    }

    /**
     * Allows to create hidden post which will not be shown on the community's wall and can be used for creating an ad with type "Community post".
     */
    public function postAdsStealth(): PostAdsStealth
    {
        return new PostAdsStealth($this->_provider);
    }

    /**
     * Reports (submits a complaint about) a comment on a post on a user wall or community wall.
     */
    public function reportComment(): ReportComment
    {
        return new ReportComment($this->_provider);
    }

    /**
     * Reports (submits a complaint about) a post on a user wall or community wall.
     */
    public function reportPost(): ReportPost
    {
        return new ReportPost($this->_provider);
    }

    /**
     * Reposts (copies) an object to a user wall or community wall.
     */
    public function repost(): Repost
    {
        return new Repost($this->_provider);
    }

    /**
     * Restores a post deleted from a user wall or community wall.
     */
    public function restore(): Restore
    {
        return new Restore($this->_provider);
    }

    /**
     * Restores a comment deleted from a user wall or community wall.
     */
    public function restoreComment(): RestoreComment
    {
        return new RestoreComment($this->_provider);
    }

    /**
     * Allows to search posts on user or community walls.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

    /**
     * Unpins the post on wall.
     */
    public function unpin(): Unpin
    {
        return new Unpin($this->_provider);
    }

}