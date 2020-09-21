<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of all previous versions of a wiki page.
 */
class GetHistory
{
    private Provider $_provider;
    
    private int $pageId = 0;
    private int $groupId = 0;
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetHistory
     */
    public function _setCustom(array $value): GetHistory
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Wiki page ID.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setPageId(int $value): GetHistory
    {
        $this->pageId = $value;
        return $this;
    }

    /**
     * ID of the community that owns the wiki page.
     * 
     * @param int $value
     * @return GetHistory
     */
    public function setGroupId(int $value): GetHistory
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetHistory
     */
    public function setUserId(int $value): GetHistory
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['page_id'] = $this->pageId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->pageId = 0;
            $this->groupId = 0;
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('pages.getHistory', $params);
    }
}