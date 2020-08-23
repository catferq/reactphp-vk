<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Status
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns data required to show the status of a user or community.
     * 
     * @param int|null $userId User ID or community ID. Use a negative value to designate a community ID.
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $userId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('status.get', $sendParams);
    }

    /**
     * Sets a new status for the current user.
     * 
     * @param string|null $text Text of the new status.
     * @param int|null $groupId Identifier of a community to set a status in. If left blank the status is set to current user.
     * @param array|null $custom
     * @return Promise
     */
    function set(?string $text = '', ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($text !== '' && $text != null) $sendParams['text'] = $text;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('status.set', $sendParams);
    }
}