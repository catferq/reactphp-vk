<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class SetPageTags
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $groupId = 0;
    private array $tagIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetPageTags
     */
    public function _setCustom(array $value): SetPageTags
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SetPageTags
     */
    public function setUserId(int $value): SetPageTags
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SetPageTags
     */
    public function setGroupId(int $value): SetPageTags
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return SetPageTags
     */
    public function setTagIds(array $value): SetPageTags
    {
        $this->tagIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->tagIds !== []) $params['tag_ids'] = implode(',', $this->tagIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->groupId = 0;
            $this->tagIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('fave.setPageTags', $params);
    }
}