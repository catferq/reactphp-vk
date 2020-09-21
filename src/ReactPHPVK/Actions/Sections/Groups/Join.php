<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * With this method you can join the group or public page, and also confirm your participation in an event.
 */
class Join
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $notSure = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Join
     */
    public function _setCustom(array $value): Join
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID or screen name of the community.
     * 
     * @param int $value
     * @return Join
     */
    public function setGroupId(int $value): Join
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Optional parameter which is taken into account when 'gid' belongs to the event: '1' — Perhaps I will attend, '0' — I will be there for sure (default), ,
     * 
     * @param string $value
     * @return Join
     */
    public function setNotSure(string $value): Join
    {
        $this->notSure = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->notSure !== '') $params['not_sure'] = $this->notSure;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->notSure = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.join', $params);
    }
}