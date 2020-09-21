<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a retarget group.
 */
class UpdateTargetGroup
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private int $targetGroupId = 0;
    private string $name = '';
    private string $domain = '';
    private int $lifetime = 0;
    private int $targetPixelId = 0;
    private string $targetPixelRules = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return UpdateTargetGroup
     */
    public function _setCustom(array $value): UpdateTargetGroup
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return UpdateTargetGroup
     */
    public function setAccountId(int $value): UpdateTargetGroup
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
     * 
     * @param int $value
     * @return UpdateTargetGroup
     */
    public function setClientId(int $value): UpdateTargetGroup
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Group ID.
     * 
     * @param int $value
     * @return UpdateTargetGroup
     */
    public function setTargetGroupId(int $value): UpdateTargetGroup
    {
        $this->targetGroupId = $value;
        return $this;
    }

    /**
     * New name of the target group — a string up to 64 characters long.
     * 
     * @param string $value
     * @return UpdateTargetGroup
     */
    public function setName(string $value): UpdateTargetGroup
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Domain of the site where user accounting code will be placed.
     * 
     * @param string $value
     * @return UpdateTargetGroup
     */
    public function setDomain(string $value): UpdateTargetGroup
    {
        $this->domain = $value;
        return $this;
    }

    /**
     * 'Only for the groups that get audience from sites with user accounting code.', Time in days when users added to a retarget group will be automatically excluded from it. '0' - automatic exclusion is off.
     * 
     * @param int $value
     * @return UpdateTargetGroup
     */
    public function setLifetime(int $value): UpdateTargetGroup
    {
        $this->lifetime = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return UpdateTargetGroup
     */
    public function setTargetPixelId(int $value): UpdateTargetGroup
    {
        $this->targetPixelId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return UpdateTargetGroup
     */
    public function setTargetPixelRules(string $value): UpdateTargetGroup
    {
        $this->targetPixelRules = $value;
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
        $params['name'] = $this->name;
        if ($this->domain !== '') $params['domain'] = $this->domain;
        $params['lifetime'] = $this->lifetime;
        if ($this->targetPixelId !== 0) $params['target_pixel_id'] = $this->targetPixelId;
        if ($this->targetPixelRules !== '') $params['target_pixel_rules'] = $this->targetPixelRules;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->targetGroupId = 0;
            $this->name = '';
            $this->domain = '';
            $this->lifetime = 0;
            $this->targetPixelId = 0;
            $this->targetPixelRules = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.updateTargetGroup', $params);
    }
}