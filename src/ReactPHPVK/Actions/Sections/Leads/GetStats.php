<?php

namespace ReactPHPVK\Actions\Sections\Leads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns lead stats data.
 */
class GetStats
{
    private Provider $_provider;
    
    private int $leadId = 0;
    private string $secret = '';
    private string $dateStart = '';
    private string $dateEnd = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetStats
     */
    public function _setCustom(array $value): GetStats
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Lead ID.
     * 
     * @param int $value
     * @return GetStats
     */
    public function setLeadId(int $value): GetStats
    {
        $this->leadId = $value;
        return $this;
    }

    /**
     * Secret key obtained from the lead testing interface.
     * 
     * @param string $value
     * @return GetStats
     */
    public function setSecret(string $value): GetStats
    {
        $this->secret = $value;
        return $this;
    }

    /**
     * Day to start stats from (YYYY_MM_DD, e.g.2011-09-17).
     * 
     * @param string $value
     * @return GetStats
     */
    public function setDateStart(string $value): GetStats
    {
        $this->dateStart = $value;
        return $this;
    }

    /**
     * Day to finish stats (YYYY_MM_DD, e.g.2011-09-17).
     * 
     * @param string $value
     * @return GetStats
     */
    public function setDateEnd(string $value): GetStats
    {
        $this->dateEnd = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['lead_id'] = $this->leadId;
        if ($this->secret !== '') $params['secret'] = $this->secret;
        if ($this->dateStart !== '') $params['date_start'] = $this->dateStart;
        if ($this->dateEnd !== '') $params['date_end'] = $this->dateEnd;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->leadId = 0;
            $this->secret = '';
            $this->dateStart = '';
            $this->dateEnd = '';
            $this->_custom = [];
        }

        return $this->_provider->request('leads.getStats', $params);
    }
}