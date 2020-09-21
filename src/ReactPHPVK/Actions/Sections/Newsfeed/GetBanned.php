<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of users and communities banned from the current user's newsfeed.
 */
class GetBanned
{
    private Provider $_provider;
    
    private bool $extended = false;
    private array $fields = [];
    private string $nameCase = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetBanned
     */
    public function _setCustom(array $value): GetBanned
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * '1' — return extra information about users and communities
     * 
     * @param bool $value
     * @return GetBanned
     */
    public function setExtended(bool $value): GetBanned
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetBanned
     */
    public function setFields(array $value): GetBanned
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * 
     * @param string $value
     * @return GetBanned
     */
    public function setNameCase(string $value): GetBanned
    {
        $this->nameCase = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->extended = false;
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.getBanned', $params);
    }
}