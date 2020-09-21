<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Archives ads.
 */
class DeleteAds
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
     * @return DeleteAds
     */
    public function _setCustom(array $value): DeleteAds
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return DeleteAds
     */
    public function setAccountId(int $value): DeleteAds
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Serialized JSON array with ad IDs.
     * 
     * @param string $value
     * @return DeleteAds
     */
    public function setIds(string $value): DeleteAds
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

        return $this->_provider->request('ads.deleteAds', $params);
    }
}