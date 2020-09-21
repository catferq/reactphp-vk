<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class RemoveTag
{
    private Provider $_provider;
    
    private int $id = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveTag
     */
    public function _setCustom(array $value): RemoveTag
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveTag
     */
    public function setId(int $value): RemoveTag
    {
        $this->id = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['id'] = $this->id;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->id = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('fave.removeTag', $params);
    }
}