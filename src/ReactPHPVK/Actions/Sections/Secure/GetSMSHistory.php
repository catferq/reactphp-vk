<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Shows a list of SMS notifications sent by the application using [vk.com/dev/secure.sendSMSNotification|secure.sendSMSNotification] method.
 */
class GetSMSHistory
{
    private Provider $_provider;
    
    private int $userId = 0;
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
     * @return GetSMSHistory
     */
    public function _setCustom(array $value): GetSMSHistory
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetSMSHistory
     */
    public function setUserId(int $value): GetSMSHistory
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * filter by start date. It is set as UNIX-time.
     * 
     * @param int $value
     * @return GetSMSHistory
     */
    public function setDateFrom(int $value): GetSMSHistory
    {
        $this->dateFrom = $value;
        return $this;
    }

    /**
     * filter by end date. It is set as UNIX-time.
     * 
     * @param int $value
     * @return GetSMSHistory
     */
    public function setDateTo(int $value): GetSMSHistory
    {
        $this->dateTo = $value;
        return $this;
    }

    /**
     * number of returned posts. By default — 1000.
     * 
     * @param int $value
     * @return GetSMSHistory
     */
    public function setLimit(int $value): GetSMSHistory
    {
        $this->limit = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->dateFrom !== 0) $params['date_from'] = $this->dateFrom;
        if ($this->dateTo !== 0) $params['date_to'] = $this->dateTo;
        if ($this->limit !== 1000) $params['limit'] = $this->limit;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->dateFrom = 0;
            $this->dateTo = 0;
            $this->limit = 1000;
            $this->_custom = [];
        }

        return $this->_provider->request('secure.getSMSHistory', $params);
    }
}