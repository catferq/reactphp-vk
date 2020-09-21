<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of the current user's friends whose phone numbers, validated or specified in a profile, are in a given list.
 */
class GetByPhones
{
    private Provider $_provider;
    
    private array $phones = [];
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetByPhones
     */
    public function _setCustom(array $value): GetByPhones
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * List of phone numbers in MSISDN format (maximum 1000). Example: "+79219876543,+79111234567"
     * 
     * @param array $value
     * @return GetByPhones
     */
    public function setPhones(array $value): GetByPhones
    {
        $this->phones = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online, counters'.
     * 
     * @param array $value
     * @return GetByPhones
     */
    public function setFields(array $value): GetByPhones
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->phones !== []) $params['phones'] = implode(',', $this->phones);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->phones = [];
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getByPhones', $params);
    }
}