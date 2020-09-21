<?php

namespace ReactPHPVK\Actions\Sections\Streaming;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class SetSettings
{
    private Provider $_provider;
    
    private string $monthlyTier = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetSettings
     */
    public function _setCustom(array $value): SetSettings
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SetSettings
     */
    public function setMonthlyTier(string $value): SetSettings
    {
        $this->monthlyTier = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->monthlyTier !== '') $params['monthly_tier'] = $this->monthlyTier;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->monthlyTier = '';
            $this->_custom = [];
        }

        return $this->_provider->request('streaming.setSettings', $params);
    }
}