<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about current state of a counter — number of remaining runs of methods and time to the next counter nulling in seconds.
 */
class GetFloodStats
{
    private Provider $_provider;
    
    private int $accountId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetFloodStats
     */
    public function _setCustom(array $value): GetFloodStats
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetFloodStats
     */
    public function setAccountId(int $value): GetFloodStats
    {
        $this->accountId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getFloodStats', $params);
    }
}