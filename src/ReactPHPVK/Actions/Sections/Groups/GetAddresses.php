<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of community addresses.
 */
class GetAddresses
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private array $addressIds = [];
    private float $latitude = 0;
    private float $longitude = 0;
    private int $offset = 0;
    private int $count = 10;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAddresses
     */
    public function _setCustom(array $value): GetAddresses
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID or screen name of the community.
     * 
     * @param int $value
     * @return GetAddresses
     */
    public function setGroupId(int $value): GetAddresses
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetAddresses
     */
    public function setAddressIds(array $value): GetAddresses
    {
        $this->addressIds = $value;
        return $this;
    }

    /**
     * Latitude of  the user geo position.
     * 
     * @param float $value
     * @return GetAddresses
     */
    public function setLatitude(float $value): GetAddresses
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * Longitude of the user geo position.
     * 
     * @param float $value
     * @return GetAddresses
     */
    public function setLongitude(float $value): GetAddresses
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of community addresses.
     * 
     * @param int $value
     * @return GetAddresses
     */
    public function setOffset(int $value): GetAddresses
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of community addresses to return.
     * 
     * @param int $value
     * @return GetAddresses
     */
    public function setCount(int $value): GetAddresses
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Address fields
     * 
     * @param array $value
     * @return GetAddresses
     */
    public function setFields(array $value): GetAddresses
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->addressIds !== []) $params['address_ids'] = implode(',', $this->addressIds);
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 10) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->addressIds = [];
            $this->latitude = 0;
            $this->longitude = 0;
            $this->offset = 0;
            $this->count = 10;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getAddresses', $params);
    }
}