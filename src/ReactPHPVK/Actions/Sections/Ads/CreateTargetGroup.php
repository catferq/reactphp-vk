<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a group to re-target ads for users who visited advertiser's site (viewed information about the product, registered, etc.).
 */
class CreateTargetGroup
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private string $name = '';
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
     * @return CreateTargetGroup
     */
    public function _setCustom(array $value): CreateTargetGroup
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return CreateTargetGroup
     */
    public function setAccountId(int $value): CreateTargetGroup
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * 'Only for advertising agencies.', ID of the client with the advertising account where the group will be created.
     * 
     * @param int $value
     * @return CreateTargetGroup
     */
    public function setClientId(int $value): CreateTargetGroup
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Name of the target group — a string up to 64 characters long.
     * 
     * @param string $value
     * @return CreateTargetGroup
     */
    public function setName(string $value): CreateTargetGroup
    {
        $this->name = $value;
        return $this;
    }

    /**
     * 'For groups with auditory created with pixel code only.', , Number of days after that users will be automatically removed from the group.
     * 
     * @param int $value
     * @return CreateTargetGroup
     */
    public function setLifetime(int $value): CreateTargetGroup
    {
        $this->lifetime = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CreateTargetGroup
     */
    public function setTargetPixelId(int $value): CreateTargetGroup
    {
        $this->targetPixelId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return CreateTargetGroup
     */
    public function setTargetPixelRules(string $value): CreateTargetGroup
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
        $params['name'] = $this->name;
        $params['lifetime'] = $this->lifetime;
        if ($this->targetPixelId !== 0) $params['target_pixel_id'] = $this->targetPixelId;
        if ($this->targetPixelRules !== '') $params['target_pixel_rules'] = $this->targetPixelRules;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->name = '';
            $this->lifetime = 0;
            $this->targetPixelId = 0;
            $this->targetPixelRules = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.createTargetGroup', $params);
    }
}