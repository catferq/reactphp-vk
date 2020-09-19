<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns invited users list of a community
 */
class GetInvitedUsers
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $offset = 0;
    private int $count = 20;
    private array $fields = [];
    private string $nameCase = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetInvitedUsers
     */
    public function _setCustom(array $value): GetInvitedUsers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Group ID to return invited users for.
     * 
     * @param int $value
     * @return GetInvitedUsers
     */
    public function setGroupId(int $value): GetInvitedUsers
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return GetInvitedUsers
     */
    public function setOffset(int $value): GetInvitedUsers
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of results to return.
     * 
     * @param int $value
     * @return GetInvitedUsers
     */
    public function setCount(int $value): GetInvitedUsers
    {
        $this->count = $value;
        return $this;
    }

    /**
     * List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
     * 
     * @param array $value
     * @return GetInvitedUsers
     */
    public function setFields(array $value): GetInvitedUsers
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname. Possible values: *'nom' — nominative (default),, *'gen' — genitive,, *'dat' — dative,, *'acc' — accusative, , *'ins' — instrumental,, *'abl' — prepositional.
     * 
     * @param string $value
     * @return GetInvitedUsers
     */
    public function setNameCase(string $value): GetInvitedUsers
    {
        $this->nameCase = $value;
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
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getInvitedUsers', $params);
    }
}