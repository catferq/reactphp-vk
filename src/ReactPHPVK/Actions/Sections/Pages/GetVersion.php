<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the text of one of the previous versions of a wiki page.
 */
class GetVersion
{
    private Provider $_provider;
    
    private int $versionId = 0;
    private int $groupId = 0;
    private int $userId = 0;
    private bool $needHtml = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetVersion
     */
    public function _setCustom(array $value): GetVersion
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetVersion
     */
    public function setVersionId(int $value): GetVersion
    {
        $this->versionId = $value;
        return $this;
    }

    /**
     * ID of the community that owns the wiki page.
     * 
     * @param int $value
     * @return GetVersion
     */
    public function setGroupId(int $value): GetVersion
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetVersion
     */
    public function setUserId(int $value): GetVersion
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * '1' — to return the page as HTML
     * 
     * @param bool $value
     * @return GetVersion
     */
    public function setNeedHtml(bool $value): GetVersion
    {
        $this->needHtml = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['version_id'] = $this->versionId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->needHtml !== false) $params['need_html'] = intval($this->needHtml);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->versionId = 0;
            $this->groupId = 0;
            $this->userId = 0;
            $this->needHtml = false;
            $this->_custom = [];
        }

        return $this->_provider->request('pages.getVersion', $params);
    }
}