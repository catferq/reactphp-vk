<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of newsfeeds followed by the current user.
 */
class GetLists
{
    private Provider $_provider;
    
    private array $listIds = [];
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLists
     */
    public function _setCustom(array $value): GetLists
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * numeric list identifiers.
     * 
     * @param array $value
     * @return GetLists
     */
    public function setListIds(array $value): GetLists
    {
        $this->listIds = $value;
        return $this;
    }

    /**
     * Return additional list info
     * 
     * @param bool $value
     * @return GetLists
     */
    public function setExtended(bool $value): GetLists
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->listIds !== []) $params['list_ids'] = implode(',', $this->listIds);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->listIds = [];
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.getLists', $params);
    }
}