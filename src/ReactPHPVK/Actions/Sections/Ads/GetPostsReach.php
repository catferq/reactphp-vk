<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns detailed statistics of promoted posts reach from campaigns and ads.
 */
class GetPostsReach
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $idsType = '';
    private string $ids = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetPostsReach
     */
    public function _setCustom(array $value): GetPostsReach
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetPostsReach
     */
    public function setAccountId(int $value): GetPostsReach
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns.
     * 
     * @param string $value
     * @return GetPostsReach
     */
    public function setIdsType(string $value): GetPostsReach
    {
        $this->idsType = $value;
        return $this;
    }

    /**
     * IDs requested ads or campaigns, separated with a comma, depending on the value set in 'ids_type'. Maximum 100 objects.
     * 
     * @param string $value
     * @return GetPostsReach
     */
    public function setIds(string $value): GetPostsReach
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
        $params['ids_type'] = $this->idsType;
        $params['ids'] = $this->ids;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->idsType = '';
            $this->ids = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getPostsReach', $params);
    }
}