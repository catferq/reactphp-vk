<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about communities by their IDs.
 */
class GetById
{
    private Provider $_provider;
    
    private array $groupIds = [];
    private string $groupId = '';
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * IDs or screen names of communities.
     * 
     * @param array $value
     * @return GetById
     */
    public function setGroupIds(array $value): GetById
    {
        $this->groupIds = $value;
        return $this;
    }

    /**
     * ID or screen name of the community.
     * 
     * @param string $value
     * @return GetById
     */
    public function setGroupId(string $value): GetById
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Group fields to return.
     * 
     * @param array $value
     * @return GetById
     */
    public function setFields(array $value): GetById
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupIds !== []) $params['group_ids'] = implode(',', $this->groupIds);
        if ($this->groupId !== '') $params['group_id'] = $this->groupId;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupIds = [];
            $this->groupId = '';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getById', $params);
    }
}