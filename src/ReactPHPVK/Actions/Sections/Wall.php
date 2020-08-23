<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Wall
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * wall.closeComments
     * 
     * @param int $ownerId
     * @param int $postId
     * @param array|null $custom
     * @return Promise
     */
    function closeComments(int $ownerId, int $postId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['post_id'] = $postId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.closeComments', $sendParams);
    }

    /**
     * Adds a comment to a post on a user wall or community wall.
     * 
     * @param int $postId Post ID.
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param int|null $fromGroup Group ID.
     * @param string|null $message (Required if 'attachments' is not set.) Text of the comment.
     * @param int|null $replyToComment ID of comment to reply.
     * @param array|null $attachments (Required if 'message' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media ojbect: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. For example: "photo100172_166443618,photo66748_265827614"
     * @param int|null $stickerId Sticker ID.
     * @param string|null $guid Unique identifier to avoid repeated comments.
     * @param array|null $custom
     * @return Promise
     */
    function createComment(int $postId, ?int $ownerId = 0, ?int $fromGroup = 0, ?string $message = '', ?int $replyToComment = 0, ?array $attachments = [], ?int $stickerId = 0, ?string $guid = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['post_id'] = $postId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($fromGroup !== 0 && $fromGroup != null) $sendParams['from_group'] = $fromGroup;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($replyToComment !== 0 && $replyToComment != null) $sendParams['reply_to_comment'] = $replyToComment;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($stickerId !== 0 && $stickerId != null) $sendParams['sticker_id'] = $stickerId;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.createComment', $sendParams);
    }

    /**
     * Deletes a post from a user wall or community wall.
     * 
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param int|null $postId ID of the post to be deleted.
     * @param array|null $custom
     * @return Promise
     */
    function delete(?int $ownerId = 0, ?int $postId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($postId !== 0 && $postId != null) $sendParams['post_id'] = $postId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.delete', $sendParams);
    }

    /**
     * Deletes a comment on a post on a user wall or community wall.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function deleteComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.deleteComment', $sendParams);
    }

    /**
     * Edits a post on a user wall or community wall.
     * 
     * @param int $postId
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param bool|null $friendsOnly
     * @param string|null $message (Required if 'attachments' is not set.) Text of the post.
     * @param array|null $attachments (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error is thrown."
     * @param string|null $services
     * @param bool|null $signed
     * @param int|null $publishDate
     * @param float|null $lat
     * @param float|null $long
     * @param int|null $placeId
     * @param bool|null $markAsAds
     * @param bool|null $closeComments
     * @param int|null $posterBkgId
     * @param int|null $posterBkgOwnerId
     * @param string|null $posterBkgAccessHash
     * @param string|null $copyright
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $postId, ?int $ownerId = 0, ?bool $friendsOnly = false, ?string $message = '', ?array $attachments = [], ?string $services = '', ?bool $signed = false, ?int $publishDate = 0, ?float $lat = 0, ?float $long = 0, ?int $placeId = 0, ?bool $markAsAds = false, ?bool $closeComments = false, ?int $posterBkgId = 0, ?int $posterBkgOwnerId = 0, ?string $posterBkgAccessHash = '', ?string $copyright = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['post_id'] = $postId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($friendsOnly !== false && $friendsOnly != null) $sendParams['friends_only'] = intval($friendsOnly);
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($services !== '' && $services != null) $sendParams['services'] = $services;
        if ($signed !== false && $signed != null) $sendParams['signed'] = intval($signed);
        if ($publishDate !== 0 && $publishDate != null) $sendParams['publish_date'] = $publishDate;
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($placeId !== 0 && $placeId != null) $sendParams['place_id'] = $placeId;
        if ($markAsAds !== false && $markAsAds != null) $sendParams['mark_as_ads'] = intval($markAsAds);
        if ($closeComments !== false && $closeComments != null) $sendParams['close_comments'] = intval($closeComments);
        if ($posterBkgId !== 0 && $posterBkgId != null) $sendParams['poster_bkg_id'] = $posterBkgId;
        if ($posterBkgOwnerId !== 0 && $posterBkgOwnerId != null) $sendParams['poster_bkg_owner_id'] = $posterBkgOwnerId;
        if ($posterBkgAccessHash !== '' && $posterBkgAccessHash != null) $sendParams['poster_bkg_access_hash'] = $posterBkgAccessHash;
        if ($copyright !== '' && $copyright != null) $sendParams['copyright'] = $copyright;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.edit', $sendParams);
    }

    /**
     * Allows to edit hidden post.
     * 
     * @param int $postId Post ID. Used for publishing of scheduled and suggested posts.
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param string|null $message (Required if 'attachments' is not set.) Text of the post.
     * @param array|null $attachments (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * @param bool|null $signed Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * @param float|null $lat Geographical latitude of a check-in, in degrees (from -90 to 90).
     * @param float|null $long Geographical longitude of a check-in, in degrees (from -180 to 180).
     * @param int|null $placeId ID of the location where the user was tagged.
     * @param string|null $linkButton Link button ID
     * @param string|null $linkTitle Link title
     * @param string|null $linkImage Link image url
     * @param string|null $linkVideo Link video ID in format "<owner_id>_<media_id>"
     * @param array|null $custom
     * @return Promise
     */
    function editAdsStealth(int $postId, ?int $ownerId = 0, ?string $message = '', ?array $attachments = [], ?bool $signed = false, ?float $lat = 0, ?float $long = 0, ?int $placeId = 0, ?string $linkButton = '', ?string $linkTitle = '', ?string $linkImage = '', ?string $linkVideo = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['post_id'] = $postId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($signed !== false && $signed != null) $sendParams['signed'] = intval($signed);
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($placeId !== 0 && $placeId != null) $sendParams['place_id'] = $placeId;
        if ($linkButton !== '' && $linkButton != null) $sendParams['link_button'] = $linkButton;
        if ($linkTitle !== '' && $linkTitle != null) $sendParams['link_title'] = $linkTitle;
        if ($linkImage !== '' && $linkImage != null) $sendParams['link_image'] = $linkImage;
        if ($linkVideo !== '' && $linkVideo != null) $sendParams['link_video'] = $linkVideo;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.editAdsStealth', $sendParams);
    }

    /**
     * Edits a comment on a user wall or community wall.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param string|null $message New comment text.
     * @param array|null $attachments List of objects attached to the comment, in the following format: , "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. For example: "photo100172_166443618,photo66748_265827614"
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

        return $this->provider->request('wall.editComment', $sendParams);
    }

    /**
     * Returns a list of posts on a user wall or community wall.
     * 
     * @param int|null $ownerId ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
     * @param string|null $domain User or community short address.
     * @param int|null $offset Offset needed to return a specific subset of posts.
     * @param int|null $count Number of posts to return (maximum 100).
     * @param string|null $filter Filter to apply: 'owner' — posts by the wall owner, 'others' — posts by someone else, 'all' — posts by the wall owner and others (default), 'postponed' — timed posts (only available for calls with an 'access_token'), 'suggests' — suggested posts on a community wall
     * @param bool|null $extended '1' — to return 'wall', 'profiles', and 'groups' fields, '0' — to return no additional fields (default)
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $ownerId = 0, ?string $domain = '', ?int $offset = 0, ?int $count = 0, ?string $filter = '', ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($domain !== '' && $domain != null) $sendParams['domain'] = $domain;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($filter !== '' && $filter != null) $sendParams['filter'] = $filter;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.get', $sendParams);
    }

    /**
     * Returns a list of posts from user or community walls by their IDs.
     * 
     * @param array $posts User or community IDs and post IDs, separated by underscores. Use a negative value to designate a community ID. Example: "93388_21539,93388_20904,2943_4276,-1_1"
     * @param bool|null $extended '1' — to return user and community objects needed to display posts, '0' — no additional fields are returned (default)
     * @param int|null $copyHistoryDepth Sets the number of parent elements to include in the array 'copy_history' that is returned if the post is a repost from another wall.
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getById(array $posts, ?bool $extended = false, ?int $copyHistoryDepth = 2, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['posts'] = implode(',', $posts);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($copyHistoryDepth !== 2 && $copyHistoryDepth != null) $sendParams['copy_history_depth'] = $copyHistoryDepth;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.getById', $sendParams);
    }

    /**
     * Returns a comment on a post on a user wall or community wall.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param bool|null $extended
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getComment(int $commentId, ?int $ownerId = 0, ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.getComment', $sendParams);
    }

    /**
     * Returns a list of comments on a post on a user wall or community wall.
     * 
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param int|null $postId Post ID.
     * @param bool|null $needLikes '1' — to return the 'likes' field, '0' — not to return the 'likes' field (default)
     * @param int|null $startCommentId
     * @param int|null $offset Offset needed to return a specific subset of comments.
     * @param int|null $count Number of comments to return (maximum 100).
     * @param string|null $sort Sort order: 'asc' — chronological, 'desc' — reverse chronological
     * @param int|null $previewLength Number of characters at which to truncate comments when previewed. By default, '90'. Specify '0' if you do not want to truncate comments.
     * @param bool|null $extended
     * @param array|null $fields
     * @param int|null $commentId Comment ID.
     * @param int|null $threadItemsCount Count items in threads.
     * @param array|null $custom
     * @return Promise
     */
    function getComments(?int $ownerId = 0, ?int $postId = 0, ?bool $needLikes = false, ?int $startCommentId = 0, ?int $offset = 0, ?int $count = 0, ?string $sort = '', ?int $previewLength = 0, ?bool $extended = false, ?array $fields = [], ?int $commentId = 0, ?int $threadItemsCount = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($postId !== 0 && $postId != null) $sendParams['post_id'] = $postId;
        if ($needLikes !== false && $needLikes != null) $sendParams['need_likes'] = intval($needLikes);
        if ($startCommentId !== 0 && $startCommentId != null) $sendParams['start_comment_id'] = $startCommentId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($sort !== '' && $sort != null) $sendParams['sort'] = $sort;
        if ($previewLength !== 0 && $previewLength != null) $sendParams['preview_length'] = $previewLength;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($commentId !== 0 && $commentId != null) $sendParams['comment_id'] = $commentId;
        if ($threadItemsCount !== 0 && $threadItemsCount != null) $sendParams['thread_items_count'] = $threadItemsCount;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.getComments', $sendParams);
    }

    /**
     * Returns information about reposts of a post on user wall or community wall.
     * 
     * @param int|null $ownerId User ID or community ID. By default, current user ID. Use a negative value to designate a community ID.
     * @param int|null $postId Post ID.
     * @param int|null $offset Offset needed to return a specific subset of reposts.
     * @param int|null $count Number of reposts to return.
     * @param array|null $custom
     * @return Promise
     */
    function getReposts(?int $ownerId = 0, ?int $postId = 0, ?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($postId !== 0 && $postId != null) $sendParams['post_id'] = $postId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.getReposts', $sendParams);
    }

    /**
     * wall.openComments
     * 
     * @param int $ownerId
     * @param int $postId
     * @param array|null $custom
     * @return Promise
     */
    function openComments(int $ownerId, int $postId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['post_id'] = $postId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.openComments', $sendParams);
    }

    /**
     * Pins the post on wall.
     * 
     * @param int $postId Post ID.
     * @param int|null $ownerId ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function pin(int $postId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['post_id'] = $postId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.pin', $sendParams);
    }

    /**
     * Adds a new post on a user wall or community wall. Can also be used to publish suggested or scheduled posts.
     * 
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param bool|null $friendsOnly '1' — post will be available to friends only, '0' — post will be available to all users (default)
     * @param bool|null $fromGroup For a community: '1' — post will be published by the community, '0' — post will be published by the user (default)
     * @param string|null $message (Required if 'attachments' is not set.) Text of the post.
     * @param array|null $attachments (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * @param string|null $services List of services or websites the update will be exported to, if the user has so requested. Sample values: 'twitter', 'facebook'.
     * @param bool|null $signed Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * @param int|null $publishDate Publication date (in Unix time). If used, posting will be delayed until the set time.
     * @param float|null $lat Geographical latitude of a check-in, in degrees (from -90 to 90).
     * @param float|null $long Geographical longitude of a check-in, in degrees (from -180 to 180).
     * @param int|null $placeId ID of the location where the user was tagged.
     * @param int|null $postId Post ID. Used for publishing of scheduled and suggested posts.
     * @param string|null $guid
     * @param bool|null $markAsAds
     * @param bool|null $closeComments
     * @param bool|null $muteNotifications
     * @param string|null $copyright
     * @param array|null $custom
     * @return Promise
     */
    function post(?int $ownerId = 0, ?bool $friendsOnly = false, ?bool $fromGroup = false, ?string $message = '', ?array $attachments = [], ?string $services = '', ?bool $signed = false, ?int $publishDate = 0, ?float $lat = 0, ?float $long = 0, ?int $placeId = 0, ?int $postId = 0, ?string $guid = '', ?bool $markAsAds = false, ?bool $closeComments = false, ?bool $muteNotifications = false, ?string $copyright = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($friendsOnly !== false && $friendsOnly != null) $sendParams['friends_only'] = intval($friendsOnly);
        if ($fromGroup !== false && $fromGroup != null) $sendParams['from_group'] = intval($fromGroup);
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($services !== '' && $services != null) $sendParams['services'] = $services;
        if ($signed !== false && $signed != null) $sendParams['signed'] = intval($signed);
        if ($publishDate !== 0 && $publishDate != null) $sendParams['publish_date'] = $publishDate;
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($placeId !== 0 && $placeId != null) $sendParams['place_id'] = $placeId;
        if ($postId !== 0 && $postId != null) $sendParams['post_id'] = $postId;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;
        if ($markAsAds !== false && $markAsAds != null) $sendParams['mark_as_ads'] = intval($markAsAds);
        if ($closeComments !== false && $closeComments != null) $sendParams['close_comments'] = intval($closeComments);
        if ($muteNotifications !== false && $muteNotifications != null) $sendParams['mute_notifications'] = intval($muteNotifications);
        if ($copyright !== '' && $copyright != null) $sendParams['copyright'] = $copyright;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.post', $sendParams);
    }

    /**
     * Allows to create hidden post which will not be shown on the community's wall and can be used for creating an ad with type "Community post".
     * 
     * @param int $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param string|null $message (Required if 'attachments' is not set.) Text of the post.
     * @param array|null $attachments (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * @param bool|null $signed Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * @param float|null $lat Geographical latitude of a check-in, in degrees (from -90 to 90).
     * @param float|null $long Geographical longitude of a check-in, in degrees (from -180 to 180).
     * @param int|null $placeId ID of the location where the user was tagged.
     * @param string|null $guid Unique identifier to avoid duplication the same post.
     * @param string|null $linkButton Link button ID
     * @param string|null $linkTitle Link title
     * @param string|null $linkImage Link image url
     * @param string|null $linkVideo Link video ID in format "<owner_id>_<media_id>"
     * @param array|null $custom
     * @return Promise
     */
    function postAdsStealth(int $ownerId, ?string $message = '', ?array $attachments = [], ?bool $signed = false, ?float $lat = 0, ?float $long = 0, ?int $placeId = 0, ?string $guid = '', ?string $linkButton = '', ?string $linkTitle = '', ?string $linkImage = '', ?string $linkVideo = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($signed !== false && $signed != null) $sendParams['signed'] = intval($signed);
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($placeId !== 0 && $placeId != null) $sendParams['place_id'] = $placeId;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;
        if ($linkButton !== '' && $linkButton != null) $sendParams['link_button'] = $linkButton;
        if ($linkTitle !== '' && $linkTitle != null) $sendParams['link_title'] = $linkTitle;
        if ($linkImage !== '' && $linkImage != null) $sendParams['link_image'] = $linkImage;
        if ($linkVideo !== '' && $linkVideo != null) $sendParams['link_video'] = $linkVideo;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.postAdsStealth', $sendParams);
    }

    /**
     * Reports (submits a complaint about) a comment on a post on a user wall or community wall.
     * 
     * @param int $ownerId ID of the user or community that owns the wall.
     * @param int $commentId Comment ID.
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

        return $this->provider->request('wall.reportComment', $sendParams);
    }

    /**
     * Reports (submits a complaint about) a post on a user wall or community wall.
     * 
     * @param int $ownerId ID of the user or community that owns the wall.
     * @param int $postId Post ID.
     * @param int|null $reason Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     * @param array|null $custom
     * @return Promise
     */
    function reportPost(int $ownerId, int $postId, ?int $reason = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['post_id'] = $postId;
        if ($reason !== 0 && $reason != null) $sendParams['reason'] = $reason;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.reportPost', $sendParams);
    }

    /**
     * Reposts (copies) an object to a user wall or community wall.
     * 
     * @param string $object ID of the object to be reposted on the wall. Example: "wall66748_3675"
     * @param string|null $message Comment to be added along with the reposted object.
     * @param int|null $groupId Target community ID when reposting to a community.
     * @param bool|null $markAsAds
     * @param bool|null $muteNotifications
     * @param array|null $custom
     * @return Promise
     */
    function repost(string $object, ?string $message = '', ?int $groupId = 0, ?bool $markAsAds = false, ?bool $muteNotifications = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['object'] = $object;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($markAsAds !== false && $markAsAds != null) $sendParams['mark_as_ads'] = intval($markAsAds);
        if ($muteNotifications !== false && $muteNotifications != null) $sendParams['mute_notifications'] = intval($muteNotifications);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.repost', $sendParams);
    }

    /**
     * Restores a post deleted from a user wall or community wall.
     * 
     * @param int|null $ownerId User ID or community ID from whose wall the post was deleted. Use a negative value to designate a community ID.
     * @param int|null $postId ID of the post to be restored.
     * @param array|null $custom
     * @return Promise
     */
    function restore(?int $ownerId = 0, ?int $postId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($postId !== 0 && $postId != null) $sendParams['post_id'] = $postId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.restore', $sendParams);
    }

    /**
     * Restores a comment deleted from a user wall or community wall.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function restoreComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.restoreComment', $sendParams);
    }

    /**
     * Allows to search posts on user or community walls.
     * 
     * @param int|null $ownerId user or community id. "Remember that for a community 'owner_id' must be negative."
     * @param string|null $domain user or community screen name.
     * @param string|null $query search query string.
     * @param bool|null $ownersOnly '1' – returns only page owner's posts.
     * @param int|null $count count of posts to return.
     * @param int|null $offset Offset needed to return a specific subset of posts.
     * @param bool|null $extended show extended post info.
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function search(?int $ownerId = 0, ?string $domain = '', ?string $query = '', ?bool $ownersOnly = false, ?int $count = 20, ?int $offset = 0, ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($domain !== '' && $domain != null) $sendParams['domain'] = $domain;
        if ($query !== '' && $query != null) $sendParams['query'] = $query;
        if ($ownersOnly !== false && $ownersOnly != null) $sendParams['owners_only'] = intval($ownersOnly);
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.search', $sendParams);
    }

    /**
     * Unpins the post on wall.
     * 
     * @param int $postId Post ID.
     * @param int|null $ownerId ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function unpin(int $postId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['post_id'] = $postId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('wall.unpin', $sendParams);
    }
}