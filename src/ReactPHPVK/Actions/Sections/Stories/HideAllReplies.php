<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Hides all replies in the last 24 hours from the user to current user's stories.
 */
class HideAllReplies
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return HideAllReplies
     */
    public function _setCustom(array $value): HideAllReplies
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user whose replies should be hidden.
     * 
     * @param int $value
     * @return HideAllReplies
     */
    public function setOwnerId(int $value): HideAllReplies
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return HideAllReplies
     */
    public function setGroupId(int $value): HideAllReplies
    {
        $this->groupId = $value;
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
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('stories.hideAllReplies', $params);
    }
}