<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sets a counter which is shown to the user in bold in the left menu.
 */
class SetCounter
{
    private Provider $_provider;
    
    private array $counters = [];
    private int $userId = 0;
    private int $counter = 0;
    private bool $increment = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetCounter
     */
    public function _setCustom(array $value): SetCounter
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return SetCounter
     */
    public function setCounters(array $value): SetCounter
    {
        $this->counters = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SetCounter
     */
    public function setUserId(int $value): SetCounter
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * counter value.
     * 
     * @param int $value
     * @return SetCounter
     */
    public function setCounter(int $value): SetCounter
    {
        $this->counter = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCounter
     */
    public function setIncrement(bool $value): SetCounter
    {
        $this->increment = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->counters !== []) $params['counters'] = implode(',', $this->counters);
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->counter !== 0) $params['counter'] = $this->counter;
        if ($this->increment !== false) $params['increment'] = intval($this->increment);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->counters = [];
            $this->userId = 0;
            $this->counter = 0;
            $this->increment = false;
            $this->_custom = [];
        }

        return $this->_provider->request('secure.setCounter', $params);
    }
}