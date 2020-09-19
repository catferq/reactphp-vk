<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Removes managers and/or supervisors from advertising account.
 */
class RemoveOfficeUsers
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
     * @return RemoveOfficeUsers
     */
    public function _setCustom(array $value): RemoveOfficeUsers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return RemoveOfficeUsers
     */
    public function setAccountId(int $value): RemoveOfficeUsers
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Serialized JSON array with IDs of deleted managers.
     * 
     * @param string $value
     * @return RemoveOfficeUsers
     */
    public function setIds(string $value): RemoveOfficeUsers
    {
        $this->ids = $value;
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
        $params['ids'] = $this->ids;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->ids = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.removeOfficeUsers', $params);
    }
}