<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes shortened link from user's list.
 */
class DeleteFromLastShortened
{
    private Provider $_provider;
    
    private string $key = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteFromLastShortened
     */
    public function _setCustom(array $value): DeleteFromLastShortened
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Link key (characters after vk.cc/).
     * 
     * @param string $value
     * @return DeleteFromLastShortened
     */
    public function setKey(string $value): DeleteFromLastShortened
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['key'] = $this->key;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->key = '';
            $this->_custom = [];
        }

        return $this->_provider->request('utils.deleteFromLastShortened', $params);
    }
}