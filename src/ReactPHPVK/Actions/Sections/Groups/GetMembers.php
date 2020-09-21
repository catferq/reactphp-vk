<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of community members.
 */
class GetMembers
{
    private Provider $_provider;
    
    private string $groupId = '';
    private string $sort = 'id_asc';
    private int $offset = 0;
    private int $count = 1000;
    private array $fields = [];
    private string $filter = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMembers
     */
    public function _setCustom(array $value): GetMembers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID or screen name of the community.
     * 
     * @param string $value
     * @return GetMembers
     */
    public function setGroupId(string $value): GetMembers
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Sort order. Available values: 'id_asc', 'id_desc', 'time_asc', 'time_desc'. 'time_asc' and 'time_desc' are availavle only if the method is called by the group's 'moderator'.
     * 
     * @param string $value
     * @return GetMembers
     */
    public function setSort(string $value): GetMembers
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of community members.
     * 
     * @param int $value
     * @return GetMembers
     */
    public function setOffset(int $value): GetMembers
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of community members to return.
     * 
     * @param int $value
     * @return GetMembers
     */
    public function setCount(int $value): GetMembers
    {
        $this->count = $value;
        return $this;
    }

    /**
     * List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
     * 
     * @param array $value
     * @return GetMembers
     */
    public function setFields(array $value): GetMembers
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * *'friends' – only friends in this community will be returned,, *'unsure' – only those who pressed 'I may attend' will be returned (if it's an event).
     * 
     * @param string $value
     * @return GetMembers
     */
    public function setFilter(string $value): GetMembers
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupId !== '') $params['group_id'] = $this->groupId;
        if ($this->sort !== 'id_asc') $params['sort'] = $this->sort;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 1000) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->filter !== '') $params['filter'] = $this->filter;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = '';
            $this->sort = 'id_asc';
            $this->offset = 0;
            $this->count = 1000;
            $this->fields = [];
            $this->filter = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getMembers', $params);
    }
}