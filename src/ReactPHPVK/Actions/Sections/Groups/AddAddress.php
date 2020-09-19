<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddAddress
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $title = '';
    private string $address = '';
    private string $additionalAddress = '';
    private int $countryId = 0;
    private int $cityId = 0;
    private int $metroId = 0;
    private float $latitude = 0;
    private float $longitude = 0;
    private string $phone = '';
    private string $workInfoStatus = 'no_information';
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
     * @return AddAddress
     */
    public function _setCustom(array $value): AddAddress
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddAddress
     */
    public function setGroupId(int $value): AddAddress
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddAddress
     */
    public function setTitle(string $value): AddAddress
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddAddress
     */
    public function setAddress(string $value): AddAddress
    {
        $this->address = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddAddress
     */
    public function setAdditionalAddress(string $value): AddAddress
    {
        $this->additionalAddress = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddAddress
     */
    public function setCountryId(int $value): AddAddress
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddAddress
     */
    public function setCityId(int $value): AddAddress
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddAddress
     */
    public function setMetroId(int $value): AddAddress
    {
        $this->metroId = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return AddAddress
     */
    public function setLatitude(float $value): AddAddress
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return AddAddress
     */
    public function setLongitude(float $value): AddAddress
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddAddress
     */
    public function setPhone(string $value): AddAddress
    {
        $this->phone = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddAddress
     */
    public function setWorkInfoStatus(string $value): AddAddress
    {
        $this->workInfoStatus = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddAddress
     */
    public function setTimetable(string $value): AddAddress
    {
        $this->timetable = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return AddAddress
     */
    public function setIsMainAddress(bool $value): AddAddress
    {
        $this->isMainAddress = $value;
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
        $params['title'] = $this->title;
        $params['address'] = $this->address;
        if ($this->additionalAddress !== '') $params['additional_address'] = $this->additionalAddress;
        $params['country_id'] = $this->countryId;
        $params['city_id'] = $this->cityId;
        if ($this->metroId !== 0) $params['metro_id'] = $this->metroId;
        $params['latitude'] = $this->latitude;
        $params['longitude'] = $this->longitude;
        if ($this->phone !== '') $params['phone'] = $this->phone;
        if ($this->workInfoStatus !== 'no_information') $params['work_info_status'] = $this->workInfoStatus;
        if ($this->timetable !== '') $params['timetable'] = $this->timetable;
        if ($this->isMainAddress !== false) $params['is_main_address'] = intval($this->isMainAddress);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->title = '';
            $this->address = '';
            $this->additionalAddress = '';
            $this->countryId = 0;
            $this->cityId = 0;
            $this->metroId = 0;
            $this->latitude = 0;
            $this->longitude = 0;
            $this->phone = '';
            $this->workInfoStatus = 'no_information';
            $this->timetable = '';
            $this->isMainAddress = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.addAddress', $params);
    }
}