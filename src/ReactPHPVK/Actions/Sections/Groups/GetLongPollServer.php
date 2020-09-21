<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the data needed to query a Long Poll server for events
 */
class GetLongPollServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLongPollServer
     */
    public function _setCustom(array $value): GetLongPollServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID
     * 
     * @param int $value
     * @return GetLongPollServer
     */
    public function setGroupId(int $value): GetLongPollServer
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

        $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getLongPollServer', $params);
    }
}