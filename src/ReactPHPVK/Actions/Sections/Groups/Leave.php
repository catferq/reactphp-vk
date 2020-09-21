<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * With this method you can leave a group, public page, or event.
 */
class Leave
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
     * @return Leave
     */
    public function _setCustom(array $value): Leave
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID or screen name of the community.
     * 
     * @param int $value
     * @return Leave
     */
    public function setGroupId(int $value): Leave
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

        return $this->_provider->request('groups.leave', $params);
    }
}