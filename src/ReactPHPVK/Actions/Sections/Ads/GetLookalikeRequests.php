<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetLookalikeRequests
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private string $requestsIds = '';
    private int $offset = 0;
    private int $limit = 10;
    private string $sortBy = 'id';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLookalikeRequests
     */
    public function _setCustom(array $value): GetLookalikeRequests
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetLookalikeRequests
     */
    public function setAccountId(int $value): GetLookalikeRequests
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetLookalikeRequests
     */
    public function setClientId(int $value): GetLookalikeRequests
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetLookalikeRequests
     */
    public function setRequestsIds(string $value): GetLookalikeRequests
    {
        $this->requestsIds = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetLookalikeRequests
     */
    public function setOffset(int $value): GetLookalikeRequests
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetLookalikeRequests
     */
    public function setLimit(int $value): GetLookalikeRequests
    {
        $this->limit = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetLookalikeRequests
     */
    public function setSortBy(string $value): GetLookalikeRequests
    {
        $this->sortBy = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['account_id'] = $this->accountId;
        if ($this->clientId !== 0) $params['client_id'] = $this->clientId;
        if ($this->requestsIds !== '') $params['requests_ids'] = $this->requestsIds;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->limit !== 10) $params['limit'] = $this->limit;
        if ($this->sortBy !== 'id') $params['sort_by'] = $this->sortBy;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->requestsIds = '';
            $this->offset = 0;
            $this->limit = 10;
            $this->sortBy = 'id';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getLookalikeRequests', $params);
    }
}