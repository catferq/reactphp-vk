<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of active ads (offers) which executed by the user will bring him/her respective number of votes to his balance in the application.
 */
class GetActiveOffers
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 100;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetActiveOffers
     */
    public function _setCustom(array $value): GetActiveOffers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetActiveOffers
     */
    public function setOffset(int $value): GetActiveOffers
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of results to return.
     * 
     * @param int $value
     * @return GetActiveOffers
     */
    public function setCount(int $value): GetActiveOffers
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('account.getActiveOffers', $params);
    }
}