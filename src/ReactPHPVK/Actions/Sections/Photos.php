<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Photos\ConfirmTag;
use ReactPHPVK\Actions\Sections\Photos\Copy;
use ReactPHPVK\Actions\Sections\Photos\CreateAlbum;
use ReactPHPVK\Actions\Sections\Photos\CreateComment;
use ReactPHPVK\Actions\Sections\Photos\Delete;
use ReactPHPVK\Actions\Sections\Photos\DeleteAlbum;
use ReactPHPVK\Actions\Sections\Photos\DeleteComment;
use ReactPHPVK\Actions\Sections\Photos\Edit;
use ReactPHPVK\Actions\Sections\Photos\EditAlbum;
use ReactPHPVK\Actions\Sections\Photos\EditComment;
use ReactPHPVK\Actions\Sections\Photos\Get;
use ReactPHPVK\Actions\Sections\Photos\GetAlbums;
use ReactPHPVK\Actions\Sections\Photos\GetAlbumsCount;
use ReactPHPVK\Actions\Sections\Photos\GetAll;
use ReactPHPVK\Actions\Sections\Photos\GetAllComments;
use ReactPHPVK\Actions\Sections\Photos\GetById;
use ReactPHPVK\Actions\Sections\Photos\GetChatUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetComments;
use ReactPHPVK\Actions\Sections\Photos\GetMarketAlbumUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetMarketUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetMessagesUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetNewTags;
use ReactPHPVK\Actions\Sections\Photos\GetOwnerCoverPhotoUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetOwnerPhotoUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetTags;
use ReactPHPVK\Actions\Sections\Photos\GetUploadServer;
use ReactPHPVK\Actions\Sections\Photos\GetUserPhotos;
use ReactPHPVK\Actions\Sections\Photos\GetWallUploadServer;
use ReactPHPVK\Actions\Sections\Photos\MakeCover;
use ReactPHPVK\Actions\Sections\Photos\Move;
use ReactPHPVK\Actions\Sections\Photos\PutTag;
use ReactPHPVK\Actions\Sections\Photos\RemoveTag;
use ReactPHPVK\Actions\Sections\Photos\ReorderAlbums;
use ReactPHPVK\Actions\Sections\Photos\ReorderPhotos;
use ReactPHPVK\Actions\Sections\Photos\Report;
use ReactPHPVK\Actions\Sections\Photos\ReportComment;
use ReactPHPVK\Actions\Sections\Photos\Restore;
use ReactPHPVK\Actions\Sections\Photos\RestoreComment;
use ReactPHPVK\Actions\Sections\Photos\Save;
use ReactPHPVK\Actions\Sections\Photos\SaveMarketAlbumPhoto;
use ReactPHPVK\Actions\Sections\Photos\SaveMarketPhoto;
use ReactPHPVK\Actions\Sections\Photos\SaveMessagesPhoto;
use ReactPHPVK\Actions\Sections\Photos\SaveOwnerCoverPhoto;
use ReactPHPVK\Actions\Sections\Photos\SaveOwnerPhoto;
use ReactPHPVK\Actions\Sections\Photos\SaveWallPhoto;
use ReactPHPVK\Actions\Sections\Photos\Search;

class Photos
{
    private Provider $_provider;

    private ?Photos\ConfirmTag $confirmTag = null;
    private ?Photos\Copy $copy = null;
    private ?Photos\CreateAlbum $createAlbum = null;
    private ?Photos\CreateComment $createComment = null;
    private ?Photos\Delete $delete = null;
    private ?Photos\DeleteAlbum $deleteAlbum = null;
    private ?Photos\DeleteComment $deleteComment = null;
    private ?Photos\Edit $edit = null;
    private ?Photos\EditAlbum $editAlbum = null;
    private ?Photos\EditComment $editComment = null;
    private ?Photos\Get $get = null;
    private ?Photos\GetAlbums $getAlbums = null;
    private ?Photos\GetAlbumsCount $getAlbumsCount = null;
    private ?Photos\GetAll $getAll = null;
    private ?Photos\GetAllComments $getAllComments = null;
    private ?Photos\GetById $getById = null;
    private ?Photos\GetChatUploadServer $getChatUploadServer = null;
    private ?Photos\GetComments $getComments = null;
    private ?Photos\GetMarketAlbumUploadServer $getMarketAlbumUploadServer = null;
    private ?Photos\GetMarketUploadServer $getMarketUploadServer = null;
    private ?Photos\GetMessagesUploadServer $getMessagesUploadServer = null;
    private ?Photos\GetNewTags $getNewTags = null;
    private ?Photos\GetOwnerCoverPhotoUploadServer $getOwnerCoverPhotoUploadServer = null;
    private ?Photos\GetOwnerPhotoUploadServer $getOwnerPhotoUploadServer = null;
    private ?Photos\GetTags $getTags = null;
    private ?Photos\GetUploadServer $getUploadServer = null;
    private ?Photos\GetUserPhotos $getUserPhotos = null;
    private ?Photos\GetWallUploadServer $getWallUploadServer = null;
    private ?Photos\MakeCover $makeCover = null;
    private ?Photos\Move $move = null;
    private ?Photos\PutTag $putTag = null;
    private ?Photos\RemoveTag $removeTag = null;
    private ?Photos\ReorderAlbums $reorderAlbums = null;
    private ?Photos\ReorderPhotos $reorderPhotos = null;
    private ?Photos\Report $report = null;
    private ?Photos\ReportComment $reportComment = null;
    private ?Photos\Restore $restore = null;
    private ?Photos\RestoreComment $restoreComment = null;
    private ?Photos\Save $save = null;
    private ?Photos\SaveMarketAlbumPhoto $saveMarketAlbumPhoto = null;
    private ?Photos\SaveMarketPhoto $saveMarketPhoto = null;
    private ?Photos\SaveMessagesPhoto $saveMessagesPhoto = null;
    private ?Photos\SaveOwnerCoverPhoto $saveOwnerCoverPhoto = null;
    private ?Photos\SaveOwnerPhoto $saveOwnerPhoto = null;
    private ?Photos\SaveWallPhoto $saveWallPhoto = null;
    private ?Photos\Search $search = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Confirms a tag on a photo.
     */
    public function confirmTag(): ConfirmTag
    {
        if (!$this->confirmTag) {
            $this->confirmTag = new ConfirmTag($this->_provider);
        }
        return $this->confirmTag;
    }

    /**
     * Allows to copy a photo to the "Saved photos" album
     */
    public function copy(): Copy
    {
        if (!$this->copy) {
            $this->copy = new Copy($this->_provider);
        }
        return $this->copy;
    }

    /**
     * Creates an empty photo album.
     */
    public function createAlbum(): CreateAlbum
    {
        if (!$this->createAlbum) {
            $this->createAlbum = new CreateAlbum($this->_provider);
        }
        return $this->createAlbum;
    }

    /**
     * Adds a new comment on the photo.
     */
    public function createComment(): CreateComment
    {
        if (!$this->createComment) {
            $this->createComment = new CreateComment($this->_provider);
        }
        return $this->createComment;
    }

    /**
     * Deletes a photo.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Deletes a photo album belonging to the current user.
     */
    public function deleteAlbum(): DeleteAlbum
    {
        if (!$this->deleteAlbum) {
            $this->deleteAlbum = new DeleteAlbum($this->_provider);
        }
        return $this->deleteAlbum;
    }

    /**
     * Deletes a comment on the photo.
     */
    public function deleteComment(): DeleteComment
    {
        if (!$this->deleteComment) {
            $this->deleteComment = new DeleteComment($this->_provider);
        }
        return $this->deleteComment;
    }

    /**
     * Edits the caption of a photo.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Edits information about a photo album.
     */
    public function editAlbum(): EditAlbum
    {
        if (!$this->editAlbum) {
            $this->editAlbum = new EditAlbum($this->_provider);
        }
        return $this->editAlbum;
    }

    /**
     * Edits a comment on a photo.
     */
    public function editComment(): EditComment
    {
        if (!$this->editComment) {
            $this->editComment = new EditComment($this->_provider);
        }
        return $this->editComment;
    }

    /**
     * Returns a list of a user's or community's photos.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of a user's or community's photo albums.
     */
    public function getAlbums(): GetAlbums
    {
        if (!$this->getAlbums) {
            $this->getAlbums = new GetAlbums($this->_provider);
        }
        return $this->getAlbums;
    }

    /**
     * Returns the number of photo albums belonging to a user or community.
     */
    public function getAlbumsCount(): GetAlbumsCount
    {
        if (!$this->getAlbumsCount) {
            $this->getAlbumsCount = new GetAlbumsCount($this->_provider);
        }
        return $this->getAlbumsCount;
    }

    /**
     * Returns a list of photos belonging to a user or community, in reverse chronological order.
     */
    public function getAll(): GetAll
    {
        if (!$this->getAll) {
            $this->getAll = new GetAll($this->_provider);
        }
        return $this->getAll;
    }

    /**
     * Returns a list of comments on a specific photo album or all albums of the user sorted in reverse chronological order.
     */
    public function getAllComments(): GetAllComments
    {
        if (!$this->getAllComments) {
            $this->getAllComments = new GetAllComments($this->_provider);
        }
        return $this->getAllComments;
    }

    /**
     * Returns information about photos by their IDs.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns an upload link for chat cover pictures.
     */
    public function getChatUploadServer(): GetChatUploadServer
    {
        if (!$this->getChatUploadServer) {
            $this->getChatUploadServer = new GetChatUploadServer($this->_provider);
        }
        return $this->getChatUploadServer;
    }

    /**
     * Returns a list of comments on a photo.
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Returns the server address for market album photo upload.
     */
    public function getMarketAlbumUploadServer(): GetMarketAlbumUploadServer
    {
        if (!$this->getMarketAlbumUploadServer) {
            $this->getMarketAlbumUploadServer = new GetMarketAlbumUploadServer($this->_provider);
        }
        return $this->getMarketAlbumUploadServer;
    }

    /**
     * Returns the server address for market photo upload.
     */
    public function getMarketUploadServer(): GetMarketUploadServer
    {
        if (!$this->getMarketUploadServer) {
            $this->getMarketUploadServer = new GetMarketUploadServer($this->_provider);
        }
        return $this->getMarketUploadServer;
    }

    /**
     * Returns the server address for photo upload in a private message for a user.
     */
    public function getMessagesUploadServer(): GetMessagesUploadServer
    {
        if (!$this->getMessagesUploadServer) {
            $this->getMessagesUploadServer = new GetMessagesUploadServer($this->_provider);
        }
        return $this->getMessagesUploadServer;
    }

    /**
     * Returns a list of photos with tags that have not been viewed.
     */
    public function getNewTags(): GetNewTags
    {
        if (!$this->getNewTags) {
            $this->getNewTags = new GetNewTags($this->_provider);
        }
        return $this->getNewTags;
    }

    /**
     * Returns the server address for owner cover upload.
     */
    public function getOwnerCoverPhotoUploadServer(): GetOwnerCoverPhotoUploadServer
    {
        if (!$this->getOwnerCoverPhotoUploadServer) {
            $this->getOwnerCoverPhotoUploadServer = new GetOwnerCoverPhotoUploadServer($this->_provider);
        }
        return $this->getOwnerCoverPhotoUploadServer;
    }

    /**
     * Returns an upload server address for a profile or community photo.
     */
    public function getOwnerPhotoUploadServer(): GetOwnerPhotoUploadServer
    {
        if (!$this->getOwnerPhotoUploadServer) {
            $this->getOwnerPhotoUploadServer = new GetOwnerPhotoUploadServer($this->_provider);
        }
        return $this->getOwnerPhotoUploadServer;
    }

    /**
     * Returns a list of tags on a photo.
     */
    public function getTags(): GetTags
    {
        if (!$this->getTags) {
            $this->getTags = new GetTags($this->_provider);
        }
        return $this->getTags;
    }

    /**
     * Returns the server address for photo upload.
     */
    public function getUploadServer(): GetUploadServer
    {
        if (!$this->getUploadServer) {
            $this->getUploadServer = new GetUploadServer($this->_provider);
        }
        return $this->getUploadServer;
    }

    /**
     * Returns a list of photos in which a user is tagged.
     */
    public function getUserPhotos(): GetUserPhotos
    {
        if (!$this->getUserPhotos) {
            $this->getUserPhotos = new GetUserPhotos($this->_provider);
        }
        return $this->getUserPhotos;
    }

    /**
     * Returns the server address for photo upload onto a user's wall.
     */
    public function getWallUploadServer(): GetWallUploadServer
    {
        if (!$this->getWallUploadServer) {
            $this->getWallUploadServer = new GetWallUploadServer($this->_provider);
        }
        return $this->getWallUploadServer;
    }

    /**
     * Makes a photo into an album cover.
     */
    public function makeCover(): MakeCover
    {
        if (!$this->makeCover) {
            $this->makeCover = new MakeCover($this->_provider);
        }
        return $this->makeCover;
    }

    /**
     * Moves a photo from one album to another.
     */
    public function move(): Move
    {
        if (!$this->move) {
            $this->move = new Move($this->_provider);
        }
        return $this->move;
    }

    /**
     * Adds a tag on the photo.
     */
    public function putTag(): PutTag
    {
        if (!$this->putTag) {
            $this->putTag = new PutTag($this->_provider);
        }
        return $this->putTag;
    }

    /**
     * Removes a tag from a photo.
     */
    public function removeTag(): RemoveTag
    {
        if (!$this->removeTag) {
            $this->removeTag = new RemoveTag($this->_provider);
        }
        return $this->removeTag;
    }

    /**
     * Reorders the album in the list of user albums.
     */
    public function reorderAlbums(): ReorderAlbums
    {
        if (!$this->reorderAlbums) {
            $this->reorderAlbums = new ReorderAlbums($this->_provider);
        }
        return $this->reorderAlbums;
    }

    /**
     * Reorders the photo in the list of photos of the user album.
     */
    public function reorderPhotos(): ReorderPhotos
    {
        if (!$this->reorderPhotos) {
            $this->reorderPhotos = new ReorderPhotos($this->_provider);
        }
        return $this->reorderPhotos;
    }

    /**
     * Reports (submits a complaint about) a photo.
     */
    public function report(): Report
    {
        if (!$this->report) {
            $this->report = new Report($this->_provider);
        }
        return $this->report;
    }

    /**
     * Reports (submits a complaint about) a comment on a photo.
     */
    public function reportComment(): ReportComment
    {
        if (!$this->reportComment) {
            $this->reportComment = new ReportComment($this->_provider);
        }
        return $this->reportComment;
    }

    /**
     * Restores a deleted photo.
     */
    public function restore(): Restore
    {
        if (!$this->restore) {
            $this->restore = new Restore($this->_provider);
        }
        return $this->restore;
    }

    /**
     * Restores a deleted comment on a photo.
     */
    public function restoreComment(): RestoreComment
    {
        if (!$this->restoreComment) {
            $this->restoreComment = new RestoreComment($this->_provider);
        }
        return $this->restoreComment;
    }

    /**
     * Saves photos after successful uploading.
     */
    public function save(): Save
    {
        if (!$this->save) {
            $this->save = new Save($this->_provider);
        }
        return $this->save;
    }

    /**
     * Saves market album photos after successful uploading.
     */
    public function saveMarketAlbumPhoto(): SaveMarketAlbumPhoto
    {
        if (!$this->saveMarketAlbumPhoto) {
            $this->saveMarketAlbumPhoto = new SaveMarketAlbumPhoto($this->_provider);
        }
        return $this->saveMarketAlbumPhoto;
    }

    /**
     * Saves market photos after successful uploading.
     */
    public function saveMarketPhoto(): SaveMarketPhoto
    {
        if (!$this->saveMarketPhoto) {
            $this->saveMarketPhoto = new SaveMarketPhoto($this->_provider);
        }
        return $this->saveMarketPhoto;
    }

    /**
     * Saves a photo after being successfully uploaded. URL obtained with [vk.com/dev/photos.getMessagesUploadServer|photos.getMessagesUploadServer] method.
     */
    public function saveMessagesPhoto(): SaveMessagesPhoto
    {
        if (!$this->saveMessagesPhoto) {
            $this->saveMessagesPhoto = new SaveMessagesPhoto($this->_provider);
        }
        return $this->saveMessagesPhoto;
    }

    /**
     * Saves cover photo after successful uploading.
     */
    public function saveOwnerCoverPhoto(): SaveOwnerCoverPhoto
    {
        if (!$this->saveOwnerCoverPhoto) {
            $this->saveOwnerCoverPhoto = new SaveOwnerCoverPhoto($this->_provider);
        }
        return $this->saveOwnerCoverPhoto;
    }

    /**
     * Saves a profile or community photo. Upload URL can be got with the [vk.com/dev/photos.getOwnerPhotoUploadServer|photos.getOwnerPhotoUploadServer] method.
     */
    public function saveOwnerPhoto(): SaveOwnerPhoto
    {
        if (!$this->saveOwnerPhoto) {
            $this->saveOwnerPhoto = new SaveOwnerPhoto($this->_provider);
        }
        return $this->saveOwnerPhoto;
    }

    /**
     * Saves a photo to a user's or community's wall after being uploaded.
     */
    public function saveWallPhoto(): SaveWallPhoto
    {
        if (!$this->saveWallPhoto) {
            $this->saveWallPhoto = new SaveWallPhoto($this->_provider);
        }
        return $this->saveWallPhoto;
    }

    /**
     * Returns a list of photos.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

}