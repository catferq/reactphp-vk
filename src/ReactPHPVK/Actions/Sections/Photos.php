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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Confirms a tag on a photo.
     */
    public function confirmTag(): ConfirmTag
    {
        return new ConfirmTag($this->_provider);
    }

    /**
     * Allows to copy a photo to the "Saved photos" album
     */
    public function copy(): Copy
    {
        return new Copy($this->_provider);
    }

    /**
     * Creates an empty photo album.
     */
    public function createAlbum(): CreateAlbum
    {
        return new CreateAlbum($this->_provider);
    }

    /**
     * Adds a new comment on the photo.
     */
    public function createComment(): CreateComment
    {
        return new CreateComment($this->_provider);
    }

    /**
     * Deletes a photo.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Deletes a photo album belonging to the current user.
     */
    public function deleteAlbum(): DeleteAlbum
    {
        return new DeleteAlbum($this->_provider);
    }

    /**
     * Deletes a comment on the photo.
     */
    public function deleteComment(): DeleteComment
    {
        return new DeleteComment($this->_provider);
    }

    /**
     * Edits the caption of a photo.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Edits information about a photo album.
     */
    public function editAlbum(): EditAlbum
    {
        return new EditAlbum($this->_provider);
    }

    /**
     * Edits a comment on a photo.
     */
    public function editComment(): EditComment
    {
        return new EditComment($this->_provider);
    }

    /**
     * Returns a list of a user's or community's photos.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of a user's or community's photo albums.
     */
    public function getAlbums(): GetAlbums
    {
        return new GetAlbums($this->_provider);
    }

    /**
     * Returns the number of photo albums belonging to a user or community.
     */
    public function getAlbumsCount(): GetAlbumsCount
    {
        return new GetAlbumsCount($this->_provider);
    }

    /**
     * Returns a list of photos belonging to a user or community, in reverse chronological order.
     */
    public function getAll(): GetAll
    {
        return new GetAll($this->_provider);
    }

    /**
     * Returns a list of comments on a specific photo album or all albums of the user sorted in reverse chronological order.
     */
    public function getAllComments(): GetAllComments
    {
        return new GetAllComments($this->_provider);
    }

    /**
     * Returns information about photos by their IDs.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns an upload link for chat cover pictures.
     */
    public function getChatUploadServer(): GetChatUploadServer
    {
        return new GetChatUploadServer($this->_provider);
    }

    /**
     * Returns a list of comments on a photo.
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Returns the server address for market album photo upload.
     */
    public function getMarketAlbumUploadServer(): GetMarketAlbumUploadServer
    {
        return new GetMarketAlbumUploadServer($this->_provider);
    }

    /**
     * Returns the server address for market photo upload.
     */
    public function getMarketUploadServer(): GetMarketUploadServer
    {
        return new GetMarketUploadServer($this->_provider);
    }

    /**
     * Returns the server address for photo upload in a private message for a user.
     */
    public function getMessagesUploadServer(): GetMessagesUploadServer
    {
        return new GetMessagesUploadServer($this->_provider);
    }

    /**
     * Returns a list of photos with tags that have not been viewed.
     */
    public function getNewTags(): GetNewTags
    {
        return new GetNewTags($this->_provider);
    }

    /**
     * Returns the server address for owner cover upload.
     */
    public function getOwnerCoverPhotoUploadServer(): GetOwnerCoverPhotoUploadServer
    {
        return new GetOwnerCoverPhotoUploadServer($this->_provider);
    }

    /**
     * Returns an upload server address for a profile or community photo.
     */
    public function getOwnerPhotoUploadServer(): GetOwnerPhotoUploadServer
    {
        return new GetOwnerPhotoUploadServer($this->_provider);
    }

    /**
     * Returns a list of tags on a photo.
     */
    public function getTags(): GetTags
    {
        return new GetTags($this->_provider);
    }

    /**
     * Returns the server address for photo upload.
     */
    public function getUploadServer(): GetUploadServer
    {
        return new GetUploadServer($this->_provider);
    }

    /**
     * Returns a list of photos in which a user is tagged.
     */
    public function getUserPhotos(): GetUserPhotos
    {
        return new GetUserPhotos($this->_provider);
    }

    /**
     * Returns the server address for photo upload onto a user's wall.
     */
    public function getWallUploadServer(): GetWallUploadServer
    {
        return new GetWallUploadServer($this->_provider);
    }

    /**
     * Makes a photo into an album cover.
     */
    public function makeCover(): MakeCover
    {
        return new MakeCover($this->_provider);
    }

    /**
     * Moves a photo from one album to another.
     */
    public function move(): Move
    {
        return new Move($this->_provider);
    }

    /**
     * Adds a tag on the photo.
     */
    public function putTag(): PutTag
    {
        return new PutTag($this->_provider);
    }

    /**
     * Removes a tag from a photo.
     */
    public function removeTag(): RemoveTag
    {
        return new RemoveTag($this->_provider);
    }

    /**
     * Reorders the album in the list of user albums.
     */
    public function reorderAlbums(): ReorderAlbums
    {
        return new ReorderAlbums($this->_provider);
    }

    /**
     * Reorders the photo in the list of photos of the user album.
     */
    public function reorderPhotos(): ReorderPhotos
    {
        return new ReorderPhotos($this->_provider);
    }

    /**
     * Reports (submits a complaint about) a photo.
     */
    public function report(): Report
    {
        return new Report($this->_provider);
    }

    /**
     * Reports (submits a complaint about) a comment on a photo.
     */
    public function reportComment(): ReportComment
    {
        return new ReportComment($this->_provider);
    }

    /**
     * Restores a deleted photo.
     */
    public function restore(): Restore
    {
        return new Restore($this->_provider);
    }

    /**
     * Restores a deleted comment on a photo.
     */
    public function restoreComment(): RestoreComment
    {
        return new RestoreComment($this->_provider);
    }

    /**
     * Saves photos after successful uploading.
     */
    public function save(): Save
    {
        return new Save($this->_provider);
    }

    /**
     * Saves market album photos after successful uploading.
     */
    public function saveMarketAlbumPhoto(): SaveMarketAlbumPhoto
    {
        return new SaveMarketAlbumPhoto($this->_provider);
    }

    /**
     * Saves market photos after successful uploading.
     */
    public function saveMarketPhoto(): SaveMarketPhoto
    {
        return new SaveMarketPhoto($this->_provider);
    }

    /**
     * Saves a photo after being successfully uploaded. URL obtained with [vk.com/dev/photos.getMessagesUploadServer|photos.getMessagesUploadServer] method.
     */
    public function saveMessagesPhoto(): SaveMessagesPhoto
    {
        return new SaveMessagesPhoto($this->_provider);
    }

    /**
     * Saves cover photo after successful uploading.
     */
    public function saveOwnerCoverPhoto(): SaveOwnerCoverPhoto
    {
        return new SaveOwnerCoverPhoto($this->_provider);
    }

    /**
     * Saves a profile or community photo. Upload URL can be got with the [vk.com/dev/photos.getOwnerPhotoUploadServer|photos.getOwnerPhotoUploadServer] method.
     */
    public function saveOwnerPhoto(): SaveOwnerPhoto
    {
        return new SaveOwnerPhoto($this->_provider);
    }

    /**
     * Saves a photo to a user's or community's wall after being uploaded.
     */
    public function saveWallPhoto(): SaveWallPhoto
    {
        return new SaveWallPhoto($this->_provider);
    }

    /**
     * Returns a list of photos.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

}