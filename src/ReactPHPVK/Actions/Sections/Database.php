<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Database
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns list of chairs on a specified faculty.
     * 
     * @param int $facultyId id of the faculty to get chairs from
     * @param int|null $offset offset required to get a certain subset of chairs
     * @param int|null $count amount of chairs to get
     * @param array|null $custom
     * @return Promise
     */
    function getChairs(int $facultyId, ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['faculty_id'] = $facultyId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getChairs', $sendParams);
    }

    /**
     * Returns a list of cities.
     * 
     * @param int $countryId Country ID.
     * @param int|null $regionId Region ID.
     * @param string|null $q Search query.
     * @param bool|null $needAll '1' — to return all cities in the country, '0' — to return major cities in the country (default),
     * @param int|null $offset Offset needed to return a specific subset of cities.
     * @param int|null $count Number of cities to return.
     * @param array|null $custom
     * @return Promise
     */
    function getCities(int $countryId, ?int $regionId = 0, ?string $q = '', ?bool $needAll = false, ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['country_id'] = $countryId;
        if ($regionId !== 0 && $regionId != null) $sendParams['region_id'] = $regionId;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($needAll !== false && $needAll != null) $sendParams['need_all'] = intval($needAll);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getCities', $sendParams);
    }

    /**
     * Returns information about cities by their IDs.
     * 
     * @param array|null $cityIds City IDs.
     * @param array|null $custom
     * @return Promise
     */
    function getCitiesById(?array $cityIds = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($cityIds !== [] && $cityIds != null) $sendParams['city_ids'] = implode(',', $cityIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getCitiesById', $sendParams);
    }

    /**
     * Returns a list of countries.
     * 
     * @param bool|null $needAll '1' — to return a full list of all countries, '0' — to return a list of countries near the current user's country (default).
     * @param string|null $code Country codes in [vk.com/dev/country_codes|ISO 3166-1 alpha-2] standard.
     * @param int|null $offset Offset needed to return a specific subset of countries.
     * @param int|null $count Number of countries to return.
     * @param array|null $custom
     * @return Promise
     */
    function getCountries(?bool $needAll = false, ?string $code = '', ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        if ($needAll !== false && $needAll != null) $sendParams['need_all'] = intval($needAll);
        if ($code !== '' && $code != null) $sendParams['code'] = $code;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getCountries', $sendParams);
    }

    /**
     * Returns information about countries by their IDs.
     * 
     * @param array|null $countryIds Country IDs.
     * @param array|null $custom
     * @return Promise
     */
    function getCountriesById(?array $countryIds = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($countryIds !== [] && $countryIds != null) $sendParams['country_ids'] = implode(',', $countryIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getCountriesById', $sendParams);
    }

    /**
     * Returns a list of faculties (i.e., university departments).
     * 
     * @param int $universityId University ID.
     * @param int|null $offset Offset needed to return a specific subset of faculties.
     * @param int|null $count Number of faculties to return.
     * @param array|null $custom
     * @return Promise
     */
    function getFaculties(int $universityId, ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['university_id'] = $universityId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getFaculties', $sendParams);
    }

    /**
     * Get metro stations by city
     * 
     * @param int $cityId
     * @param int|null $offset
     * @param int|null $count
     * @param bool|null $extended
     * @param array|null $custom
     * @return Promise
     */
    function getMetroStations(int $cityId, ?int $offset = 0, ?int $count = 100, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['city_id'] = $cityId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getMetroStations', $sendParams);
    }

    /**
     * Get metro station by his id
     * 
     * @param array|null $stationIds
     * @param array|null $custom
     * @return Promise
     */
    function getMetroStationsById(?array $stationIds = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($stationIds !== [] && $stationIds != null) $sendParams['station_ids'] = implode(',', $stationIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getMetroStationsById', $sendParams);
    }

    /**
     * Returns a list of regions.
     * 
     * @param int $countryId Country ID, received in [vk.com/dev/database.getCountries|database.getCountries] method.
     * @param string|null $q Search query.
     * @param int|null $offset Offset needed to return specific subset of regions.
     * @param int|null $count Number of regions to return.
     * @param array|null $custom
     * @return Promise
     */
    function getRegions(int $countryId, ?string $q = '', ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['country_id'] = $countryId;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getRegions', $sendParams);
    }

    /**
     * Returns a list of school classes specified for the country.
     * 
     * @param int|null $countryId Country ID.
     * @param array|null $custom
     * @return Promise
     */
    function getSchoolClasses(?int $countryId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($countryId !== 0 && $countryId != null) $sendParams['country_id'] = $countryId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getSchoolClasses', $sendParams);
    }

    /**
     * Returns a list of schools.
     * 
     * @param int $cityId City ID.
     * @param string|null $q Search query.
     * @param int|null $offset Offset needed to return a specific subset of schools.
     * @param int|null $count Number of schools to return.
     * @param array|null $custom
     * @return Promise
     */
    function getSchools(int $cityId, ?string $q = '', ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['city_id'] = $cityId;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getSchools', $sendParams);
    }

    /**
     * Returns a list of higher education institutions.
     * 
     * @param string|null $q Search query.
     * @param int|null $countryId Country ID.
     * @param int|null $cityId City ID.
     * @param int|null $offset Offset needed to return a specific subset of universities.
     * @param int|null $count Number of universities to return.
     * @param array|null $custom
     * @return Promise
     */
    function getUniversities(?string $q = '', ?int $countryId = 0, ?int $cityId = 0, ?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($countryId !== 0 && $countryId != null) $sendParams['country_id'] = $countryId;
        if ($cityId !== 0 && $cityId != null) $sendParams['city_id'] = $cityId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('database.getUniversities', $sendParams);
    }
}