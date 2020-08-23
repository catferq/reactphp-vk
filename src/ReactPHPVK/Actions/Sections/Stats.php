<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Stats
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns statistics of a community or an application.
     * 
     * @param int|null $groupId Community ID.
     * @param int|null $appId Application ID.
     * @param int|null $timestampFrom
     * @param int|null $timestampTo
     * @param string|null $interval
     * @param int|null $intervalsCount
     * @param array|null $filters
     * @param array|null $statsGroups
     * @param bool|null $extended
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $groupId = 0, ?int $appId = 0, ?int $timestampFrom = 0, ?int $timestampTo = 0, ?string $interval = 'day', ?int $intervalsCount = 0, ?array $filters = [], ?array $statsGroups = [], ?bool $extended = true, ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($appId !== 0 && $appId != null) $sendParams['app_id'] = $appId;
        if ($timestampFrom !== 0 && $timestampFrom != null) $sendParams['timestamp_from'] = $timestampFrom;
        if ($timestampTo !== 0 && $timestampTo != null) $sendParams['timestamp_to'] = $timestampTo;
        if ($interval !== 'day' && $interval != null) $sendParams['interval'] = $interval;
        if ($intervalsCount !== 0 && $intervalsCount != null) $sendParams['intervals_count'] = $intervalsCount;
        if ($filters !== [] && $filters != null) $sendParams['filters'] = implode(',', $filters);
        if ($statsGroups !== [] && $statsGroups != null) $sendParams['stats_groups'] = implode(',', $statsGroups);
        if ($extended !== true && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stats.get', $sendParams);
    }

    /**
     * Returns stats for a wall post.
     * 
     * @param string $ownerId post owner community id. Specify with "-" sign.
     * @param array $postIds wall posts id
     * @param array|null $custom
     * @return Promise
     */
    function getPostReach(string $ownerId, array $postIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['post_ids'] = implode(',', $postIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stats.getPostReach', $sendParams);
    }

    /**
     * stats.trackVisitor
     * 
     * @param string $id
     * @param array|null $custom
     * @return Promise
     */
    function trackVisitor(string $id, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['id'] = $id;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stats.trackVisitor', $sendParams);
    }
}