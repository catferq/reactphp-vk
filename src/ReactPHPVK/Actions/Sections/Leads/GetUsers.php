<?php

namespace ReactPHPVK\Actions\Sections\Leads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of last user actions for the offer.
 */
class GetUsers
{
    private Provider $_provider;
    
    private int $offerId = 0;
    private string $secret = '';
    private int $offset = 0;
    private int $count = 100;
    private int $status = 0;
    private bool $reverse = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetUsers
     */
    public function _setCustom(array $value): GetUsers
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Offer ID.
     * 
     * @param int $value
     * @return GetUsers
     */
    public function setOfferId(int $value): GetUsers
    {
        $this->offerId = $value;
        return $this;
    }

    /**
     * Secret key obtained in the lead testing interface.
     * 
     * @param string $value
     * @return GetUsers
     */
    public function setSecret(string $value): GetUsers
    {
        $this->secret = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of results.
     * 
     * @param int $value
     * @return GetUsers
     */
    public function setOffset(int $value): GetUsers
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of results to return.
     * 
     * @param int $value
     * @return GetUsers
     */
    public function setCount(int $value): GetUsers
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Action type. Possible values: *'0' — start,, *'1' — finish,, *'2' — blocking users,, *'3' — start in a test mode,, *'4' — finish in a test mode.
     * 
     * @param int $value
     * @return GetUsers
     */
    public function setStatus(int $value): GetUsers
    {
        $this->status = $value;
        return $this;
    }

    /**
     * Sort order. Possible values: *'1' — chronological,, *'0' — reverse chronological.
     * 
     * @param bool $value
     * @return GetUsers
     */
    public function setReverse(bool $value): GetUsers
    {
        $this->reverse = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['offer_id'] = $this->offerId;
        $params['secret'] = $this->secret;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->status !== 0) $params['status'] = $this->status;
        if ($this->reverse !== false) $params['reverse'] = intval($this->reverse);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offerId = 0;
            $this->secret = '';
            $this->offset = 0;
            $this->count = 100;
            $this->status = 0;
            $this->reverse = false;
            $this->_custom = [];
        }

        return $this->_provider->request('leads.getUsers', $params);
    }
}