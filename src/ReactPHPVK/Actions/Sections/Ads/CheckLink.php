<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to check the ad link.
 */
class CheckLink
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $linkType = '';
    private string $linkUrl = '';
    private int $campaignId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CheckLink
     */
    public function _setCustom(array $value): CheckLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return CheckLink
     */
    public function setAccountId(int $value): CheckLink
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Object type: *'community' — community,, *'post' — community post,, *'application' — VK application,, *'video' — video,, *'site' — external site.
     * 
     * @param string $value
     * @return CheckLink
     */
    public function setLinkType(string $value): CheckLink
    {
        $this->linkType = $value;
        return $this;
    }

    /**
     * Object URL.
     * 
     * @param string $value
     * @return CheckLink
     */
    public function setLinkUrl(string $value): CheckLink
    {
        $this->linkUrl = $value;
        return $this;
    }

    /**
     * Campaign ID
     * 
     * @param int $value
     * @return CheckLink
     */
    public function setCampaignId(int $value): CheckLink
    {
        $this->campaignId = $value;
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
        $params['link_type'] = $this->linkType;
        $params['link_url'] = $this->linkUrl;
        if ($this->campaignId !== 0) $params['campaign_id'] = $this->campaignId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->linkType = '';
            $this->linkUrl = '';
            $this->campaignId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.checkLink', $params);
    }
}