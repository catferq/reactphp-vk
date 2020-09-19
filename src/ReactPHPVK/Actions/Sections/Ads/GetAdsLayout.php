<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns descriptions of ad layouts.
 */
class GetAdsLayout
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $adIds = '';
    private string $campaignIds = '';
    private int $clientId = 0;
    private bool $includeDeleted = false;
    private int $limit = 0;
    private int $offset = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAdsLayout
     */
    public function _setCustom(array $value): GetAdsLayout
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetAdsLayout
     */
    public function setAccountId(int $value): GetAdsLayout
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
     * 
     * @param string $value
     * @return GetAdsLayout
     */
    public function setAdIds(string $value): GetAdsLayout
    {
        $this->adIds = $value;
        return $this;
    }

    /**
     * Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
     * 
     * @param string $value
     * @return GetAdsLayout
     */
    public function setCampaignIds(string $value): GetAdsLayout
    {
        $this->campaignIds = $value;
        return $this;
    }

    /**
     * 'For advertising agencies.' ID of the client ads are retrieved from.
     * 
     * @param int $value
     * @return GetAdsLayout
     */
    public function setClientId(int $value): GetAdsLayout
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Flag that specifies whether archived ads shall be shown. *0 — show only active ads,, *1 — show all ads.
     * 
     * @param bool $value
     * @return GetAdsLayout
     */
    public function setIncludeDeleted(bool $value): GetAdsLayout
    {
        $this->includeDeleted = $value;
        return $this;
    }

    /**
     * Limit of number of returned ads. Used only if 'ad_ids' parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
     * 
     * @param int $value
     * @return GetAdsLayout
     */
    public function setLimit(int $value): GetAdsLayout
    {
        $this->limit = $value;
        return $this;
    }

    /**
     * Offset. Used in the same cases as 'limit' parameter.
     * 
     * @param int $value
     * @return GetAdsLayout
     */
    public function setOffset(int $value): GetAdsLayout
    {
        $this->offset = $value;
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
        if ($this->adIds !== '') $params['ad_ids'] = $this->adIds;
        if ($this->campaignIds !== '') $params['campaign_ids'] = $this->campaignIds;
        if ($this->clientId !== 0) $params['client_id'] = $this->clientId;
        if ($this->includeDeleted !== false) $params['include_deleted'] = intval($this->includeDeleted);
        if ($this->limit !== 0) $params['limit'] = $this->limit;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->adIds = '';
            $this->campaignIds = '';
            $this->clientId = 0;
            $this->includeDeleted = false;
            $this->limit = 0;
            $this->offset = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getAdsLayout', $params);
    }
}