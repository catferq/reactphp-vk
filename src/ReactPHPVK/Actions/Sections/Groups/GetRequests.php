<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of requests to the community.
 */
class GetRequests
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $offset = 0;
    private int $count = 20;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetRequests
     */
    public function _setCustom(array $value): GetRequests
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return GetRequests
     */
    public function setGroupId(int $value): GetRequests
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return GetRequests
     */
    public function setOffset(int $value): GetRequests
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of results to return.
     * 
     * @param int $value
     * @return GetRequests
     */
    public function setCount(int $value): GetRequests
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetRequests
     */
    public function setFields(array $value): GetRequests
    {
        $this->fields = $value;
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
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getRequests', $params);
    }
}