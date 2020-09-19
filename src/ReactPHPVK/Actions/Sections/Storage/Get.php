<?php

namespace ReactPHPVK\Actions\Sections\Storage;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a value of variable with the name set by key parameter.
 */
class Get
{
    private Provider $_provider;
    
    private string $key = '';
    private array $keys = [];
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Get
     */
    public function setKey(string $value): Get
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Get
     */
    public function setKeys(array $value): Get
    {
        $this->keys = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setUserId(int $value): Get
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->key !== '') $params['key'] = $this->key;
        if ($this->keys !== []) $params['keys'] = implode(',', $this->keys);
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->key = '';
            $this->keys = [];
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('storage.get', $params);
    }
}