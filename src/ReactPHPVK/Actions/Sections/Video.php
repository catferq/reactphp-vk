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

    private ?Video\Add $add = null;
    private ?Video\AddAlbum $addAlbum = null;
    private ?Video\AddToAlbum $addToAlbum = null;
    private ?Video\CreateComment $createComment = null;
    private ?Video\Delete $delete = null;
    private ?Video\DeleteAlbum $deleteAlbum = null;
    private ?Video\DeleteComment $deleteComment = null;
    private ?Video\Edit $edit = null;
    private ?Video\EditAlbum $editAlbum = null;
    private ?Video\EditComment $editComment = null;
    private ?Video\Get $get = null;
    private ?Video\GetAlbumById $getAlbumById = null;
    private ?Video\GetAlbums $getAlbums = null;
    private ?Video\GetAlbumsByVideo $getAlbumsByVideo = null;
    private ?Video\GetComments $getComments = null;
    private ?Video\RemoveFromAlbum $removeFromAlbum = null;
    private ?Video\ReorderAlbums $reorderAlbums = null;
    private ?Video\ReorderVideos $reorderVideos = null;
    private ?Video\Report $report = null;
    private ?Video\ReportComment $reportComment = null;
    private ?Video\Restore $restore = null;
    private ?Video\RestoreComment $restoreComment = null;
    private ?Video\Save $save = null;
    private ?Video\Search $search = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds a video to a user or community page.
     */
    public function add(): Add
    {
        if (!$this->add) {
            $this->add = new Add($this->_provider);
        }
        return $this->add;
    }

    /**
     * Creates an empty album for videos.
     */
    public function addAlbum(): AddAlbum
    {
        if (!$this->addAlbum) {
            $this->addAlbum = new AddAlbum($this->_provider);
        }
        return $this->addAlbum;
    }

    /**
     * 
     */
    public function addToAlbum(): AddToAlbum
    {
        if (!$this->addToAlbum) {
            $this->addToAlbum = new AddToAlbum($this->_provider);
        }
        return $this->addToAlbum;
    }

    /**
     * Adds a new comment on a video.
     */
    public function createComment(): CreateComment
    {
        if (!$this->createComment) {
            $this->createComment = new CreateComment($this->_provider);
        }
        return $this->createComment;
    }

    /**
     * Deletes a video from a user or community page.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Deletes a video album.
     */
    public function deleteAlbum(): DeleteAlbum
    {
        if (!$this->deleteAlbum) {
            $this->deleteAlbum = new DeleteAlbum($this->_provider);
        }
        return $this->deleteAlbum;
    }

    /**
     * Deletes a comment on a video.
     */
    public function deleteComment(): DeleteComment
    {
        if (!$this->deleteComment) {
            $this->deleteComment = new DeleteComment($this->_provider);
        }
        return $this->deleteComment;
    }

    /**
     * Edits information about a video on a user or community page.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Edits the title of a video album.
     */
    public function editAlbum(): EditAlbum
    {
        if (!$this->editAlbum) {
            $this->editAlbum = new EditAlbum($this->_provider);
        }
        return $this->editAlbum;
    }

    /**
     * Edits the text of a comment on a video.
     */
    public function editComment(): EditComment
    {
        if (!$this->editComment) {
            $this->editComment = new EditComment($this->_provider);
        }
        return $this->editComment;
    }

    /**
     * Returns detailed information about videos.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns video album info
     */
    public function getAlbumById(): GetAlbumById
    {
        if (!$this->getAlbumById) {
            $this->getAlbumById = new GetAlbumById($this->_provider);
        }
        return $this->getAlbumById;
    }

    /**
     * Returns a list of video albums owned by a user or community.
     */
    public function getAlbums(): GetAlbums
    {
        if (!$this->getAlbums) {
            $this->getAlbums = new GetAlbums($this->_provider);
        }
        return $this->getAlbums;
    }

    /**
     * 
     */
    public function getAlbumsByVideo(): GetAlbumsByVideo
    {
        if (!$this->getAlbumsByVideo) {
            $this->getAlbumsByVideo = new GetAlbumsByVideo($this->_provider);
        }
        return $this->getAlbumsByVideo;
    }

    /**
     * Returns a list of comments on a video.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * 
     */
    public function removeFromAlbum(): RemoveFromAlbum
    {
        if (!$this->removeFromAlbum) {
            $this->removeFromAlbum = new RemoveFromAlbum($this->_provider);
        }
        return $this->removeFromAlbum;
    }

    /**
     * Reorders the album in the list of user video albums.
     */
    public function reorderAlbums(): ReorderAlbums
    {
        if (!$this->reorderAlbums) {
            $this->reorderAlbums = new ReorderAlbums($this->_provider);
        }
        return $this->reorderAlbums;
    }

    /**
     * Reorders the video in the video album.
     */
    public function reorderVideos(): ReorderVideos
    {
        if (!$this->reorderVideos) {
            $this->reorderVideos = new ReorderVideos($this->_provider);
        }
        return $this->reorderVideos;
    }

    /**
     * Reports (submits a complaint about) a video.
     */
    public function report(): Report
    {
        if (!$this->report) {
            $this->report = new Report($this->_provider);
        }
        return $this->report;
    }

    /**
     * Reports (submits a complaint about) a comment on a video.
     */
    public function reportComment(): ReportComment
    {
        if (!$this->reportComment) {
            $this->reportComment = new ReportComment($this->_provider);
        }
        return $this->reportComment;
    }

    /**
     * Restores a previously deleted video.
     */
    public function restore(): Restore
    {
        if (!$this->restore) {
            $this->restore = new Restore($this->_provider);
        }
        return $this->restore;
    }

    /**
     * Restores a previously deleted comment on a video.
     */
    public function restoreComment(): RestoreComment
    {
        if (!$this->restoreComment) {
            $this->restoreComment = new RestoreComment($this->_provider);
        }
        return $this->restoreComment;
    }

    /**
     * Returns a server address (required for upload) and video data.
     */
    public function save(): Save
    {
        if (!$this->save) {
            $this->save = new Save($this->_provider);
        }
        return $this->save;
    }

    /**
     * Returns a list of videos under the set search criterion.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

}