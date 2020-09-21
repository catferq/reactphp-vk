<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits clients of an advertising agency.
 */
class UpdateClients
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $data = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return UpdateClients
     */
    public function _setCustom(array $value): UpdateClients
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return UpdateClients
     */
    public function setAccountId(int $value): UpdateClients
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Serialized JSON array of objects that describe changes in clients. Description of 'client_mod' objects see below.
     * 
     * @param string $value
     * @return UpdateClients
     */
    public function setData(string $value): UpdateClients
    {
        $this->data = $value;
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
        $params['data'] = $this->data;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->data = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.updateClients', $params);
    }
}