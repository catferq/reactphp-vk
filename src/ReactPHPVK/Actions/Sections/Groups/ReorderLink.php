<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to reorder links in the community.
 */
class ReorderLink
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $linkId = 0;
    private int $after = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ReorderLink
     */
    public function _setCustom(array $value): ReorderLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return ReorderLink
     */
    public function setGroupId(int $value): ReorderLink
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Link ID.
     * 
     * @param int $value
     * @return ReorderLink
     */
    public function setLinkId(int $value): ReorderLink
    {
        $this->linkId = $value;
        return $this;
    }

    /**
     * ID of the link after which to place the link with 'link_id'.
     * 
     * @param int $value
     * @return ReorderLink
     */
    public function setAfter(int $value): ReorderLink
    {
        $this->after = $value;
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
        $params['link_id'] = $this->linkId;
        if ($this->after !== 0) $params['after'] = $this->after;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->linkId = 0;
            $this->after = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.reorderLink', $params);
    }
}