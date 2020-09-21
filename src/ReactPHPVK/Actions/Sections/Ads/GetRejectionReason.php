<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a reason of ad rejection for pre-moderation.
 */
class GetRejectionReason
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $adId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetRejectionReason
     */
    public function _setCustom(array $value): GetRejectionReason
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetRejectionReason
     */
    public function setAccountId(int $value): GetRejectionReason
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Ad ID.
     * 
     * @param int $value
     * @return GetRejectionReason
     */
    public function setAdId(int $value): GetRejectionReason
    {
        $this->adId = $value;
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
        $params['ad_id'] = $this->adId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->adId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getRejectionReason', $params);
    }
}