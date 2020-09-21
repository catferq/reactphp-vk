<?php

namespace ReactPHPVK\Actions\Sections\Leads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Checks if the user can start the lead.
 */
class CheckUser
{
    private Provider $_provider;
    
    private int $leadId = 0;
    private int $testResult = 0;
    private bool $testMode = false;
    private bool $autoStart = false;
    private int $age = 0;
    private string $country = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CheckUser
     */
    public function _setCustom(array $value): CheckUser
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Lead ID.
     * 
     * @param int $value
     * @return CheckUser
     */
    public function setLeadId(int $value): CheckUser
    {
        $this->leadId = $value;
        return $this;
    }

    /**
     * Value to be return in 'result' field when test mode is used.
     * 
     * @param int $value
     * @return CheckUser
     */
    public function setTestResult(int $value): CheckUser
    {
        $this->testResult = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return CheckUser
     */
    public function setTestMode(bool $value): CheckUser
    {
        $this->testMode = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return CheckUser
     */
    public function setAutoStart(bool $value): CheckUser
    {
        $this->autoStart = $value;
        return $this;
    }

    /**
     * User age.
     * 
     * @param int $value
     * @return CheckUser
     */
    public function setAge(int $value): CheckUser
    {
        $this->age = $value;
        return $this;
    }

    /**
     * User country code.
     * 
     * @param string $value
     * @return CheckUser
     */
    public function setCountry(string $value): CheckUser
    {
        $this->country = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['lead_id'] = $this->leadId;
        if ($this->testResult !== 0) $params['test_result'] = $this->testResult;
        if ($this->testMode !== false) $params['test_mode'] = intval($this->testMode);
        if ($this->autoStart !== false) $params['auto_start'] = intval($this->autoStart);
        if ($this->age !== 0) $params['age'] = $this->age;
        if ($this->country !== '') $params['country'] = $this->country;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->leadId = 0;
            $this->testResult = 0;
            $this->testMode = false;
            $this->autoStart = false;
            $this->age = 0;
            $this->country = '';
            $this->_custom = [];
        }

        return $this->_provider->request('leads.checkUser', $params);
    }
}