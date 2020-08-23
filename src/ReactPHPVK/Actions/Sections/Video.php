<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Video
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Adds a video to a user or community page.
     * 
     * @param int $videoId Video ID.
     * @param int $ownerId ID of the user or community that owns the video. Use a negative value to designate a community ID.
     * @param int|null $targetId identifier of a user or community to add a video to. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function add(int $videoId, int $ownerId, ?int $targetId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['video_id'] = $videoId;
        $sendParams['owner_id'] = $ownerId;
        if ($targetId !== 0 && $targetId != null) $sendParams['target_id'] = $targetId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.add', $sendParams);
    }

    /**
     * Creates an empty album for videos.
     * 
     * @param int|null $groupId Community ID (if the album will be created in a community).
     * @param string|null $title Album title.
     * @param array|null $privacy new access permissions for the album. Possible values: , *'0' – all users,, *'1' – friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
     * @param array|null $custom
     * @return Promise
     */
    function addAlbum(?int $groupId = 0, ?string $title = '', ?array $privacy = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($privacy !== [] && $privacy != null) $sendParams['privacy'] = implode(',', $privacy);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.addAlbum', $sendParams);
    }

    /**
     * video.addToAlbum
     * 
     * @param int $ownerId
     * @param int $videoId
     * @param int|null $targetId
     * @param int|null $albumId
     * @param array|null $albumIds
     * @param array|null $custom
     * @return Promise
     */
    function addToAlbum(int $ownerId, int $videoId, ?int $targetId = 0, ?int $albumId = 0, ?array $albumIds = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['video_id'] = $videoId;
        if ($targetId !== 0 && $targetId != null) $sendParams['target_id'] = $targetId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($albumIds !== [] && $albumIds != null) $sendParams['album_ids'] = implode(',', $albumIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.addToAlbum', $sendParams);
    }

    /**
     * Adds a new comment on a video.
     * 
     * @param int $videoId Video ID.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param string|null $message New comment text.
     * @param array|null $attachments List of objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
     * @param bool|null $fromGroup '1' — to post the comment from a community name (only if 'owner_id'<0)
     * @param int|null $replyToComment
     * @param int|null $stickerId
     * @param string|null $guid
     * @param array|null $custom
     * @return Promise
     */
    function createComment(int $videoId, ?int $ownerId = 0, ?string $message = '', ?array $attachments = [], ?bool $fromGroup = false, ?int $replyToComment = 0, ?int $stickerId = 0, ?string $guid = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['video_id'] = $videoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($fromGroup !== false && $fromGroup != null) $sendParams['from_group'] = intval($fromGroup);
        if ($replyToComment !== 0 && $replyToComment != null) $sendParams['reply_to_comment'] = $replyToComment;
        if ($stickerId !== 0 && $stickerId != null) $sendParams['sticker_id'] = $stickerId;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.createComment', $sendParams);
    }

    /**
     * Deletes a video from a user or community page.
     * 
     * @param int $videoId Video ID.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param int|null $targetId
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $videoId, ?int $ownerId = 0, ?int $targetId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['video_id'] = $videoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($targetId !== 0 && $targetId != null) $sendParams['target_id'] = $targetId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.delete', $sendParams);
    }

    /**
     * Deletes a video album.
     * 
     * @param int $albumId Album ID.
     * @param int|null $groupId Community ID (if the album is owned by a community).
     * @param array|null $custom
     * @return Promise
     */
    function deleteAlbum(int $albumId, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['album_id'] = $albumId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.deleteAlbum', $sendParams);
    }

    /**
     * Deletes a comment on a video.
     * 
     * @param int $commentId ID of the comment to be deleted.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param array|null $custom
     * @return Promise
     */
    function deleteComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.deleteComment', $sendParams);
    }

    /**
     * Edits information about a video on a user or community page.
     * 
     * @param int $videoId Video ID.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param string|null $name New video title.
     * @param string|null $desc New video description.
     * @param array|null $privacyView Privacy settings in a [vk.com/dev/privacy_setting|special format]. Privacy setting is available for videos uploaded to own profile by user.
     * @param array|null $privacyComment Privacy settings for comments in a [vk.com/dev/privacy_setting|special format].
     * @param bool|null $noComments Disable comments for the group video.
     * @param bool|null $repeat '1' — to repeat the playback of the video, '0' — to play the video once,
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $videoId, ?int $ownerId = 0, ?string $name = '', ?string $desc = '', ?array $privacyView = [], ?array $privacyComment = [], ?bool $noComments = false, ?bool $repeat = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['video_id'] = $videoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($name !== '' && $name != null) $sendParams['name'] = $name;
        if ($desc !== '' && $desc != null) $sendParams['desc'] = $desc;
        if ($privacyView !== [] && $privacyView != null) $sendParams['privacy_view'] = implode(',', $privacyView);
        if ($privacyComment !== [] && $privacyComment != null) $sendParams['privacy_comment'] = implode(',', $privacyComment);
        if ($noComments !== false && $noComments != null) $sendParams['no_comments'] = intval($noComments);
        if ($repeat !== false && $repeat != null) $sendParams['repeat'] = intval($repeat);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.edit', $sendParams);
    }

    /**
     * Edits the title of a video album.
     * 
     * @param int $albumId Album ID.
     * @param string $title New album title.
     * @param int|null $groupId Community ID (if the album edited is owned by a community).
     * @param array|null $privacy new access permissions for the album. Possible values: , *'0' – all users,, *'1' – friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
     * @param array|null $custom
     * @return Promise
     */
    function editAlbum(int $albumId, string $title, ?int $groupId = 0, ?array $privacy = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['album_id'] = $albumId;
        $sendParams['title'] = $title;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($privacy !== [] && $privacy != null) $sendParams['privacy'] = implode(',', $privacy);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.editAlbum', $sendParams);
    }

    /**
     * Edits the text of a comment on a video.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param string|null $message New comment text.
     * @param array|null $attachments List of objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
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

        return $this->provider->request('video.editComment', $sendParams);
    }

    /**
     * Returns detailed information about videos.
     * 
     * @param int|null $ownerId ID of the user or community that owns the video(s).
     * @param array|null $videos Video IDs, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", Use a negative value to designate a community ID. Example: "-4363_136089719,13245770_137352259"
     * @param int|null $albumId ID of the album containing the video(s).
     * @param int|null $count Number of videos to return.
     * @param int|null $offset Offset needed to return a specific subset of videos.
     * @param bool|null $extended '1' — to return an extended response with additional fields
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $ownerId = 0, ?array $videos = [], ?int $albumId = 0, ?int $count = 100, ?int $offset = 0, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($videos !== [] && $videos != null) $sendParams['videos'] = implode(',', $videos);
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.get', $sendParams);
    }

    /**
     * Returns video album info
     * 
     * @param int $albumId Album ID.
     * @param int|null $ownerId identifier of a user or community to add a video to. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getAlbumById(int $albumId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['album_id'] = $albumId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.getAlbumById', $sendParams);
    }

    /**
     * Returns a list of video albums owned by a user or community.
     * 
     * @param int|null $ownerId ID of the user or community that owns the video album(s).
     * @param int|null $offset Offset needed to return a specific subset of video albums.
     * @param int|null $count Number of video albums to return.
     * @param bool|null $extended '1' — to return additional information about album privacy settings for the current user
     * @param bool|null $needSystem
     * @param array|null $custom
     * @return Promise
     */
    function getAlbums(?int $ownerId = 0, ?int $offset = 0, ?int $count = 50, ?bool $extended = false, ?bool $needSystem = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 50 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($needSystem !== false && $needSystem != null) $sendParams['need_system'] = intval($needSystem);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.getAlbums', $sendParams);
    }

    /**
     * video.getAlbumsByVideo
     * 
     * @param int $ownerId
     * @param int $videoId
     * @param int|null $targetId
     * @param bool|null $extended
     * @param array|null $custom
     * @return Promise
     */
    function getAlbumsByVideo(int $ownerId, int $videoId, ?int $targetId = 0, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['video_id'] = $videoId;
        if ($targetId !== 0 && $targetId != null) $sendParams['target_id'] = $targetId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.getAlbumsByVideo', $sendParams);
    }

    /**
     * Returns a list of comments on a video.
     * 
     * @param int $videoId Video ID.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param bool|null $needLikes '1' — to return an additional 'likes' field
     * @param int|null $startCommentId
     * @param int|null $offset Offset needed to return a specific subset of comments.
     * @param int|null $count Number of comments to return.
     * @param string|null $sort Sort order: 'asc' — oldest comment first, 'desc' — newest comment first
     * @param bool|null $extended
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getComments(int $videoId, ?int $ownerId = 0, ?bool $needLikes = false, ?int $startCommentId = 0, ?int $offset = 0, ?int $count = 20, ?string $sort = '', ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['video_id'] = $videoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($needLikes !== false && $needLikes != null) $sendParams['need_likes'] = intval($needLikes);
        if ($startCommentId !== 0 && $startCommentId != null) $sendParams['start_comment_id'] = $startCommentId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($sort !== '' && $sort != null) $sendParams['sort'] = $sort;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.getComments', $sendParams);
    }

    /**
     * video.removeFromAlbum
     * 
     * @param int $ownerId
     * @param int $videoId
     * @param int|null $targetId
     * @param int|null $albumId
     * @param array|null $albumIds
     * @param array|null $custom
     * @return Promise
     */
    function removeFromAlbum(int $ownerId, int $videoId, ?int $targetId = 0, ?int $albumId = 0, ?array $albumIds = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['video_id'] = $videoId;
        if ($targetId !== 0 && $targetId != null) $sendParams['target_id'] = $targetId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($albumIds !== [] && $albumIds != null) $sendParams['album_ids'] = implode(',', $albumIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.removeFromAlbum', $sendParams);
    }

    /**
     * Reorders the album in the list of user video albums.
     * 
     * @param int $albumId Album ID.
     * @param int|null $ownerId ID of the user or community that owns the albums..
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

        return $this->provider->request('video.reorderAlbums', $sendParams);
    }

    /**
     * Reorders the video in the video album.
     * 
     * @param int $ownerId ID of the user or community that owns the video.
     * @param int $videoId ID of the video.
     * @param int|null $targetId ID of the user or community that owns the album with videos.
     * @param int|null $albumId ID of the video album.
     * @param int|null $beforeOwnerId ID of the user or community that owns the video before which the video in question shall be placed.
     * @param int|null $beforeVideoId ID of the video before which the video in question shall be placed.
     * @param int|null $afterOwnerId ID of the user or community that owns the video after which the photo in question shall be placed.
     * @param int|null $afterVideoId ID of the video after which the photo in question shall be placed.
     * @param array|null $custom
     * @return Promise
     */
    function reorderVideos(int $ownerId, int $videoId, ?int $targetId = 0, ?int $albumId = 0, ?int $beforeOwnerId = 0, ?int $beforeVideoId = 0, ?int $afterOwnerId = 0, ?int $afterVideoId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['video_id'] = $videoId;
        if ($targetId !== 0 && $targetId != null) $sendParams['target_id'] = $targetId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($beforeOwnerId !== 0 && $beforeOwnerId != null) $sendParams['before_owner_id'] = $beforeOwnerId;
        if ($beforeVideoId !== 0 && $beforeVideoId != null) $sendParams['before_video_id'] = $beforeVideoId;
        if ($afterOwnerId !== 0 && $afterOwnerId != null) $sendParams['after_owner_id'] = $afterOwnerId;
        if ($afterVideoId !== 0 && $afterVideoId != null) $sendParams['after_video_id'] = $afterVideoId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.reorderVideos', $sendParams);
    }

    /**
     * Reports (submits a complaint about) a video.
     * 
     * @param int $ownerId ID of the user or community that owns the video.
     * @param int $videoId Video ID.
     * @param int|null $reason Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     * @param string|null $comment Comment describing the complaint.
     * @param string|null $searchQuery (If the video was found in search results.) Search query string.
     * @param array|null $custom
     * @return Promise
     */
    function report(int $ownerId, int $videoId, ?int $reason = 0, ?string $comment = '', ?string $searchQuery = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['video_id'] = $videoId;
        if ($reason !== 0 && $reason != null) $sendParams['reason'] = $reason;
        if ($comment !== '' && $comment != null) $sendParams['comment'] = $comment;
        if ($searchQuery !== '' && $searchQuery != null) $sendParams['search_query'] = $searchQuery;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.report', $sendParams);
    }

    /**
     * Reports (submits a complaint about) a comment on a video.
     * 
     * @param int $ownerId ID of the user or community that owns the video.
     * @param int $commentId ID of the comment being reported.
     * @param int|null $reason Reason for the complaint: , 0 – spam , 1 – child pornography , 2 – extremism , 3 – violence , 4 – drug propaganda , 5 – adult material , 6 – insult, abuse
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

        return $this->provider->request('video.reportComment', $sendParams);
    }

    /**
     * Restores a previously deleted video.
     * 
     * @param int $videoId Video ID.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param array|null $custom
     * @return Promise
     */
    function restore(int $videoId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['video_id'] = $videoId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.restore', $sendParams);
    }

    /**
     * Restores a previously deleted comment on a video.
     * 
     * @param int $commentId ID of the deleted comment.
     * @param int|null $ownerId ID of the user or community that owns the video.
     * @param array|null $custom
     * @return Promise
     */
    function restoreComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.restoreComment', $sendParams);
    }

    /**
     * Returns a server address (required for upload) and video data.
     * 
     * @param string|null $name Name of the video.
     * @param string|null $description Description of the video.
     * @param bool|null $isPrivate '1' — to designate the video as private (send it via a private message), the video will not appear on the user's video list and will not be available by ID for other users, '0' — not to designate the video as private
     * @param bool|null $wallpost '1' — to post the saved video on a user's wall, '0' — not to post the saved video on a user's wall
     * @param string|null $link URL for embedding the video from an external website.
     * @param int|null $groupId ID of the community in which the video will be saved. By default, the current user's page.
     * @param int|null $albumId ID of the album to which the saved video will be added.
     * @param array|null $privacyView
     * @param array|null $privacyComment
     * @param bool|null $noComments
     * @param bool|null $repeat '1' — to repeat the playback of the video, '0' — to play the video once,
     * @param bool|null $compression
     * @param array|null $custom
     * @return Promise
     */
    function save(?string $name = '', ?string $description = '', ?bool $isPrivate = false, ?bool $wallpost = false, ?string $link = '', ?int $groupId = 0, ?int $albumId = 0, ?array $privacyView = [], ?array $privacyComment = [], ?bool $noComments = false, ?bool $repeat = false, ?bool $compression = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($name !== '' && $name != null) $sendParams['name'] = $name;
        if ($description !== '' && $description != null) $sendParams['description'] = $description;
        if ($isPrivate !== false && $isPrivate != null) $sendParams['is_private'] = intval($isPrivate);
        if ($wallpost !== false && $wallpost != null) $sendParams['wallpost'] = intval($wallpost);
        if ($link !== '' && $link != null) $sendParams['link'] = $link;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($privacyView !== [] && $privacyView != null) $sendParams['privacy_view'] = implode(',', $privacyView);
        if ($privacyComment !== [] && $privacyComment != null) $sendParams['privacy_comment'] = implode(',', $privacyComment);
        if ($noComments !== false && $noComments != null) $sendParams['no_comments'] = intval($noComments);
        if ($repeat !== false && $repeat != null) $sendParams['repeat'] = intval($repeat);
        if ($compression !== false && $compression != null) $sendParams['compression'] = intval($compression);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.save', $sendParams);
    }

    /**
     * Returns a list of videos under the set search criterion.
     * 
     * @param string $q Search query string (e.g., 'The Beatles').
     * @param int|null $sort Sort order: '1' — by duration, '2' — by relevance, '0' — by date added
     * @param int|null $hd If not null, only searches for high-definition videos.
     * @param bool|null $adult '1' — to disable the Safe Search filter, '0' — to enable the Safe Search filter
     * @param array|null $filters Filters to apply: 'youtube' — return YouTube videos only, 'vimeo' — return Vimeo videos only, 'short' — return short videos only, 'long' — return long videos only
     * @param bool|null $searchOwn
     * @param int|null $offset Offset needed to return a specific subset of videos.
     * @param int|null $longer
     * @param int|null $shorter
     * @param int|null $count Number of videos to return.
     * @param bool|null $extended
     * @param array|null $custom
     * @return Promise
     */
    function search(string $q, ?int $sort = 0, ?int $hd = 0, ?bool $adult = false, ?array $filters = [], ?bool $searchOwn = false, ?int $offset = 0, ?int $longer = 0, ?int $shorter = 0, ?int $count = 20, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams[''] = $q;
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($hd !== 0 && $hd != null) $sendParams['hd'] = $hd;
        if ($adult !== false && $adult != null) $sendParams['adult'] = intval($adult);
        if ($filters !== [] && $filters != null) $sendParams['filters'] = implode(',', $filters);
        if ($searchOwn !== false && $searchOwn != null) $sendParams['search_own'] = intval($searchOwn);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($longer !== 0 && $longer != null) $sendParams['longer'] = $longer;
        if ($shorter !== 0 && $shorter != null) $sendParams['shorter'] = $shorter;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('video.search', $sendParams);
    }
}