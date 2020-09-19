<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Hides the reply to the current user's story.
 */
class HideReply
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
     * @return HideReply
     */
    public function _setCustom(array $value): HideReply
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user whose replies should be hidden.
     * 
     * @param int $value
     * @return HideReply
     */
    public function setOwnerId(int $value): HideReply
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Story ID.
     * 
     * @param int $value
     * @return HideReply
     */
    public function setStoryId(int $value): HideReply
    {
        $this->storyId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->storyId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('stories.hideReply', $params);
    }
}