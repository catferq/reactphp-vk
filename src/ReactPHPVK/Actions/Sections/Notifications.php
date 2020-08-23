<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Notifications
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns a list of notifications about other users' feedback to the current user's wall posts.
     * 
     * @param int|null $count Number of notifications to return.
     * @param string|null $startFrom
     * @param array|null $filters Type of notifications to return: 'wall' — wall posts, 'mentions' — mentions in wall posts, comments, or topics, 'comments' — comments to wall posts, photos, and videos, 'likes' — likes, 'reposted' — wall posts that are copied from the current user's wall, 'followers' — new followers, 'friends' — accepted friend requests
     * @param int|null $startTime Earliest timestamp (in Unix time) of a notification to return. By default, 24 hours ago.
     * @param int|null $endTime Latest timestamp (in Unix time) of a notification to return. By default, the current time.
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $count = 30, ?string $startFrom = '', ?array $filters = [], ?int $startTime = 0, ?int $endTime = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($count !== 30 && $count != null) $sendParams['count'] = $count;
        if ($startFrom !== '' && $startFrom != null) $sendParams['start_from'] = $startFrom;
        if ($filters !== [] && $filters != null) $sendParams['filters'] = implode(',', $filters);
        if ($startTime !== 0 && $startTime != null) $sendParams['start_time'] = $startTime;
        if ($endTime !== 0 && $endTime != null) $sendParams['end_time'] = $endTime;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notifications.get', $sendParams);
    }

    /**
     * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function markAsViewed(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notifications.markAsViewed', $sendParams);
    }

    /**
     * notifications.sendMessage
     * 
     * @param array $userIds
     * @param string $message
     * @param string|null $fragment
     * @param int|null $groupId
     * @param int|null $randomId
     * @param array|null $custom
     * @return Promise
     */
    function sendMessage(array $userIds, string $message, ?string $fragment = '', ?int $groupId = 0, ?int $randomId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_ids'] = implode(',', $userIds);
        $sendParams['message'] = $message;
        if ($fragment !== '' && $fragment != null) $sendParams['fragment'] = $fragment;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($randomId !== 0 && $randomId != null) $sendParams['random_id'] = $randomId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notifications.sendMessage', $sendParams);
    }
}