<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Shows history of votes transaction between users and the application.
 */
class GetTransactionsHistory
{
    private Provider $_provider;
    
    private int $type = 0;
    private int $uidFrom = 0;
    private int $uidTo = 0;
    private int $dateFrom = 0;
    private int $dateTo = 0;
    private int $limit = 1000;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTransactionsHistory
     */
    public function _setCustom(array $value): GetTransactionsHistory
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTransactionsHistory
     */
    public function setType(int $value): GetTransactionsHistory
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTransactionsHistory
     */
    public function setUidFrom(int $value): GetTransactionsHistory
    {
        $this->uidFrom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTransactionsHistory
     */
    public function setUidTo(int $value): GetTransactionsHistory
    {
        $this->uidTo = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTransactionsHistory
     */
    public function setDateFrom(int $value): GetTransactionsHistory
    {
        $this->dateFrom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTransactionsHistory
     */
    public function setDateTo(int $value): GetTransactionsHistory
    {
        $this->dateTo = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetTransactionsHistory
     */
    public function setLimit(int $value): GetTransactionsHistory
    {
        $this->limit = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->type !== 0) $params['type'] = $this->type;
        if ($this->uidFrom !== 0) $params['uid_from'] = $this->uidFrom;
        if ($this->uidTo !== 0) $params['uid_to'] = $this->uidTo;
        if ($this->dateFrom !== 0) $params['date_from'] = $this->dateFrom;
        if ($this->dateTo !== 0) $params['date_to'] = $this->dateTo;
        if ($this->limit !== 1000) $params['limit'] = $this->limit;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = 0;
            $this->uidFrom = 0;
            $this->uidTo = 0;
            $this->dateFrom = 0;
            $this->dateTo = 0;
            $this->limit = 1000;
            $this->_custom = [];
        }

        return $this->_provider->request('secure.getTransactionsHistory', $params);
    }
}