<?php

namespace ReactPHPVK\Actions\Sections\Storage;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves a value of variable with the name set by 'key' parameter.
 */
class Set
{
    private Provider $_provider;
    
    private string $key = '';
    private string $value = '';
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Set
     */
    public function _setCustom(array $value): Set
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Set
     */
    public function setKey(string $value): Set
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Set
     */
    public function setValue(string $value): Set
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Set
     */
    public function setUserId(int $value): Set
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

        $params['key'] = $this->key;
        if ($this->value !== '') $params['value'] = $this->value;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->key = '';
            $this->value = '';
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('storage.set', $params);
    }
}