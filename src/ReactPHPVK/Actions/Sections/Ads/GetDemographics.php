<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns demographics for ads or campaigns.
 */
class GetDemographics
{
    private Provider $_provider;
    
    private int $accountId = 0;
    private string $idsType = '';
    private string $ids = '';
    private string $period = '';
    private string $dateFrom = '';
    private string $dateTo = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetDemographics
     */
    public function _setCustom(array $value): GetDemographics
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Advertising account ID.
     * 
     * @param int $value
     * @return GetDemographics
     */
    public function setAccountId(int $value): GetDemographics
    {
        $this->accountId = $value;
        return $this;
    }

    /**
     * Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns.
     * 
     * @param string $value
     * @return GetDemographics
     */
    public function setIdsType(string $value): GetDemographics
    {
        $this->idsType = $value;
        return $this;
    }

    /**
     * IDs requested ads or campaigns, separated with a comma, depending on the value set in 'ids_type'. Maximum 2000 objects.
     * 
     * @param string $value
     * @return GetDemographics
     */
    public function setIds(string $value): GetDemographics
    {
        $this->ids = $value;
        return $this;
    }

    /**
     * Data grouping by dates: *day — statistics by days,, *month — statistics by months,, *overall — overall statistics. 'date_from' and 'date_to' parameters set temporary limits.
     * 
     * @param string $value
     * @return GetDemographics
     */
    public function setPeriod(string $value): GetDemographics
    {
        $this->period = $value;
        return $this;
    }

    /**
     * Date to show statistics from. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — day it was created on,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — month it was created in,, *overall: 0.
     * 
     * @param string $value
     * @return GetDemographics
     */
    public function setDateFrom(string $value): GetDemographics
    {
        $this->dateFrom = $value;
        return $this;
    }

    /**
     * Date to show statistics to. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — current day,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — current month,, *overall: 0.
     * 
     * @param string $value
     * @return GetDemographics
     */
    public function setDateTo(string $value): GetDemographics
    {
        $this->dateTo = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['account_id'] = $this->accountId;
        $params['ids_type'] = $this->idsType;
        $params['ids'] = $this->ids;
        $params['period'] = $this->period;
        $params['date_from'] = $this->dateFrom;
        $params['date_to'] = $this->dateTo;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->accountId = 0;
            $this->idsType = '';
            $this->ids = '';
            $this->period = '';
            $this->dateFrom = '';
            $this->dateTo = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getDemographics', $params);
    }
}