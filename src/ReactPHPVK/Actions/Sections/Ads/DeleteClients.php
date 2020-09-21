<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Archives clients of an advertising agency.
 */
class DeleteClients
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
     * @return DeleteClients
     */
    public function _setCustom(array $value): DeleteClients
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return DeleteClients
     */
    public function setAccountId(int $value): DeleteClients
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Serialized JSON array with IDs of deleted clients.
     * 
     * @param string $value
     * @return DeleteClients
     */
    public function setIds(string $value): DeleteClients
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

        return $this->_provider->request('ads.deleteClients', $params);
    }
}