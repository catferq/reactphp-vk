<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to delete a link from the community.
 */
class DeleteLink
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $linkId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteLink
     */
    public function _setCustom(array $value): DeleteLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return DeleteLink
     */
    public function setGroupId(int $value): DeleteLink
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Link ID.
     * 
     * @param int $value
     * @return DeleteLink
     */
    public function setLinkId(int $value): DeleteLink
    {
        $this->linkId = $value;
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
        $params['link_id'] = $this->linkId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->linkId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.deleteLink', $params);
    }
}