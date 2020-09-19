<?php

namespace ReactPHPVK\Actions\Sections\Users;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of users matching the search criteria.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private int $sort = 0;
    private int $offset = 0;
    private int $count = 20;
    private array $fields = [];
    private int $city = 0;
    private int $country = 0;
    private string $hometown = '';
    private int $universityCountry = 0;
    private int $university = 0;
    private int $universityYear = 0;
    private int $universityFaculty = 0;
    private int $universityChair = 0;
    private int $sex = 0;
    private int $status = 0;
    private int $ageFrom = 0;
    private int $ageTo = 0;
    private int $birthDay = 0;
    private int $birthMonth = 0;
    private int $birthYear = 0;
    private bool $online = false;
    private bool $hasPhoto = false;
    private int $schoolCountry = 0;
    private int $schoolCity = 0;
    private int $schoolClass = 0;
    private int $school = 0;
    private int $schoolYear = 0;
    private string $religion = '';
    private string $company = '';
    private string $position = '';
    private int $groupId = 0;
    private array $fromList = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Search
     */
    public function _setCustom(array $value): Search
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query string (e.g., 'Vasya Babich').
     * 
     * @param string $value
     * @return Search
     */
    public function setQ(string $value): Search
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Sort order: '1' — by date registered, '0' — by rating
     * 
     * @param int $value
     * @return Search
     */
    public function setSort(int $value): Search
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of users.
     * 
     * @param int $value
     * @return Search
     */
    public function setOffset(int $value): Search
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of users to return.
     * 
     * @param int $value
     * @return Search
     */
    public function setCount(int $value): Search
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online',
     * 
     * @param array $value
     * @return Search
     */
    public function setFields(array $value): Search
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * City ID.
     * 
     * @param int $value
     * @return Search
     */
    public function setCity(int $value): Search
    {
        $this->city = $value;
        return $this;
    }

    /**
     * Country ID.
     * 
     * @param int $value
     * @return Search
     */
    public function setCountry(int $value): Search
    {
        $this->country = $value;
        return $this;
    }

    /**
     * City name in a string.
     * 
     * @param string $value
     * @return Search
     */
    public function setHometown(string $value): Search
    {
        $this->hometown = $value;
        return $this;
    }

    /**
     * ID of the country where the user graduated.
     * 
     * @param int $value
     * @return Search
     */
    public function setUniversityCountry(int $value): Search
    {
        $this->universityCountry = $value;
        return $this;
    }

    /**
     * ID of the institution of higher education.
     * 
     * @param int $value
     * @return Search
     */
    public function setUniversity(int $value): Search
    {
        $this->university = $value;
        return $this;
    }

    /**
     * Year of graduation from an institution of higher education.
     * 
     * @param int $value
     * @return Search
     */
    public function setUniversityYear(int $value): Search
    {
        $this->universityYear = $value;
        return $this;
    }

    /**
     * Faculty ID.
     * 
     * @param int $value
     * @return Search
     */
    public function setUniversityFaculty(int $value): Search
    {
        $this->universityFaculty = $value;
        return $this;
    }

    /**
     * Chair ID.
     * 
     * @param int $value
     * @return Search
     */
    public function setUniversityChair(int $value): Search
    {
        $this->universityChair = $value;
        return $this;
    }

    /**
     * '1' — female, '2' — male, '0' — any (default)
     * 
     * @param int $value
     * @return Search
     */
    public function setSex(int $value): Search
    {
        $this->sex = $value;
        return $this;
    }

    /**
     * Relationship status: '1' — Not married, '2' — In a relationship, '3' — Engaged, '4' — Married, '5' — It's complicated, '6' — Actively searching, '7' — In love
     * 
     * @param int $value
     * @return Search
     */
    public function setStatus(int $value): Search
    {
        $this->status = $value;
        return $this;
    }

    /**
     * Minimum age.
     * 
     * @param int $value
     * @return Search
     */
    public function setAgeFrom(int $value): Search
    {
        $this->ageFrom = $value;
        return $this;
    }

    /**
     * Maximum age.
     * 
     * @param int $value
     * @return Search
     */
    public function setAgeTo(int $value): Search
    {
        $this->ageTo = $value;
        return $this;
    }

    /**
     * Day of birth.
     * 
     * @param int $value
     * @return Search
     */
    public function setBirthDay(int $value): Search
    {
        $this->birthDay = $value;
        return $this;
    }

    /**
     * Month of birth.
     * 
     * @param int $value
     * @return Search
     */
    public function setBirthMonth(int $value): Search
    {
        $this->birthMonth = $value;
        return $this;
    }

    /**
     * Year of birth.
     * 
     * @param int $value
     * @return Search
     */
    public function setBirthYear(int $value): Search
    {
        $this->birthYear = $value;
        return $this;
    }

    /**
     * '1' — online only, '0' — all users
     * 
     * @param bool $value
     * @return Search
     */
    public function setOnline(bool $value): Search
    {
        $this->online = $value;
        return $this;
    }

    /**
     * '1' — with photo only, '0' — all users
     * 
     * @param bool $value
     * @return Search
     */
    public function setHasPhoto(bool $value): Search
    {
        $this->hasPhoto = $value;
        return $this;
    }

    /**
     * ID of the country where users finished school.
     * 
     * @param int $value
     * @return Search
     */
    public function setSchoolCountry(int $value): Search
    {
        $this->schoolCountry = $value;
        return $this;
    }

    /**
     * ID of the city where users finished school.
     * 
     * @param int $value
     * @return Search
     */
    public function setSchoolCity(int $value): Search
    {
        $this->schoolCity = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Search
     */
    public function setSchoolClass(int $value): Search
    {
        $this->schoolClass = $value;
        return $this;
    }

    /**
     * ID of the school.
     * 
     * @param int $value
     * @return Search
     */
    public function setSchool(int $value): Search
    {
        $this->school = $value;
        return $this;
    }

    /**
     * School graduation year.
     * 
     * @param int $value
     * @return Search
     */
    public function setSchoolYear(int $value): Search
    {
        $this->schoolYear = $value;
        return $this;
    }

    /**
     * Users' religious affiliation.
     * 
     * @param string $value
     * @return Search
     */
    public function setReligion(string $value): Search
    {
        $this->religion = $value;
        return $this;
    }

    /**
     * Name of the company where users work.
     * 
     * @param string $value
     * @return Search
     */
    public function setCompany(string $value): Search
    {
        $this->company = $value;
        return $this;
    }

    /**
     * Job position.
     * 
     * @param string $value
     * @return Search
     */
    public function setPosition(string $value): Search
    {
        $this->position = $value;
        return $this;
    }

    /**
     * ID of a community to search in communities.
     * 
     * @param int $value
     * @return Search
     */
    public function setGroupId(int $value): Search
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Search
     */
    public function setFromList(array $value): Search
    {
        $this->fromList = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->sort !== 0) $params['sort'] = $this->sort;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->city !== 0) $params['city'] = $this->city;
        if ($this->country !== 0) $params['country'] = $this->country;
        if ($this->hometown !== '') $params['hometown'] = $this->hometown;
        if ($this->universityCountry !== 0) $params['university_country'] = $this->universityCountry;
        if ($this->university !== 0) $params['university'] = $this->university;
        if ($this->universityYear !== 0) $params['university_year'] = $this->universityYear;
        if ($this->universityFaculty !== 0) $params['university_faculty'] = $this->universityFaculty;
        if ($this->universityChair !== 0) $params['university_chair'] = $this->universityChair;
        if ($this->sex !== 0) $params['sex'] = $this->sex;
        if ($this->status !== 0) $params['status'] = $this->status;
        if ($this->ageFrom !== 0) $params['age_from'] = $this->ageFrom;
        if ($this->ageTo !== 0) $params['age_to'] = $this->ageTo;
        if ($this->birthDay !== 0) $params['birth_day'] = $this->birthDay;
        if ($this->birthMonth !== 0) $params['birth_month'] = $this->birthMonth;
        if ($this->birthYear !== 0) $params['birth_year'] = $this->birthYear;
        if ($this->online !== false) $params['online'] = intval($this->online);
        if ($this->hasPhoto !== false) $params['has_photo'] = intval($this->hasPhoto);
        if ($this->schoolCountry !== 0) $params['school_country'] = $this->schoolCountry;
        if ($this->schoolCity !== 0) $params['school_city'] = $this->schoolCity;
        if ($this->schoolClass !== 0) $params['school_class'] = $this->schoolClass;
        if ($this->school !== 0) $params['school'] = $this->school;
        if ($this->schoolYear !== 0) $params['school_year'] = $this->schoolYear;
        if ($this->religion !== '') $params['religion'] = $this->religion;
        if ($this->company !== '') $params['company'] = $this->company;
        if ($this->position !== '') $params['position'] = $this->position;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->fromList !== []) $params['from_list'] = implode(',', $this->fromList);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->sort = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->fields = [];
            $this->city = 0;
            $this->country = 0;
            $this->hometown = '';
            $this->universityCountry = 0;
            $this->university = 0;
            $this->universityYear = 0;
            $this->universityFaculty = 0;
            $this->universityChair = 0;
            $this->sex = 0;
            $this->status = 0;
            $this->ageFrom = 0;
            $this->ageTo = 0;
            $this->birthDay = 0;
            $this->birthMonth = 0;
            $this->birthYear = 0;
            $this->online = false;
            $this->hasPhoto = false;
            $this->schoolCountry = 0;
            $this->schoolCity = 0;
            $this->schoolClass = 0;
            $this->school = 0;
            $this->schoolYear = 0;
            $this->religion = '';
            $this->company = '';
            $this->position = '';
            $this->groupId = 0;
            $this->fromList = [];
            $this->_custom = [];
        }

        return $this->_provider->request('users.search', $params);
    }
}