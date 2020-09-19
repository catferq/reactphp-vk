<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the size of targeting audience, and also recommended values for CPC and CPM.
 */
class GetTargetingStats
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private int $clientId = 0;
    private string $criteria = '';
    private int $adId = 0;
    private int $adFormat = 0;
    private string $adPlatform = '';
    private string $adPlatformNoWall = '';
    private string $adPlatformNoAdNetwork = '';
    private string $linkUrl = '';
    private string $linkDomain = '';
    private bool $needPrecise = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTargetingStats
     */
    public function _setCustom(array $value): GetTargetingStats
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetTargetingStats
     */
    public function setAccountId(int $value): GetTargetingStats
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTargetingStats
     */
    public function setClientId(int $value): GetTargetingStats
    {
        $this->clientId = $value;
        return $this;
    }

    /**
     * Serialized JSON object that describes targeting parameters. Description of 'criteria' object see below.
     * 
     * @param string $value
     * @return GetTargetingStats
     */
    public function setCriteria(string $value): GetTargetingStats
    {
        $this->criteria = $value;
        return $this;
    }

    /**
     * ID of an ad which targeting parameters shall be analyzed.
     * 
     * @param int $value
     * @return GetTargetingStats
     */
    public function setAdId(int $value): GetTargetingStats
    {
        $this->adId = $value;
        return $this;
    }

    /**
     * Ad format. Possible values: *'1' — image and text,, *'2' — big image,, *'3' — exclusive format,, *'4' — community, square image,, *'7' — special app format,, *'8' — special community format,, *'9' — post in community,, *'10' — app board.
     * 
     * @param int $value
     * @return GetTargetingStats
     */
    public function setAdFormat(int $value): GetTargetingStats
    {
        $this->adFormat = $value;
        return $this;
    }

    /**
     * Platforms to use for ad showing. Possible values: (for 'ad_format' = '1'), *'0' — VK and partner sites,, *'1' — VK only. (for 'ad_format' = '9'), *'all' — all platforms,, *'desktop' — desktop version,, *'mobile' — mobile version and apps.
     * 
     * @param string $value
     * @return GetTargetingStats
     */
    public function setAdPlatform(string $value): GetTargetingStats
    {
        $this->adPlatform = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetTargetingStats
     */
    public function setAdPlatformNoWall(string $value): GetTargetingStats
    {
        $this->adPlatformNoWall = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetTargetingStats
     */
    public function setAdPlatformNoAdNetwork(string $value): GetTargetingStats
    {
        $this->adPlatformNoAdNetwork = $value;
        return $this;
    }

    /**
     * URL for the advertised object.
     * 
     * @param string $value
     * @return GetTargetingStats
     */
    public function setLinkUrl(string $value): GetTargetingStats
    {
        $this->linkUrl = $value;
        return $this;
    }

    /**
     * Domain of the advertised object.
     * 
     * @param string $value
     * @return GetTargetingStats
     */
    public function setLinkDomain(string $value): GetTargetingStats
    {
        $this->linkDomain = $value;
        return $this;
    }

    /**
     * Additionally return recommended cpc and cpm to reach 5,10..95 percents of audience.
     * 
     * @param bool $value
     * @return GetTargetingStats
     */
    public function setNeedPrecise(bool $value): GetTargetingStats
    {
        $this->needPrecise = $value;
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
        if ($this->criteria !== '') $params['criteria'] = $this->criteria;
        if ($this->adId !== 0) $params['ad_id'] = $this->adId;
        if ($this->adFormat !== 0) $params['ad_format'] = $this->adFormat;
        if ($this->adPlatform !== '') $params['ad_platform'] = $this->adPlatform;
        if ($this->adPlatformNoWall !== '') $params['ad_platform_no_wall'] = $this->adPlatformNoWall;
        if ($this->adPlatformNoAdNetwork !== '') $params['ad_platform_no_ad_network'] = $this->adPlatformNoAdNetwork;
        $params['link_url'] = $this->linkUrl;
        if ($this->linkDomain !== '') $params['link_domain'] = $this->linkDomain;
        if ($this->needPrecise !== false) $params['need_precise'] = intval($this->needPrecise);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->clientId = 0;
            $this->criteria = '';
            $this->adId = 0;
            $this->adFormat = 0;
            $this->adPlatform = '';
            $this->adPlatformNoWall = '';
            $this->adPlatformNoAdNetwork = '';
            $this->linkUrl = '';
            $this->linkDomain = '';
            $this->needPrecise = false;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getTargetingStats', $params);
    }
}