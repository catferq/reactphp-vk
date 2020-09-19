<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of target groups.
 */
class GetTargetGroups
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTargetGroups
     */
    public function _setCustom(array $value): GetTargetGroups
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetTargetGroups
     */
    public function setAccountId(int $value): GetTargetGroups
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * 'Only for advertising agencies.', ID of the client with the advertising account where the group will be created.
     * 
     * @param int $value
     * @return GetTargetGroups
     */
    public function setClientId(int $value): GetTargetGroups
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * '1' — to return pixel code.
     * 
     * @param bool $value
     * @return GetTargetGroups
     */
    public function setExtended(bool $value): GetTargetGroups
    {
        $this->extended = $value;
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
        if ($this->clientId !== 0) $params['client_id'] = $this->clientId;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getTargetGroups', $params);
    }
}