<?php

namespace ReactPHPVK\Actions\Sections\Leads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates new session for the user passing the offer.
 */
class Start
{
    private Provider $_provider;
    
    private int $leadId = 0;
    private string $secret = '';
    private int $uid = 0;
    private int $aid = 0;
    private bool $testMode = false;
    private bool $force = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Start
     */
    public function _setCustom(array $value): Start
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Lead ID.
     * 
     * @param int $value
     * @return Start
     */
    public function setLeadId(int $value): Start
    {
        $this->leadId = $value;
        return $this;
    }

    /**
     * Secret key from the lead testing interface.
     * 
     * @param string $value
     * @return Start
     */
    public function setSecret(string $value): Start
    {
        $this->secret = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Start
     */
    public function setUid(int $value): Start
    {
        $this->uid = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Start
     */
    public function setAid(int $value): Start
    {
        $this->aid = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Start
     */
    public function setTestMode(bool $value): Start
    {
        $this->testMode = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Start
     */
    public function setForce(bool $value): Start
    {
        $this->force = $value;
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
        $params['secret'] = $this->secret;
        if ($this->uid !== 0) $params['uid'] = $this->uid;
        if ($this->aid !== 0) $params['aid'] = $this->aid;
        if ($this->testMode !== false) $params['test_mode'] = intval($this->testMode);
        if ($this->force !== false) $params['force'] = intval($this->force);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->leadId = 0;
            $this->secret = '';
            $this->uid = 0;
            $this->aid = 0;
            $this->testMode = false;
            $this->force = false;
            $this->_custom = [];
        }

        return $this->_provider->request('leads.start', $params);
    }
}