<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a retarget group.
 */
class DeleteTargetGroup
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private int $targetGroupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteTargetGroup
     */
    public function _setCustom(array $value): DeleteTargetGroup
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return DeleteTargetGroup
     */
    public function setAccountId(int $value): DeleteTargetGroup
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
     * 
     * @param int $value
     * @return DeleteTargetGroup
     */
    public function setClientId(int $value): DeleteTargetGroup
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Group ID.
     * 
     * @param int $value
     * @return DeleteTargetGroup
     */
    public function setTargetGroupId(int $value): DeleteTargetGroup
    {
        $this->targetGroupId = $value;
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
        $params['target_group_id'] = $this->targetGroupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->targetGroupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.deleteTargetGroup', $params);
    }
}