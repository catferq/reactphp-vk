<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Gifts
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns a list of user gifts.
     * 
     * @param int|null $userId User ID.
     * @param int|null $count Number of gifts to return.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $userId = 0, ?int $count = 0, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('gifts.get', $sendParams);
    }
}