<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class TrackPageInteraction
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return TrackPageInteraction
     */
    public function _setCustom(array $value): TrackPageInteraction
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return TrackPageInteraction
     */
    public function setUserId(int $value): TrackPageInteraction
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return TrackPageInteraction
     */
    public function setGroupId(int $value): TrackPageInteraction
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('fave.trackPageInteraction', $params);
    }
}