<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Archives advertising campaigns.
 */
class DeleteCampaigns
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $ids = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteCampaigns
     */
    public function _setCustom(array $value): DeleteCampaigns
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return DeleteCampaigns
     */
    public function setAccountId(int $value): DeleteCampaigns
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Serialized JSON array with IDs of deleted campaigns.
     * 
     * @param string $value
     * @return DeleteCampaigns
     */
    public function setIds(string $value): DeleteCampaigns
    {
        $this->ids = $value;
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
        $params['ids'] = $this->ids;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->ids = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.deleteCampaigns', $params);
    }
}