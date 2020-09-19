<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Unban
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Unban
     */
    public function _setCustom(array $value): Unban
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Unban
     */
    public function setGroupId(int $value): Unban
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Unban
     */
    public function setOwnerId(int $value): Unban
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.unban', $params);
    }
}