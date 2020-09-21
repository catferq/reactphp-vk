<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class ReorderTags
{
    private Provider $_provider;
    
    private array $ids = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ReorderTags
     */
    public function _setCustom(array $value): ReorderTags
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return ReorderTags
     */
    public function setIds(array $value): ReorderTags
    {
        $this->ids = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['ids'] = implode(',', $this->ids);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ids = [];
            $this->_custom = [];
        }

        return $this->_provider->request('fave.reorderTags', $params);
    }
}