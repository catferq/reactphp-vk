<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Imports a list of advertiser's contacts to count VK registered users against the target group.
 */
class ImportTargetContacts
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private int $targetGroupId = 0;
    private string $contacts = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ImportTargetContacts
     */
    public function _setCustom(array $value): ImportTargetContacts
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return ImportTargetContacts
     */
    public function setAccountId(int $value): ImportTargetContacts
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
     * 
     * @param int $value
     * @return ImportTargetContacts
     */
    public function setClientId(int $value): ImportTargetContacts
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Target group ID.
     * 
     * @param int $value
     * @return ImportTargetContacts
     */
    public function setTargetGroupId(int $value): ImportTargetContacts
    {
        $this->targetGroupId = $value;
        return $this;
    }

    /**
     * List of phone numbers, emails or user IDs separated with a comma.
     * 
     * @param string $value
     * @return ImportTargetContacts
     */
    public function setContacts(string $value): ImportTargetContacts
    {
        $this->contacts = $value;
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
        $params['target_group_id'] = $this->targetGroupId;
        $params['contacts'] = $this->contacts;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->targetGroupId = 0;
            $this->contacts = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.importTargetContacts', $params);
    }
}