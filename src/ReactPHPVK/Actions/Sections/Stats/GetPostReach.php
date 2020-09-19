<?php

namespace ReactPHPVK\Actions\Sections\Stats;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns stats for a wall post.
 */
class GetPostReach
{
    private Provider $_provider;
    
    private string $ownerId = '';
    private array $postIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetPostReach
     */
    public function _setCustom(array $value): GetPostReach
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * post owner community id. Specify with "-" sign.
     * 
     * @param string $value
     * @return GetPostReach
     */
    public function setOwnerId(string $value): GetPostReach
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * wall posts id
     * 
     * @param array $value
     * @return GetPostReach
     */
    public function setPostIds(array $value): GetPostReach
    {
        $this->postIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['post_ids'] = implode(',', $this->postIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = '';
            $this->postIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stats.getPostReach', $params);
    }
}