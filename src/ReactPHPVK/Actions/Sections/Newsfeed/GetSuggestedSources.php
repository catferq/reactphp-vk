<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns communities and users that current user is suggested to follow.
 */
class GetSuggestedSources
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 20;
    private bool $shuffle = false;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetSuggestedSources
     */
    public function _setCustom(array $value): GetSuggestedSources
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * offset required to choose a particular subset of communities or users.
     * 
     * @param int $value
     * @return GetSuggestedSources
     */
    public function setOffset(int $value): GetSuggestedSources
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * amount of communities or users to return.
     * 
     * @param int $value
     * @return GetSuggestedSources
     */
    public function setCount(int $value): GetSuggestedSources
    {
        $this->count = $value;
        return $this;
    }

    /**
     * shuffle the returned list or not.
     * 
     * @param bool $value
     * @return GetSuggestedSources
     */
    public function setShuffle(bool $value): GetSuggestedSources
    {
        $this->shuffle = $value;
        return $this;
    }

    /**
     * list of extra fields to be returned. See available fields for [vk.com/dev/fields|users] and [vk.com/dev/fields_groups|communities].
     * 
     * @param array $value
     * @return GetSuggestedSources
     */
    public function setFields(array $value): GetSuggestedSources
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

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->shuffle !== false) $params['shuffle'] = intval($this->shuffle);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 20;
            $this->shuffle = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.getSuggestedSources', $params);
    }
}