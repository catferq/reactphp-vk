<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Photos
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Confirms a tag on a photo.
     * 
     * @param string $photoId Photo ID.
     * @param int $tagId Tag ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function confirmTag(string $photoId, int $tagId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        $sendParams['tag_id'] = $tagId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.confirmTag', $sendParams);
    }

    /**
     * Allows to copy a photo to the "Saved photos" album
     * 
     * @param int $ownerId photo's owner ID
     * @param int $photoId photo ID
     * @param string|null $accessKey for private photos
     * @param array|null $custom
     * @return Promise
     */
    function copy(int $ownerId, int $photoId, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['photo_id'] = $photoId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.copy', $sendParams);
    }

    /**
     * Creates an empty photo album.
     * 
     * @param string $title Album title.
     * @param int|null $groupId ID of the community in which the album will be created.
     * @param string|null $description Album description.
     * @param array|null $privacyView
     * @param array|null $privacyComment
     * @param bool|null $uploadByAdminsOnly
     * @param bool|null $commentsDisabled
     * @param array|null $custom
     * @return Promise
     */
    function createAlbum(string $title, ?int $groupId = 0, ?string $description = '', ?array $privacyView = [], ?array $privacyComment = [], ?bool $uploadByAdminsOnly = false, ?bool $commentsDisabled = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['title'] = $title;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($description !== '' && $description != null) $sendParams['description'] = $description;
        if ($privacyView !== [] && $privacyView != null) $sendParams['privacy_view'] = implode(',', $privacyView);
        if ($privacyComment !== [] && $privacyComment != null) $sendParams['privacy_comment'] = implode(',', $privacyComment);
        if ($uploadByAdminsOnly !== false && $uploadByAdminsOnly != null) $sendParams['upload_by_admins_only'] = intval($uploadByAdminsOnly);
        if ($commentsDisabled !== false && $commentsDisabled != null) $sendParams['comments_disabled'] = intval($commentsDisabled);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.createAlbum', $sendParams);
    }

    /**
     * Adds a new comment on the photo.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param string|null $message Comment text.
     * @param array|null $attachments (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — Media attachment owner ID. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
     * @param bool|null $fromGroup '1' — to post a comment from the community
     * @param int|null $replyToComment
     * @param int|null $stickerId
     * @param string|null $accessKey
     * @param string|null $guid
     * @param array|null $custom
     * @return Promise
     */
    function createComment(int $photoId, ?int $ownerId = 0, ?string $message = '', ?array $attachments = [], ?bool $fromGroup = false, ?int $replyToComment = 0, ?int $stickerId = 0, ?string $accessKey = '', ?string $guid = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($fromGroup !== false && $fromGroup != null) $sendParams['from_group'] = intval($fromGroup);
        if ($replyToComment !== 0 && $replyToComment != null) $sendParams['reply_to_comment'] = $replyToComment;
        if ($stickerId !== 0 && $stickerId != null) $sendParams['sticker_id'] = $stickerId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.createComment', $sendParams);
    }

    /**
     * Deletes a photo.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $photoId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.delete', $sendParams);
    }

    /**
     * Deletes a photo album belonging to the current user.
     * 
     * @param int $albumId Album ID.
     * @param int|null $groupId ID of the community that owns the album.
     * @param array|null $custom
     * @return Promise
     */
    function deleteAlbum(int $albumId, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['album_id'] = $albumId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.deleteAlbum', $sendParams);
    }

    /**
     * Deletes a comment on the photo.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function deleteComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.deleteComment', $sendParams);
    }

    /**
     * Edits the caption of a photo.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param string|null $caption New caption for the photo. If this parameter is not set, it is considered to be equal to an empty string.
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string|null $placeStr
     * @param string|null $foursquareId
     * @param bool|null $deletePlace
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $photoId, ?int $ownerId = 0, ?string $caption = '', ?float $latitude = 0, ?float $longitude = 0, ?string $placeStr = '', ?string $foursquareId = '', ?bool $deletePlace = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($caption !== '' && $caption != null) $sendParams['caption'] = $caption;
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($placeStr !== '' && $placeStr != null) $sendParams['place_str'] = $placeStr;
        if ($foursquareId !== '' && $foursquareId != null) $sendParams['foursquare_id'] = $foursquareId;
        if ($deletePlace !== false && $deletePlace != null) $sendParams['delete_place'] = intval($deletePlace);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.edit', $sendParams);
    }

    /**
     * Edits information about a photo album.
     * 
     * @param int $albumId ID of the photo album to be edited.
     * @param string|null $title New album title.
     * @param string|null $description New album description.
     * @param int|null $ownerId ID of the user or community that owns the album.
     * @param array|null $privacyView
     * @param array|null $privacyComment
     * @param bool|null $uploadByAdminsOnly
     * @param bool|null $commentsDisabled
     * @param array|null $custom
     * @return Promise
     */
    function editAlbum(int $albumId, ?string $title = '', ?string $description = '', ?int $ownerId = 0, ?array $privacyView = [], ?array $privacyComment = [], ?bool $uploadByAdminsOnly = false, ?bool $commentsDisabled = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['album_id'] = $albumId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($description !== '' && $description != null) $sendParams['description'] = $description;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($privacyView !== [] && $privacyView != null) $sendParams['privacy_view'] = implode(',', $privacyView);
        if ($privacyComment !== [] && $privacyComment != null) $sendParams['privacy_comment'] = implode(',', $privacyComment);
        if ($uploadByAdminsOnly !== false && $uploadByAdminsOnly != null) $sendParams['upload_by_admins_only'] = intval($uploadByAdminsOnly);
        if ($commentsDisabled !== false && $commentsDisabled != null) $sendParams['comments_disabled'] = intval($commentsDisabled);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.editAlbum', $sendParams);
    }

    /**
     * Edits a comment on a photo.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param string|null $message New text of the comment.
     * @param array|null $attachments (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — Media attachment owner ID. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
     * @param array|null $custom
     * @return Promise
     */
    function editComment(int $commentId, ?int $ownerId = 0, ?string $message = '', ?array $attachments = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.editComment', $sendParams);
    }

    /**
     * Returns a list of a user's or community's photos.
     * 
     * @param int|null $ownerId ID of the user or community that owns the photos. Use a negative value to designate a community ID.
     * @param string|null $albumId Photo album ID. To return information about photos from service albums, use the following string values: 'profile, wall, saved'.
     * @param array|null $photoIds Photo IDs.
     * @param bool|null $rev Sort order: '1' — reverse chronological, '0' — chronological
     * @param bool|null $extended '1' — to return additional 'likes', 'comments', and 'tags' fields, '0' — (default)
     * @param string|null $feedType Type of feed obtained in 'feed' field of the method.
     * @param int|null $feed unixtime, that can be obtained with [vk.com/dev/newsfeed.get|newsfeed.get] method in date field to get all photos uploaded by the user on a specific day, or photos the user has been tagged on. Also, 'uid' parameter of the user the event happened with shall be specified.
     * @param bool|null $photoSizes '1' — to return photo sizes in a [vk.com/dev/photo_sizes|special format]
     * @param int|null $offset
     * @param int|null $count
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $ownerId = 0, ?string $albumId = '', ?array $photoIds = [], ?bool $rev = false, ?bool $extended = false, ?string $feedType = '', ?int $feed = 0, ?bool $photoSizes = false, ?int $offset = 0, ?int $count = 50, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($albumId !== '' && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($photoIds !== [] && $photoIds != null) $sendParams['photo_ids'] = implode(',', $photoIds);
        if ($rev !== false && $rev != null) $sendParams['rev'] = intval($rev);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($feedType !== '' && $feedType != null) $sendParams['feed_type'] = $feedType;
        if ($feed !== 0 && $feed != null) $sendParams['feed'] = $feed;
        if ($photoSizes !== false && $photoSizes != null) $sendParams['photo_sizes'] = intval($photoSizes);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 50 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.get', $sendParams);
    }

    /**
     * Returns a list of a user's or community's photo albums.
     * 
     * @param int|null $ownerId ID of the user or community that owns the albums.
     * @param array|null $albumIds Album IDs.
     * @param int|null $offset Offset needed to return a specific subset of albums.
     * @param int|null $count Number of albums to return.
     * @param bool|null $needSystem '1' — to return system albums with negative IDs
     * @param bool|null $needCovers '1' — to return an additional 'thumb_src' field, '0' — (default)
     * @param bool|null $photoSizes '1' — to return photo sizes in a
     * @param array|null $custom
     * @return Promise
     */
    function getAlbums(?int $ownerId = 0, ?array $albumIds = [], ?int $offset = 0, ?int $count = 0, ?bool $needSystem = false, ?bool $needCovers = false, ?bool $photoSizes = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($albumIds !== [] && $albumIds != null) $sendParams['album_ids'] = implode(',', $albumIds);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($needSystem !== false && $needSystem != null) $sendParams['need_system'] = intval($needSystem);
        if ($needCovers !== false && $needCovers != null) $sendParams['need_covers'] = intval($needCovers);
        if ($photoSizes !== false && $photoSizes != null) $sendParams['photo_sizes'] = intval($photoSizes);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getAlbums', $sendParams);
    }

    /**
     * Returns the number of photo albums belonging to a user or community.
     * 
     * @param int|null $userId User ID.
     * @param int|null $groupId Community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getAlbumsCount(?int $userId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getAlbumsCount', $sendParams);
    }

    /**
     * Returns a list of photos belonging to a user or community, in reverse chronological order.
     * 
     * @param int|null $ownerId ID of a user or community that owns the photos. Use a negative value to designate a community ID.
     * @param bool|null $extended '1' — to return detailed information about photos
     * @param int|null $offset Offset needed to return a specific subset of photos. By default, '0'.
     * @param int|null $count Number of photos to return.
     * @param bool|null $photoSizes '1' – to return image sizes in [vk.com/dev/photo_sizes|special format].
     * @param bool|null $noServiceAlbums '1' – to return photos only from standard albums, '0' – to return all photos including those in service albums, e.g., 'My wall photos' (default)
     * @param bool|null $needHidden '1' – to show information about photos being hidden from the block above the wall.
     * @param bool|null $skipHidden '1' – not to return photos being hidden from the block above the wall. Works only with owner_id>0, no_service_albums is ignored.
     * @param array|null $custom
     * @return Promise
     */
    function getAll(?int $ownerId = 0, ?bool $extended = false, ?int $offset = 0, ?int $count = 20, ?bool $photoSizes = false, ?bool $noServiceAlbums = false, ?bool $needHidden = false, ?bool $skipHidden = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($photoSizes !== false && $photoSizes != null) $sendParams['photo_sizes'] = intval($photoSizes);
        if ($noServiceAlbums !== false && $noServiceAlbums != null) $sendParams['no_service_albums'] = intval($noServiceAlbums);
        if ($needHidden !== false && $needHidden != null) $sendParams['need_hidden'] = intval($needHidden);
        if ($skipHidden !== false && $skipHidden != null) $sendParams['skip_hidden'] = intval($skipHidden);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getAll', $sendParams);
    }

    /**
     * Returns a list of comments on a specific photo album or all albums of the user sorted in reverse chronological order.
     * 
     * @param int|null $ownerId ID of the user or community that owns the album(s).
     * @param int|null $albumId Album ID. If the parameter is not set, comments on all of the user's albums will be returned.
     * @param bool|null $needLikes '1' — to return an additional 'likes' field, '0' — (default)
     * @param int|null $offset Offset needed to return a specific subset of comments. By default, '0'.
     * @param int|null $count Number of comments to return. By default, '20'. Maximum value, '100'.
     * @param array|null $custom
     * @return Promise
     */
    function getAllComments(?int $ownerId = 0, ?int $albumId = 0, ?bool $needLikes = false, ?int $offset = 0, ?int $count = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($needLikes !== false && $needLikes != null) $sendParams['need_likes'] = intval($needLikes);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getAllComments', $sendParams);
    }

    /**
     * Returns information about photos by their IDs.
     * 
     * @param array $photos IDs separated with a comma, that are IDs of users who posted photos and IDs of photos themselves with an underscore character between such IDs. To get information about a photo in the group album, you shall specify group ID instead of user ID. Example: "1_129207899,6492_135055734, , -20629724_271945303"
     * @param bool|null $extended '1' — to return additional fields, '0' — (default)
     * @param bool|null $photoSizes '1' — to return photo sizes in a
     * @param array|null $custom
     * @return Promise
     */
    function getById(array $photos, ?bool $extended = false, ?bool $photoSizes = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photos'] = implode(',', $photos);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($photoSizes !== false && $photoSizes != null) $sendParams['photo_sizes'] = intval($photoSizes);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getById', $sendParams);
    }

    /**
     * Returns an upload link for chat cover pictures.
     * 
     * @param int $chatId ID of the chat for which you want to upload a cover photo.
     * @param int|null $cropX
     * @param int|null $cropY
     * @param int|null $cropWidth Width (in pixels) of the photo after cropping.
     * @param array|null $custom
     * @return Promise
     */
    function getChatUploadServer(int $chatId, ?int $cropX = 0, ?int $cropY = 0, ?int $cropWidth = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['chat_id'] = $chatId;
        if ($cropX !== 0 && $cropX != null) $sendParams['crop_x'] = $cropX;
        if ($cropY !== 0 && $cropY != null) $sendParams['crop_y'] = $cropY;
        if ($cropWidth !== 0 && $cropWidth != null) $sendParams['crop_width'] = $cropWidth;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getChatUploadServer', $sendParams);
    }

    /**
     * Returns a list of comments on a photo.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param bool|null $needLikes '1' — to return an additional 'likes' field, '0' — (default)
     * @param int|null $startCommentId
     * @param int|null $offset Offset needed to return a specific subset of comments. By default, '0'.
     * @param int|null $count Number of comments to return.
     * @param string|null $sort Sort order: 'asc' — old first, 'desc' — new first
     * @param string|null $accessKey
     * @param bool|null $extended
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getComments(int $photoId, ?int $ownerId = 0, ?bool $needLikes = false, ?int $startCommentId = 0, ?int $offset = 0, ?int $count = 20, ?string $sort = '', ?string $accessKey = '', ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($needLikes !== false && $needLikes != null) $sendParams['need_likes'] = intval($needLikes);
        if ($startCommentId !== 0 && $startCommentId != null) $sendParams['start_comment_id'] = $startCommentId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($sort !== '' && $sort != null) $sendParams['sort'] = $sort;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getComments', $sendParams);
    }

    /**
     * Returns the server address for market album photo upload.
     * 
     * @param int $groupId Community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getMarketAlbumUploadServer(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getMarketAlbumUploadServer', $sendParams);
    }

    /**
     * Returns the server address for market photo upload.
     * 
     * @param int $groupId Community ID.
     * @param bool|null $mainPhoto '1' if you want to upload the main item photo.
     * @param int|null $cropX X coordinate of the crop left upper corner.
     * @param int|null $cropY Y coordinate of the crop left upper corner.
     * @param int|null $cropWidth Width of the cropped photo in px.
     * @param array|null $custom
     * @return Promise
     */
    function getMarketUploadServer(int $groupId, ?bool $mainPhoto = false, ?int $cropX = 0, ?int $cropY = 0, ?int $cropWidth = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($mainPhoto !== false && $mainPhoto != null) $sendParams['main_photo'] = intval($mainPhoto);
        if ($cropX !== 0 && $cropX != null) $sendParams['crop_x'] = $cropX;
        if ($cropY !== 0 && $cropY != null) $sendParams['crop_y'] = $cropY;
        if ($cropWidth !== 0 && $cropWidth != null) $sendParams['crop_width'] = $cropWidth;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getMarketUploadServer', $sendParams);
    }

    /**
     * Returns the server address for photo upload in a private message for a user.
     * 
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * @param array|null $custom
     * @return Promise
     */
    function getMessagesUploadServer(?int $peerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getMessagesUploadServer', $sendParams);
    }

    /**
     * Returns a list of photos with tags that have not been viewed.
     * 
     * @param int|null $offset Offset needed to return a specific subset of photos.
     * @param int|null $count Number of photos to return.
     * @param array|null $custom
     * @return Promise
     */
    function getNewTags(?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getNewTags', $sendParams);
    }

    /**
     * Returns the server address for owner cover upload.
     * 
     * @param int $groupId ID of community that owns the album (if the photo will be uploaded to a community album).
     * @param int|null $cropX X coordinate of the left-upper corner
     * @param int|null $cropY Y coordinate of the left-upper corner
     * @param int|null $cropX2 X coordinate of the right-bottom corner
     * @param int|null $cropY2 Y coordinate of the right-bottom corner
     * @param array|null $custom
     * @return Promise
     */
    function getOwnerCoverPhotoUploadServer(int $groupId, ?int $cropX = 0, ?int $cropY = 0, ?int $cropX2 = 795, ?int $cropY2 = 200, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($cropX !== 0 && $cropX != null) $sendParams['crop_x'] = $cropX;
        if ($cropY !== 0 && $cropY != null) $sendParams['crop_y'] = $cropY;
        if ($cropX2 !== 795 && $cropX2 != null) $sendParams['crop_x2'] = $cropX2;
        if ($cropY2 !== 200 && $cropY2 != null) $sendParams['crop_y2'] = $cropY2;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getOwnerCoverPhotoUploadServer', $sendParams);
    }

    /**
     * Returns an upload server address for a profile or community photo.
     * 
     * @param int|null $ownerId identifier of a community or current user. "Note that community id must be negative. 'owner_id=1' – user, 'owner_id=-1' – community, "
     * @param array|null $custom
     * @return Promise
     */
    function getOwnerPhotoUploadServer(?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getOwnerPhotoUploadServer', $sendParams);
    }

    /**
     * Returns a list of tags on a photo.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param string|null $accessKey
     * @param array|null $custom
     * @return Promise
     */
    function getTags(int $photoId, ?int $ownerId = 0, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getTags', $sendParams);
    }

    /**
     * Returns the server address for photo upload.
     * 
     * @param int|null $groupId ID of community that owns the album (if the photo will be uploaded to a community album).
     * @param int|null $albumId
     * @param array|null $custom
     * @return Promise
     */
    function getUploadServer(?int $groupId = 0, ?int $albumId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getUploadServer', $sendParams);
    }

    /**
     * Returns a list of photos in which a user is tagged.
     * 
     * @param int|null $userId User ID.
     * @param int|null $offset Offset needed to return a specific subset of photos. By default, '0'.
     * @param int|null $count Number of photos to return. Maximum value is 1000.
     * @param bool|null $extended '1' — to return an additional 'likes' field, '0' — (default)
     * @param string|null $sort Sort order: '1' — by date the tag was added in ascending order, '0' — by date the tag was added in descending order
     * @param array|null $custom
     * @return Promise
     */
    function getUserPhotos(?int $userId = 0, ?int $offset = 0, ?int $count = 20, ?bool $extended = false, ?string $sort = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($sort !== '' && $sort != null) $sendParams['sort'] = $sort;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getUserPhotos', $sendParams);
    }

    /**
     * Returns the server address for photo upload onto a user's wall.
     * 
     * @param int|null $groupId ID of community to whose wall the photo will be uploaded.
     * @param array|null $custom
     * @return Promise
     */
    function getWallUploadServer(?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.getWallUploadServer', $sendParams);
    }

    /**
     * Makes a photo into an album cover.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param int|null $albumId Album ID.
     * @param array|null $custom
     * @return Promise
     */
    function makeCover(int $photoId, ?int $ownerId = 0, ?int $albumId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.makeCover', $sendParams);
    }

    /**
     * Moves a photo from one album to another.
     * 
     * @param int $targetAlbumId ID of the album to which the photo will be moved.
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function move(int $targetAlbumId, int $photoId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['target_album_id'] = $targetAlbumId;
        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.move', $sendParams);
    }

    /**
     * Adds a tag on the photo.
     * 
     * @param int $photoId Photo ID.
     * @param int $userId ID of the user to be tagged.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param float|null $x Upper left-corner coordinate of the tagged area (as a percentage of the photo's width).
     * @param float|null $y Upper left-corner coordinate of the tagged area (as a percentage of the photo's height).
     * @param float|null $x2 Lower right-corner coordinate of the tagged area (as a percentage of the photo's width).
     * @param float|null $y2 Lower right-corner coordinate of the tagged area (as a percentage of the photo's height).
     * @param array|null $custom
     * @return Promise
     */
    function putTag(int $photoId, int $userId, ?int $ownerId = 0, ?float $x = 0, ?float $y = 0, ?float $x2 = 0, ?float $y2 = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        $sendParams['user_id'] = $userId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($x !== 0 && $x != null) $sendParams[''] = $x;
        if ($y !== 0 && $y != null) $sendParams[''] = $y;
        if ($x2 !== 0 && $x2 != null) $sendParams['x2'] = $x2;
        if ($y2 !== 0 && $y2 != null) $sendParams['y2'] = $y2;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.putTag', $sendParams);
    }

    /**
     * Removes a tag from a photo.
     * 
     * @param int $photoId Photo ID.
     * @param int $tagId Tag ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function removeTag(int $photoId, int $tagId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        $sendParams['tag_id'] = $tagId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.removeTag', $sendParams);
    }

    /**
     * Reorders the album in the list of user albums.
     * 
     * @param int $albumId Album ID.
     * @param int|null $ownerId ID of the user or community that owns the album.
     * @param int|null $before ID of the album before which the album in question shall be placed.
     * @param int|null $after ID of the album after which the album in question shall be placed.
     * @param array|null $custom
     * @return Promise
     */
    function reorderAlbums(int $albumId, ?int $ownerId = 0, ?int $before = 0, ?int $after = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['album_id'] = $albumId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($before !== 0 && $before != null) $sendParams['before'] = $before;
        if ($after !== 0 && $after != null) $sendParams['after'] = $after;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.reorderAlbums', $sendParams);
    }

    /**
     * Reorders the photo in the list of photos of the user album.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param int|null $before ID of the photo before which the photo in question shall be placed.
     * @param int|null $after ID of the photo after which the photo in question shall be placed.
     * @param array|null $custom
     * @return Promise
     */
    function reorderPhotos(int $photoId, ?int $ownerId = 0, ?int $before = 0, ?int $after = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($before !== 0 && $before != null) $sendParams['before'] = $before;
        if ($after !== 0 && $after != null) $sendParams['after'] = $after;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.reorderPhotos', $sendParams);
    }

    /**
     * Reports (submits a complaint about) a photo.
     * 
     * @param int $ownerId ID of the user or community that owns the photo.
     * @param int $photoId Photo ID.
     * @param int|null $reason Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     * @param array|null $custom
     * @return Promise
     */
    function report(int $ownerId, int $photoId, ?int $reason = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['photo_id'] = $photoId;
        if ($reason !== 0 && $reason != null) $sendParams['reason'] = $reason;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.report', $sendParams);
    }

    /**
     * Reports (submits a complaint about) a comment on a photo.
     * 
     * @param int $ownerId ID of the user or community that owns the photo.
     * @param int $commentId ID of the comment being reported.
     * @param int|null $reason Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     * @param array|null $custom
     * @return Promise
     */
    function reportComment(int $ownerId, int $commentId, ?int $reason = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['comment_id'] = $commentId;
        if ($reason !== 0 && $reason != null) $sendParams['reason'] = $reason;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.reportComment', $sendParams);
    }

    /**
     * Restores a deleted photo.
     * 
     * @param int $photoId Photo ID.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function restore(int $photoId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo_id'] = $photoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.restore', $sendParams);
    }

    /**
     * Restores a deleted comment on a photo.
     * 
     * @param int $commentId ID of the deleted comment.
     * @param int|null $ownerId ID of the user or community that owns the photo.
     * @param array|null $custom
     * @return Promise
     */
    function restoreComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.restoreComment', $sendParams);
    }

    /**
     * Saves photos after successful uploading.
     * 
     * @param int|null $albumId ID of the album to save photos to.
     * @param int|null $groupId ID of the community to save photos to.
     * @param int|null $server Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param string|null $photosList Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param string|null $hash Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param float|null $latitude Geographical latitude, in degrees (from '-90' to '90').
     * @param float|null $longitude Geographical longitude, in degrees (from '-180' to '180').
     * @param string|null $caption Text describing the photo. 2048 digits max.
     * @param array|null $custom
     * @return Promise
     */
    function save(?int $albumId = 0, ?int $groupId = 0, ?int $server = 0, ?string $photosList = '', ?string $hash = '', ?float $latitude = 0, ?float $longitude = 0, ?string $caption = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($server !== 0 && $server != null) $sendParams['server'] = $server;
        if ($photosList !== '' && $photosList != null) $sendParams['photos_list'] = $photosList;
        if ($hash !== '' && $hash != null) $sendParams['hash'] = $hash;
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($caption !== '' && $caption != null) $sendParams['caption'] = $caption;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.save', $sendParams);
    }

    /**
     * Saves market album photos after successful uploading.
     * 
     * @param int $groupId Community ID.
     * @param string $photo Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param int $server Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param string $hash Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param array|null $custom
     * @return Promise
     */
    function saveMarketAlbumPhoto(int $groupId, string $photo, int $server, string $hash, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['photo'] = $photo;
        $sendParams['server'] = $server;
        $sendParams['hash'] = $hash;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.saveMarketAlbumPhoto', $sendParams);
    }

    /**
     * Saves market photos after successful uploading.
     * 
     * @param string $photo Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param int $server Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param string $hash Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param int|null $groupId Community ID.
     * @param string|null $cropData Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param string|null $cropHash Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param array|null $custom
     * @return Promise
     */
    function saveMarketPhoto(string $photo, int $server, string $hash, ?int $groupId = 0, ?string $cropData = '', ?string $cropHash = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo'] = $photo;
        $sendParams['server'] = $server;
        $sendParams['hash'] = $hash;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($cropData !== '' && $cropData != null) $sendParams['crop_data'] = $cropData;
        if ($cropHash !== '' && $cropHash != null) $sendParams['crop_hash'] = $cropHash;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.saveMarketPhoto', $sendParams);
    }

    /**
     * Saves a photo after being successfully uploaded. URL obtained with [vk.com/dev/photos.getMessagesUploadServer|photos.getMessagesUploadServer] method.
     * 
     * @param string $photo Parameter returned when the photo is [vk.com/dev/upload_files|uploaded to the server].
     * @param int|null $server
     * @param string|null $hash
     * @param array|null $custom
     * @return Promise
     */
    function saveMessagesPhoto(string $photo, ?int $server = 0, ?string $hash = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo'] = $photo;
        if ($server !== 0 && $server != null) $sendParams['server'] = $server;
        if ($hash !== '' && $hash != null) $sendParams['hash'] = $hash;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.saveMessagesPhoto', $sendParams);
    }

    /**
     * Saves cover photo after successful uploading.
     * 
     * @param string $hash Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param string $photo Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
     * @param array|null $custom
     * @return Promise
     */
    function saveOwnerCoverPhoto(string $hash, string $photo, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['hash'] = $hash;
        $sendParams['photo'] = $photo;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.saveOwnerCoverPhoto', $sendParams);
    }

    /**
     * Saves a profile or community photo. Upload URL can be got with the [vk.com/dev/photos.getOwnerPhotoUploadServer|photos.getOwnerPhotoUploadServer] method.
     * 
     * @param string|null $server parameter returned after [vk.com/dev/upload_files|photo upload].
     * @param string|null $hash parameter returned after [vk.com/dev/upload_files|photo upload].
     * @param string|null $photo parameter returned after [vk.com/dev/upload_files|photo upload].
     * @param array|null $custom
     * @return Promise
     */
    function saveOwnerPhoto(?string $server = '', ?string $hash = '', ?string $photo = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($server !== '' && $server != null) $sendParams['server'] = $server;
        if ($hash !== '' && $hash != null) $sendParams['hash'] = $hash;
        if ($photo !== '' && $photo != null) $sendParams['photo'] = $photo;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.saveOwnerPhoto', $sendParams);
    }

    /**
     * Saves a photo to a user's or community's wall after being uploaded.
     * 
     * @param string $photo Parameter returned when the the photo is [vk.com/dev/upload_files|uploaded to the server].
     * @param int|null $userId ID of the user on whose wall the photo will be saved.
     * @param int|null $groupId ID of community on whose wall the photo will be saved.
     * @param int|null $server
     * @param string|null $hash
     * @param float|null $latitude Geographical latitude, in degrees (from '-90' to '90').
     * @param float|null $longitude Geographical longitude, in degrees (from '-180' to '180').
     * @param string|null $caption Text describing the photo. 2048 digits max.
     * @param array|null $custom
     * @return Promise
     */
    function saveWallPhoto(string $photo, ?int $userId = 0, ?int $groupId = 0, ?int $server = 0, ?string $hash = '', ?float $latitude = 0, ?float $longitude = 0, ?string $caption = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['photo'] = $photo;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($server !== 0 && $server != null) $sendParams['server'] = $server;
        if ($hash !== '' && $hash != null) $sendParams['hash'] = $hash;
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($caption !== '' && $caption != null) $sendParams['caption'] = $caption;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.saveWallPhoto', $sendParams);
    }

    /**
     * Returns a list of photos.
     * 
     * @param string|null $q Search query string.
     * @param float|null $lat Geographical latitude, in degrees (from '-90' to '90').
     * @param float|null $long Geographical longitude, in degrees (from '-180' to '180').
     * @param int|null $startTime
     * @param int|null $endTime
     * @param int|null $sort Sort order:
     * @param int|null $offset Offset needed to return a specific subset of photos.
     * @param int|null $count Number of photos to return.
     * @param int|null $radius Radius of search in meters (works very approximately). Available values: '10', '100', '800', '6000', '50000'.
     * @param array|null $custom
     * @return Promise
     */
    function search(?string $q = '', ?float $lat = 0, ?float $long = 0, ?int $startTime = 0, ?int $endTime = 0, ?int $sort = 0, ?int $offset = 0, ?int $count = 100, ?int $radius = 5000, ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($radius !== 5000 && $radius != null) $sendParams['radius'] = $radius;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('photos.search', $sendParams);
    }
}