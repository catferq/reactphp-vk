<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Newsfeed
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Prevents news from specified users and communities from appearing in the current user's newsfeed.
     * 
     * @param array|null $userIds
     * @param array|null $groupIds
     * @param array|null $custom
     * @return Promise
     */
    function addBan(?array $userIds = [], ?array $groupIds = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($groupIds !== [] && $groupIds != null) $sendParams['group_ids'] = implode(',', $groupIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.addBan', $sendParams);
    }

    /**
     * Allows news from previously banned users and communities to be shown in the current user's newsfeed.
     * 
     * @param array|null $userIds
     * @param array|null $groupIds
     * @param array|null $custom
     * @return Promise
     */
    function deleteBan(?array $userIds = [], ?array $groupIds = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($groupIds !== [] && $groupIds != null) $sendParams['group_ids'] = implode(',', $groupIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.deleteBan', $sendParams);
    }

    /**
     * newsfeed.deleteList
     * 
     * @param int $listId
     * @param array|null $custom
     * @return Promise
     */
    function deleteList(int $listId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['list_id'] = $listId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.deleteList', $sendParams);
    }

    /**
     * Returns data required to show newsfeed for the current user.
     * 
     * @param array|null $filters Filters to apply: 'post' — new wall posts, 'photo' — new photos, 'photo_tag' — new photo tags, 'wall_photo' — new wall photos, 'friend' — new friends, 'note' — new notes
     * @param bool|null $returnBanned '1' — to return news items from banned sources
     * @param int|null $startTime Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * @param int|null $endTime Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * @param int|null $maxPhotos Maximum number of photos to return. By default, '5'.
     * @param string|null $sourceIds Sources to obtain news from, separated by commas. User IDs can be specified in formats '' or 'u' , where '' is the user's friend ID. Community IDs can be specified in formats '-' or 'g' , where '' is the community ID. If the parameter is not set, all of the user's friends and communities are returned, except for banned sources, which can be obtained with the [vk.com/dev/newsfeed.getBanned|newsfeed.getBanned] method.
     * @param string|null $startFrom identifier required to get the next page of results. Value for this parameter is returned in 'next_from' field in a reply.
     * @param int|null $count Number of news items to return (default 50, maximum 100). For auto feed, you can use the 'new_offset' parameter returned by this method.
     * @param array|null $fields Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @param string|null $section
     * @param array|null $custom
     * @return Promise
     */
    function get(?array $filters = [], ?bool $returnBanned = false, ?int $startTime = 0, ?int $endTime = 0, ?int $maxPhotos = 0, ?string $sourceIds = '', ?string $startFrom = '', ?int $count = 0, ?array $fields = [], ?string $section = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($filters !== [] && $filters != null) $sendParams['filters'] = implode(',', $filters);
        if ($returnBanned !== false && $returnBanned != null) $sendParams['return_banned'] = intval($returnBanned);
        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;
        if ($maxPhotos !== 0 && $maxPhotos != null) $sendParams['max_photos'] = $maxPhotos;
        if ($sourceIds !== '' && $sourceIds != null) $sendParams['source_ids'] = $sourceIds;
        if ($startFrom !== '' && $startFrom != null) $sendParams['start_from'] = $startFrom;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($section !== '' && $section != null) $sendParams['section'] = $section;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.get', $sendParams);
    }

    /**
     * Returns a list of users and communities banned from the current user's newsfeed.
     * 
     * @param bool|null $extended '1' — return extra information about users and communities
     * @param array|null $fields Profile fields to return.
     * @param string|null $nameCase Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param array|null $custom
     * @return Promise
     */
    function getBanned(?bool $extended = false, ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.getBanned', $sendParams);
    }

    /**
     * Returns a list of comments in the current user's newsfeed.
     * 
     * @param int|null $count Number of comments to return. For auto feed, you can use the 'new_offset' parameter returned by this method.
     * @param array|null $filters Filters to apply: 'post' — new comments on wall posts, 'photo' — new comments on photos, 'video' — new comments on videos, 'topic' — new comments on discussions, 'note' — new comments on notes,
     * @param string|null $reposts Object ID, comments on repost of which shall be returned, e.g. 'wall1_45486'. (If the parameter is set, the 'filters' parameter is optional.),
     * @param int|null $startTime Earliest timestamp (in Unix time) of a comment to return. By default, 24 hours ago.
     * @param int|null $endTime Latest timestamp (in Unix time) of a comment to return. By default, the current time.
     * @param int|null $lastCommentsCount
     * @param string|null $startFrom Identificator needed to return the next page with results. Value for this parameter returns in 'next_from' field.
     * @param array|null $fields Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @param array|null $custom
     * @return Promise
     */
    function getComments(?int $count = 30, ?array $filters = [], ?string $reposts = '', ?int $startTime = 0, ?int $endTime = 0, ?int $lastCommentsCount = 0, ?string $startFrom = '', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($count !== 30 && $count != null) $sendParams['count'] = $count;
        if ($filters !== [] && $filters != null) $sendParams['filters'] = implode(',', $filters);
        if ($reposts !== '' && $reposts != null) $sendParams['reposts'] = $reposts;
        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;
        if ($lastCommentsCount !== 0 && $lastCommentsCount != null) $sendParams['last_comments_count'] = $lastCommentsCount;
        if ($startFrom !== '' && $startFrom != null) $sendParams['start_from'] = $startFrom;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.getComments', $sendParams);
    }

    /**
     * Returns a list of newsfeeds followed by the current user.
     * 
     * @param array|null $listIds numeric list identifiers.
     * @param bool|null $extended Return additional list info
     * @param array|null $custom
     * @return Promise
     */
    function getLists(?array $listIds = [], ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($listIds !== [] && $listIds != null) $sendParams['list_ids'] = implode(',', $listIds);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.getLists', $sendParams);
    }

    /**
     * Returns a list of posts on user walls in which the current user is mentioned.
     * 
     * @param int|null $ownerId Owner ID.
     * @param int|null $startTime Earliest timestamp (in Unix time) of a post to return. By default, 24 hours ago.
     * @param int|null $endTime Latest timestamp (in Unix time) of a post to return. By default, the current time.
     * @param int|null $offset Offset needed to return a specific subset of posts.
     * @param int|null $count Number of posts to return.
     * @param array|null $custom
     * @return Promise
     */
    function getMentions(?int $ownerId = 0, ?int $startTime = 0, ?int $endTime = 0, ?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.getMentions', $sendParams);
    }

    /**
     * , Returns a list of newsfeeds recommended to the current user.
     * 
     * @param int|null $startTime Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * @param int|null $endTime Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * @param int|null $maxPhotos Maximum number of photos to return. By default, '5'.
     * @param string|null $startFrom 'new_from' value obtained in previous call.
     * @param int|null $count Number of news items to return.
     * @param array|null $fields Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @param array|null $custom
     * @return Promise
     */
    function getRecommended(?int $startTime = 0, ?int $endTime = 0, ?int $maxPhotos = 0, ?string $startFrom = '', ?int $count = 0, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;
        if ($maxPhotos !== 0 && $maxPhotos != null) $sendParams['max_photos'] = $maxPhotos;
        if ($startFrom !== '' && $startFrom != null) $sendParams['start_from'] = $startFrom;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.getRecommended', $sendParams);
    }

    /**
     * Returns communities and users that current user is suggested to follow.
     * 
     * @param int|null $offset offset required to choose a particular subset of communities or users.
     * @param int|null $count amount of communities or users to return.
     * @param bool|null $shuffle shuffle the returned list or not.
     * @param array|null $fields list of extra fields to be returned. See available fields for [vk.com/dev/fields|users] and [vk.com/dev/fields_groups|communities].
     * @param array|null $custom
     * @return Promise
     */
    function getSuggestedSources(?int $offset = 0, ?int $count = 20, ?bool $shuffle = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($shuffle !== false && $shuffle != null) $sendParams['shuffle'] = intval($shuffle);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.getSuggestedSources', $sendParams);
    }

    /**
     * Hides an item from the newsfeed.
     * 
     * @param string $type Item type. Possible values: *'wall' – post on the wall,, *'tag' – tag on a photo,, *'profilephoto' – profile photo,, *'video' – video,, *'audio' – audio.
     * @param int $ownerId Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' – user , 'owner_id=-1' – community "
     * @param int $itemId Item identifier
     * @param array|null $custom
     * @return Promise
     */
    function ignoreItem(string $type, int $ownerId, int $itemId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.ignoreItem', $sendParams);
    }

    /**
     * Creates and edits user newsfeed lists
     * 
     * @param string $title list name.
     * @param int|null $listId numeric list identifier (if not sent, will be set automatically).
     * @param array|null $sourceIds users and communities identifiers to be added to the list. Community identifiers must be negative numbers.
     * @param bool|null $noReposts reposts display on and off ('1' is for off).
     * @param array|null $custom
     * @return Promise
     */
    function saveList(string $title, ?int $listId = 0, ?array $sourceIds = [], ?bool $noReposts = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['title'] = $title;
        if ($listId !== 0 && $listId != null) $sendParams['list_id'] = $listId;
        if ($sourceIds !== [] && $sourceIds != null) $sendParams['source_ids'] = implode(',', $sourceIds);
        if ($noReposts !== false && $noReposts != null) $sendParams['no_reposts'] = intval($noReposts);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.saveList', $sendParams);
    }

    /**
     * Returns search results by statuses.
     * 
     * @param string|null $q Search query string (e.g., 'New Year').
     * @param bool|null $extended '1' — to return additional information about the user or community that placed the post.
     * @param int|null $count Number of posts to return.
     * @param float|null $latitude Geographical latitude point (in degrees, -90 to 90) within which to search.
     * @param float|null $longitude Geographical longitude point (in degrees, -180 to 180) within which to search.
     * @param int|null $startTime Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * @param int|null $endTime Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * @param string|null $startFrom
     * @param array|null $fields Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @param array|null $custom
     * @return Promise
     */
    function search(?string $q = '', ?bool $extended = false, ?int $count = 30, ?float $latitude = 0, ?float $longitude = 0, ?int $startTime = 0, ?int $endTime = 0, ?string $startFrom = '', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($count !== 30 && $count != null) $sendParams['count'] = $count;
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;
        if ($startFrom !== '' && $startFrom != null) $sendParams['start_from'] = $startFrom;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.search', $sendParams);
    }

    /**
     * Returns a hidden item to the newsfeed.
     * 
     * @param string $type Item type. Possible values: *'wall' – post on the wall,, *'tag' – tag on a photo,, *'profilephoto' – profile photo,, *'video' – video,, *'audio' – audio.
     * @param int $ownerId Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' – user , 'owner_id=-1' – community "
     * @param int $itemId Item identifier
     * @param string|null $trackCode Track code of unignored item
     * @param array|null $custom
     * @return Promise
     */
    function unignoreItem(string $type, int $ownerId, int $itemId, ?string $trackCode = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        if ($trackCode !== '' && $trackCode != null) $sendParams['track_code'] = $trackCode;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.unignoreItem', $sendParams);
    }

    /**
     * Unsubscribes the current user from specified newsfeeds.
     * 
     * @param string $type Type of object from which to unsubscribe: 'note' — note, 'photo' — photo, 'post' — post on user wall or community wall, 'topic' — topic, 'video' — video
     * @param int $itemId Object ID.
     * @param int|null $ownerId Object owner ID.
     * @param array|null $custom
     * @return Promise
     */
    function unsubscribe(string $type, int $itemId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        $sendParams['item_id'] = $itemId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('newsfeed.unsubscribe', $sendParams);
    }
}