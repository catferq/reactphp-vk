<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns statistics of performance indicators for ads, campaigns, clients or the whole account.
 */
class GetStatistics
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $idsType = '';
    private string $ids = '';
    private string $period = '';
    private string $dateFrom = '';
    private string $dateTo = '';
    private array $statsFields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetStatistics
     */
    public function _setCustom(array $value): GetStatistics
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetStatistics
     */
    public function setAccountId(int $value): GetStatistics
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns,, *client — clients,, *office — account.
     * 
     * @param string $value
     * @return GetStatistics
     */
    public function setIdsType(string $value): GetStatistics
    {
        $this->idsType = $value;
        return $this;
    }

    /**
     * IDs requested ads, campaigns, clients or account, separated with a comma, depending on the value set in 'ids_type'. Maximum 2000 objects.
     * 
     * @param string $value
     * @return GetStatistics
     */
    public function setIds(string $value): GetStatistics
    {
        $this->ids = $value;
        return $this;
    }

    /**
     * Data grouping by dates: *day — statistics by days,, *month — statistics by months,, *overall — overall statistics. 'date_from' and 'date_to' parameters set temporary limits.
     * 
     * @param string $value
     * @return GetStatistics
     */
    public function setPeriod(string $value): GetStatistics
    {
        $this->period = $value;
        return $this;
    }

    /**
     * Date to show statistics from. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — day it was created on,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — month it was created in,, *overall: 0.
     * 
     * @param string $value
     * @return GetStatistics
     */
    public function setDateFrom(string $value): GetStatistics
    {
        $this->dateFrom = $value;
        return $this;
    }

    /**
     * Date to show statistics to. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — current day,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — current month,, *overall: 0.
     * 
     * @param string $value
     * @return GetStatistics
     */
    public function setDateTo(string $value): GetStatistics
    {
        $this->dateTo = $value;
        return $this;
    }

    /**
     * Additional fields to add to statistics
     * 
     * @param array $value
     * @return GetStatistics
     */
    public function setStatsFields(array $value): GetStatistics
    {
        $this->statsFields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['account_id'] = $this->accountId;
        $params['ids_type'] = $this->idsType;
        $params['ids'] = $this->ids;
        $params['period'] = $this->period;
        $params['date_from'] = $this->dateFrom;
        $params['date_to'] = $this->dateTo;
        if ($this->statsFields !== []) $params['stats_fields'] = implode(',', $this->statsFields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->idsType = '';
            $this->ids = '';
            $this->period = '';
            $this->dateFrom = '';
            $this->dateTo = '';
            $this->statsFields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getStatistics', $params);
    }
}