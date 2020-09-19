<?php

namespace ReactPHPVK\Actions\Sections\Leads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Counts the metric event.
 */
class MetricHit
{
    private Provider $_provider;
    
    private string $data = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MetricHit
     */
    public function _setCustom(array $value): MetricHit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Metric data obtained in the lead interface.
     * 
     * @param string $value
     * @return MetricHit
     */
    public function setData(string $value): MetricHit
    {
        $this->data = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['data'] = $this->data;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->data = '';
            $this->_custom = [];
        }

        return $this->_provider->request('leads.metricHit', $params);
    }
}