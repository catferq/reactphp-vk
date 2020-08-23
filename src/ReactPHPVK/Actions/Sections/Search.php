<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Search
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Allows the programmer to do a quick search for any substring.
     * 
     * @param string|null $q Search query string.
     * @param int|null $offset Offset for querying specific result subset
     * @param int|null $limit Maximum number of results to return.
     * @param array|null $filters
     * @param array|null $fields
     * @param bool|null $searchGlobal
     * @param array|null $custom
     * @return Promise
     */
    function getHints(?string $q = '', ?int $offset = 0, ?int $limit = 9, ?array $filters = [], ?array $fields = [], ?bool $searchGlobal = true, ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($limit !== 9 && $limit != null) $sendParams['limit'] = $limit;
        if ($filters !== [] && $filters != null) $sendParams['filters'] = implode(',', $filters);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($searchGlobal !== true && $searchGlobal != null) $sendParams['search_global'] = intval($searchGlobal);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('search.getHints', $sendParams);
    }
}