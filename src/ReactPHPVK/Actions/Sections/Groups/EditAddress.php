<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class EditAddress
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $addressId = 0;
    private string $title = '';
    private string $address = '';
    private string $additionalAddress = '';
    private int $countryId = 0;
    private int $cityId = 0;
    private int $metroId = 0;
    private float $latitude = 0;
    private float $longitude = 0;
    private string $phone = '';
    private string $workInfoStatus = '';
    private string $timetable = '';
    private bool $isMainAddress = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditAddress
     */
    public function _setCustom(array $value): EditAddress
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditAddress
     */
    public function setGroupId(int $value): EditAddress
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditAddress
     */
    public function setAddressId(int $value): EditAddress
    {
        $this->addressId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditAddress
     */
    public function setTitle(string $value): EditAddress
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditAddress
     */
    public function setAddress(string $value): EditAddress
    {
        $this->address = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditAddress
     */
    public function setAdditionalAddress(string $value): EditAddress
    {
        $this->additionalAddress = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditAddress
     */
    public function setCountryId(int $value): EditAddress
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditAddress
     */
    public function setCityId(int $value): EditAddress
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditAddress
     */
    public function setMetroId(int $value): EditAddress
    {
        $this->metroId = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return EditAddress
     */
    public function setLatitude(float $value): EditAddress
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return EditAddress
     */
    public function setLongitude(float $value): EditAddress
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditAddress
     */
    public function setPhone(string $value): EditAddress
    {
        $this->phone = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditAddress
     */
    public function setWorkInfoStatus(string $value): EditAddress
    {
        $this->workInfoStatus = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditAddress
     */
    public function setTimetable(string $value): EditAddress
    {
        $this->timetable = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return EditAddress
     */
    public function setIsMainAddress(bool $value): EditAddress
    {
        $this->isMainAddress = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['address_id'] = $this->addressId;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->address !== '') $params['address'] = $this->address;
        if ($this->additionalAddress !== '') $params['additional_address'] = $this->additionalAddress;
        if ($this->countryId !== 0) $params['country_id'] = $this->countryId;
        if ($this->cityId !== 0) $params['city_id'] = $this->cityId;
        if ($this->metroId !== 0) $params['metro_id'] = $this->metroId;
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->phone !== '') $params['phone'] = $this->phone;
        if ($this->workInfoStatus !== '') $params['work_info_status'] = $this->workInfoStatus;
        if ($this->timetable !== '') $params['timetable'] = $this->timetable;
        if ($this->isMainAddress !== false) $params['is_main_address'] = intval($this->isMainAddress);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->addressId = 0;
            $this->title = '';
            $this->address = '';
            $this->additionalAddress = '';
            $this->countryId = 0;
            $this->cityId = 0;
            $this->metroId = 0;
            $this->latitude = 0;
            $this->longitude = 0;
            $this->phone = '';
            $this->workInfoStatus = '';
            $this->timetable = '';
            $this->isMainAddress = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.editAddress', $params);
    }
}