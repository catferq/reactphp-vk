<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Video\Add;
use ReactPHPVK\Actions\Sections\Video\AddAlbum;
use ReactPHPVK\Actions\Sections\Video\AddToAlbum;
use ReactPHPVK\Actions\Sections\Video\CreateComment;
use ReactPHPVK\Actions\Sections\Video\Delete;
use ReactPHPVK\Actions\Sections\Video\DeleteAlbum;
use ReactPHPVK\Actions\Sections\Video\DeleteComment;
use ReactPHPVK\Actions\Sections\Video\Edit;
use ReactPHPVK\Actions\Sections\Video\EditAlbum;
use ReactPHPVK\Actions\Sections\Video\EditComment;
use ReactPHPVK\Actions\Sections\Video\Get;
use ReactPHPVK\Actions\Sections\Video\GetAlbumById;
use ReactPHPVK\Actions\Sections\Video\GetAlbums;
use ReactPHPVK\Actions\Sections\Video\GetAlbumsByVideo;
use ReactPHPVK\Actions\Sections\Video\GetComments;
use ReactPHPVK\Actions\Sections\Video\RemoveFromAlbum;
use ReactPHPVK\Actions\Sections\Video\ReorderAlbums;
use ReactPHPVK\Actions\Sections\Video\ReorderVideos;
use ReactPHPVK\Actions\Sections\Video\Report;
use ReactPHPVK\Actions\Sections\Video\ReportComment;
use ReactPHPVK\Actions\Sections\Video\Restore;
use ReactPHPVK\Actions\Sections\Video\RestoreComment;
use ReactPHPVK\Actions\Sections\Video\Save;
use ReactPHPVK\Actions\Sections\Video\Search;

class Video
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds a video to a user or community page.
     */
    public function add(): Add
    {
        return new Add($this->_provider);
    }

    /**
     * Creates an empty album for videos.
     */
    public function addAlbum(): AddAlbum
    {
        return new AddAlbum($this->_provider);
    }

    /**
     * 
     */
    public function addToAlbum(): AddToAlbum
    {
        return new AddToAlbum($this->_provider);
    }

    /**
     * Adds a new comment on a video.
     */
    public function createComment(): CreateComment
    {
        return new CreateComment($this->_provider);
    }

    /**
     * Deletes a video from a user or community page.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Deletes a video album.
     */
    public function deleteAlbum(): DeleteAlbum
    {
        return new DeleteAlbum($this->_provider);
    }

    /**
     * Deletes a comment on a video.
     */
    public function deleteComment(): DeleteComment
    {
        return new DeleteComment($this->_provider);
    }

    /**
     * Edits information about a video on a user or community page.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Edits the title of a video album.
     */
    public function editAlbum(): EditAlbum
    {
        return new EditAlbum($this->_provider);
    }

    /**
     * Edits the text of a comment on a video.
     */
    public function editComment(): EditComment
    {
        return new EditComment($this->_provider);
    }

    /**
     * Returns detailed information about videos.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns video album info
     */
    public function getAlbumById(): GetAlbumById
    {
        return new GetAlbumById($this->_provider);
    }

    /**
     * Returns a list of video albums owned by a user or community.
     */
    public function getAlbums(): GetAlbums
    {
        return new GetAlbums($this->_provider);
    }

    /**
     * 
     */
    public function getAlbumsByVideo(): GetAlbumsByVideo
    {
        return new GetAlbumsByVideo($this->_provider);
    }

    /**
     * Returns a list of comments on a video.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * 
     */
    public function removeFromAlbum(): RemoveFromAlbum
    {
        return new RemoveFromAlbum($this->_provider);
    }

    /**
     * Reorders the album in the list of user video albums.
     */
    public function reorderAlbums(): ReorderAlbums
    {
        return new ReorderAlbums($this->_provider);
    }

    /**
     * Reorders the video in the video album.
     */
    public function reorderVideos(): ReorderVideos
    {
        return new ReorderVideos($this->_provider);
    }

    /**
     * Reports (submits a complaint about) a video.
     */
    public function report(): Report
    {
        return new Report($this->_provider);
    }

    /**
     * Reports (submits a complaint about) a comment on a video.
     */
    public function reportComment(): ReportComment
    {
        return new ReportComment($this->_provider);
    }

    /**
     * Restores a previously deleted video.
     */
    public function restore(): Restore
    {
        return new Restore($this->_provider);
    }

    /**
     * Restores a previously deleted comment on a video.
     */
    public function restoreComment(): RestoreComment
    {
        return new RestoreComment($this->_provider);
    }

    /**
     * Returns a server address (required for upload) and video data.
     */
    public function save(): Save
    {
        return new Save($this->_provider);
    }

    /**
     * Returns a list of videos under the set search criterion.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

}