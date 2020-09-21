<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of campaigns in an advertising account.
 */
class GetCampaigns
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private bool $includeDeleted = false;
    private string $campaignIds = '';
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCampaigns
     */
    public function _setCustom(array $value): GetCampaigns
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetCampaigns
     */
    public function setAccountId(int $value): GetCampaigns
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * 'For advertising agencies'. ID of the client advertising campaigns are retrieved from.
     * 
     * @param int $value
     * @return GetCampaigns
     */
    public function setClientId(int $value): GetCampaigns
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Flag that specifies whether archived ads shall be shown. *0 — show only active campaigns,, *1 — show all campaigns.
     * 
     * @param bool $value
     * @return GetCampaigns
     */
    public function setIncludeDeleted(bool $value): GetCampaigns
    {
        $this->includeDeleted = $value;
        return $this;
    }

    /**
     * Filter of advertising campaigns to show. Serialized JSON array with campaign IDs. Only campaigns that exist in 'campaign_ids' and belong to the specified advertising account will be shown. If the parameter is null, all campaigns will be shown.
     * 
     * @param string $value
     * @return GetCampaigns
     */
    public function setCampaignIds(string $value): GetCampaigns
    {
        $this->campaignIds = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetCampaigns
     */
    public function setFields(array $value): GetCampaigns
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['account_id'] = $this->accountId;
        if ($this->clientId !== 0) $params['client_id'] = $this->clientId;
        if ($this->includeDeleted !== false) $params['include_deleted'] = intval($this->includeDeleted);
        if ($this->campaignIds !== '') $params['campaign_ids'] = $this->campaignIds;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->includeDeleted = false;
            $this->campaignIds = '';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getCampaigns', $params);
    }
}