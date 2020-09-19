<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of wiki pages in a group.
 */
class GetTitles
{
    private Provider $_provider;
    
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTitles
     */
    public function _setCustom(array $value): GetTitles
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the wiki page.
     * 
     * @param int $value
     * @return GetTitles
     */
    public function setGroupId(int $value): GetTitles
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('pages.getTitles', $params);
    }
}