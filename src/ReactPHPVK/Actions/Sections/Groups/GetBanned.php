<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of users on a community blacklist.
 */
class GetBanned
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $offset = 0;
    private int $count = 20;
    private array $fields = [];
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetBanned
     */
    public function _setCustom(array $value): GetBanned
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return GetBanned
     */
    public function setGroupId(int $value): GetBanned
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of users.
     * 
     * @param int $value
     * @return GetBanned
     */
    public function setOffset(int $value): GetBanned
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of users to return.
     * 
     * @param int $value
     * @return GetBanned
     */
    public function setCount(int $value): GetBanned
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetBanned
     */
    public function setFields(array $value): GetBanned
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetBanned
     */
    public function setOwnerId(int $value): GetBanned
    {
        $this->ownerId = $value;
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
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->fields = [];
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getBanned', $params);
    }
}