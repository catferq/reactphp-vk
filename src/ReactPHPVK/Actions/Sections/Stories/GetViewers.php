<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of story viewers.
 */
class GetViewers
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $storyId = 0;
    private int $count = 100;
    private int $offset = 0;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetViewers
     */
    public function _setCustom(array $value): GetViewers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Story owner ID.
     * 
     * @param int $value
     * @return GetViewers
     */
    public function setOwnerId(int $value): GetViewers
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Story ID.
     * 
     * @param int $value
     * @return GetViewers
     */
    public function setStoryId(int $value): GetViewers
    {
        $this->storyId = $value;
        return $this;
    }

    /**
     * Maximum number of results.
     * 
     * @param int $value
     * @return GetViewers
     */
    public function setCount(int $value): GetViewers
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return GetViewers
     */
    public function setOffset(int $value): GetViewers
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * '1' — to return detailed information about photos
     * 
     * @param bool $value
     * @return GetViewers
     */
    public function setExtended(bool $value): GetViewers
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

        $params['owner_id'] = $this->ownerId;
        $params['story_id'] = $this->storyId;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->storyId = 0;
            $this->count = 100;
            $this->offset = 0;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('stories.getViewers', $params);
    }
}