<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Unban
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Unban
     */
    public function _setCustom(array $value): Unban
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Unban
     */
    public function setOwnerId(int $value): Unban
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('account.unban', $params);
    }
}