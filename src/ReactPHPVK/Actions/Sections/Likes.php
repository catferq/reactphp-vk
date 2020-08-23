<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Likes
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Adds the specified object to the 'Likes' list of the current user.
     * 
     * @param string $type Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion, 'sitepage' — page of the site where the [vk.com/dev/Like|Like widget] is installed
     * @param int $itemId Object ID.
     * @param int|null $ownerId ID of the user or community that owns the object.
     * @param string|null $accessKey Access key required for an object owned by a private entity.
     * @param array|null $custom
     * @return Promise
     */
    function add(string $type, int $itemId, ?int $ownerId = 0, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        $sendParams['item_id'] = $itemId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('likes.add', $sendParams);
    }

    /**
     * Deletes the specified object from the 'Likes' list of the current user.
     * 
     * @param string $type Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion, 'sitepage' — page of the site where the [vk.com/dev/Like|Like widget] is installed
     * @param int $itemId Object ID.
     * @param int|null $ownerId ID of the user or community that owns the object.
     * @param string|null $accessKey Access key required for an object owned by a private entity.
     * @param array|null $custom
     * @return Promise
     */
    function delete(string $type, int $itemId, ?int $ownerId = 0, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        $sendParams['item_id'] = $itemId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('likes.delete', $sendParams);
    }

    /**
     * Returns a list of IDs of users who added the specified object to their 'Likes' list.
     * 
     * @param string $type , Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion, 'sitepage' — page of the site where the [vk.com/dev/Like|Like widget] is installed
     * @param int|null $ownerId ID of the user, community, or application that owns the object. If the 'type' parameter is set as 'sitepage', the application ID is passed as 'owner_id'. Use negative value for a community id. If the 'type' parameter is not set, the 'owner_id' is assumed to be either the current user or the same application ID as if the 'type' parameter was set to 'sitepage'.
     * @param int|null $itemId Object ID. If 'type' is set as 'sitepage', 'item_id' can include the 'page_id' parameter value used during initialization of the [vk.com/dev/Like|Like widget].
     * @param string|null $pageUrl URL of the page where the [vk.com/dev/Like|Like widget] is installed. Used instead of the 'item_id' parameter.
     * @param string|null $filter Filters to apply: 'likes' — returns information about all users who liked the object (default), 'copies' — returns information only about users who told their friends about the object
     * @param int|null $friendsOnly Specifies which users are returned: '1' — to return only the current user's friends, '0' — to return all users (default)
     * @param bool|null $extended Specifies whether extended information will be returned. '1' — to return extended information about users and communities from the 'Likes' list, '0' — to return no additional information (default)
     * @param int|null $offset Offset needed to select a specific subset of users.
     * @param int|null $count Number of user IDs to return (maximum '1000'). Default is '100' if 'friends_only' is set to '0', otherwise, the default is '10' if 'friends_only' is set to '1'.
     * @param bool|null $skipOwn
     * @param array|null $custom
     * @return Promise
     */
    function getList(string $type, ?int $ownerId = 0, ?int $itemId = 0, ?string $pageUrl = '', ?string $filter = '', ?int $friendsOnly = 0, ?bool $extended = false, ?int $offset = 0, ?int $count = 0, ?bool $skipOwn = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($itemId !== 0 && $itemId != null) $sendParams['item_id'] = $itemId;
        if ($pageUrl !== '' && $pageUrl != null) $sendParams['page_url'] = $pageUrl;
        if ($filter !== '' && $filter != null) $sendParams['filter'] = $filter;
        if ($friendsOnly !== 0 && $friendsOnly != null) $sendParams['friends_only'] = $friendsOnly;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($skipOwn !== false && $skipOwn != null) $sendParams['skip_own'] = intval($skipOwn);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('likes.getList', $sendParams);
    }

    /**
     * Checks for the object in the 'Likes' list of the specified user.
     * 
     * @param string $type Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion
     * @param int $itemId Object ID.
     * @param int|null $userId User ID.
     * @param int|null $ownerId ID of the user or community that owns the object.
     * @param array|null $custom
     * @return Promise
     */
    function isLiked(string $type, int $itemId, ?int $userId = 0, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        $sendParams['item_id'] = $itemId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('likes.isLiked', $sendParams);
    }
}