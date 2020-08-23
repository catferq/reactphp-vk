<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Storage
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns a value of variable with the name set by key parameter.
     * 
     * @param string|null $key
     * @param array|null $keys
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function get(?string $key = '', ?array $keys = [], ?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($key !== '' && $key != null) $sendParams['key'] = $key;
        if ($keys !== [] && $keys != null) $sendParams['keys'] = implode(',', $keys);
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('storage.get', $sendParams);
    }

    /**
     * Returns the names of all variables.
     * 
     * @param int|null $userId user id, whose variables names are returned if they were requested with a server method.
     * @param int|null $offset
     * @param int|null $count amount of variable names the info needs to be collected from.
     * @param array|null $custom
     * @return Promise
     */
    function getKeys(?int $userId = 0, ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('storage.getKeys', $sendParams);
    }

    /**
     * Saves a value of variable with the name set by 'key' parameter.
     * 
     * @param string $key
     * @param string|null $value
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function set(string $key, ?string $value = '', ?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['key'] = $key;
        if ($value !== '' && $value != null) $sendParams['value'] = $value;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('storage.set', $sendParams);
    }
}