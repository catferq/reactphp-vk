<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns stories available for current user.
 */
class GetStats
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $storyId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetStats
     */
    public function _setCustom(array $value): GetStats
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Story owner ID. 
     * 
     * @param int $value
     * @return GetStats
     */
    public function setOwnerId(int $value): GetStats
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Story ID.
     * 
     * @param int $value
     * @return GetStats
     */
    public function setStoryId(int $value): GetStats
    {
        $this->storyId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['story_id'] = $this->storyId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->storyId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('stories.getStats', $params);
    }
}