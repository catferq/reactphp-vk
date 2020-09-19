<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of managers and supervisors of advertising account.
 */
class GetOfficeUsers
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
     * @return GetOfficeUsers
     */
    public function _setCustom(array $value): GetOfficeUsers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetOfficeUsers
     */
    public function setAccountId(int $value): GetOfficeUsers
    {
        $this->accountId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getOfficeUsers', $params);
    }
}