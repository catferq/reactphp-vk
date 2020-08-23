<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Users
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns detailed information on users.
     * 
     * @param array|null $userIds User IDs or screen names ('screen_name'). By default, current user ID.
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', 'can_invite_to_chats'
     * @param string|null $nameCase Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param array|null $custom
     * @return Promise
     */
    function get(?array $userIds = [], ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('users.get', $sendParams);
    }

    /**
     * Returns a list of IDs of followers of the user in question, sorted by date added, most recent first.
     * 
     * @param int|null $userId User ID.
     * @param int|null $offset Offset needed to return a specific subset of followers.
     * @param int|null $count Number of followers to return.
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online'.
     * @param string|null $nameCase Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param array|null $custom
     * @return Promise
     */
    function getFollowers(?int $userId = 0, ?int $offset = 0, ?int $count = 100, ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('users.getFollowers', $sendParams);
    }

    /**
     * Returns a list of IDs of users and communities followed by the user.
     * 
     * @param int|null $userId User ID.
     * @param bool|null $extended '1' — to return a combined list of users and communities, '0' — to return separate lists of users and communities (default)
     * @param int|null $offset Offset needed to return a specific subset of subscriptions.
     * @param int|null $count Number of users and communities to return.
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getSubscriptions(?int $userId = 0, ?bool $extended = false, ?int $offset = 0, ?int $count = 20, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('users.getSubscriptions', $sendParams);
    }

    /**
     * Reports (submits a complain about) a user.
     * 
     * @param int $userId ID of the user about whom a complaint is being made.
     * @param string $type Type of complaint: 'porn' – pornography, 'spam' – spamming, 'insult' – abusive behavior, 'advertisement' – disruptive advertisements
     * @param string|null $comment Comment describing the complaint.
     * @param array|null $custom
     * @return Promise
     */
    function report(int $userId, string $type, ?string $comment = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['type'] = $type;
        if ($comment !== '' && $comment != null) $sendParams['comment'] = $comment;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('users.report', $sendParams);
    }

    /**
     * Returns a list of users matching the search criteria.
     * 
     * @param string|null $q Search query string (e.g., 'Vasya Babich').
     * @param int|null $sort Sort order: '1' — by date registered, '0' — by rating
     * @param int|null $offset Offset needed to return a specific subset of users.
     * @param int|null $count Number of users to return.
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online',
     * @param int|null $city City ID.
     * @param int|null $country Country ID.
     * @param string|null $hometown City name in a string.
     * @param int|null $universityCountry ID of the country where the user graduated.
     * @param int|null $university ID of the institution of higher education.
     * @param int|null $universityYear Year of graduation from an institution of higher education.
     * @param int|null $universityFaculty Faculty ID.
     * @param int|null $universityChair Chair ID.
     * @param int|null $sex '1' — female, '2' — male, '0' — any (default)
     * @param int|null $status Relationship status: '1' — Not married, '2' — In a relationship, '3' — Engaged, '4' — Married, '5' — It's complicated, '6' — Actively searching, '7' — In love
     * @param int|null $ageFrom Minimum age.
     * @param int|null $ageTo Maximum age.
     * @param int|null $birthDay Day of birth.
     * @param int|null $birthMonth Month of birth.
     * @param int|null $birthYear Year of birth.
     * @param bool|null $online '1' — online only, '0' — all users
     * @param bool|null $hasPhoto '1' — with photo only, '0' — all users
     * @param int|null $schoolCountry ID of the country where users finished school.
     * @param int|null $schoolCity ID of the city where users finished school.
     * @param int|null $schoolClass
     * @param int|null $school ID of the school.
     * @param int|null $schoolYear School graduation year.
     * @param string|null $religion Users' religious affiliation.
     * @param string|null $company Name of the company where users work.
     * @param string|null $position Job position.
     * @param int|null $groupId ID of a community to search in communities.
     * @param array|null $fromList
     * @param array|null $custom
     * @return Promise
     */
    function search(?string $q = '', ?int $sort = 0, ?int $offset = 0, ?int $count = 20, ?array $fields = [], ?int $city = 0, ?int $country = 0, ?string $hometown = '', ?int $universityCountry = 0, ?int $university = 0, ?int $universityYear = 0, ?int $universityFaculty = 0, ?int $universityChair = 0, ?int $sex = 0, ?int $status = 0, ?int $ageFrom = 0, ?int $ageTo = 0, ?int $birthDay = 0, ?int $birthMonth = 0, ?int $birthYear = 0, ?bool $online = false, ?bool $hasPhoto = false, ?int $schoolCountry = 0, ?int $schoolCity = 0, ?int $schoolClass = 0, ?int $school = 0, ?int $schoolYear = 0, ?string $religion = '', ?string $company = '', ?string $position = '', ?int $groupId = 0, ?array $fromList = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($city !== 0 && $city != null) $sendParams['city'] = $city;
        if ($country !== 0 && $country != null) $sendParams['country'] = $country;
        if ($hometown !== '' && $hometown != null) $sendParams['hometown'] = $hometown;
        if ($universityCountry !== 0 && $universityCountry != null) $sendParams['university_country'] = $universityCountry;
        if ($university !== 0 && $university != null) $sendParams['university'] = $university;
        if ($universityYear !== 0 && $universityYear != null) $sendParams['university_year'] = $universityYear;
        if ($universityFaculty !== 0 && $universityFaculty != null) $sendParams['university_faculty'] = $universityFaculty;
        if ($universityChair !== 0 && $universityChair != null) $sendParams['university_chair'] = $universityChair;
        if ($sex !== 0 && $sex != null) $sendParams['sex'] = $sex;
        if ($status !== 0 && $status != null) $sendParams['status'] = $status;
        if ($ageFrom !== 0 && $ageFrom != null) $sendParams['age_from'] = $ageFrom;
        if ($ageTo !== 0 && $ageTo != null) $sendParams['age_to'] = $ageTo;
        if ($birthDay !== 0 && $birthDay != null) $sendParams['birth_day'] = $birthDay;
        if ($birthMonth !== 0 && $birthMonth != null) $sendParams['birth_month'] = $birthMonth;
        if ($birthYear !== 0 && $birthYear != null) $sendParams['birth_year'] = $birthYear;
        if ($online !== false && $online != null) $sendParams['online'] = intval($online);
        if ($hasPhoto !== false && $hasPhoto != null) $sendParams['has_photo'] = intval($hasPhoto);
        if ($schoolCountry !== 0 && $schoolCountry != null) $sendParams['school_country'] = $schoolCountry;
        if ($schoolCity !== 0 && $schoolCity != null) $sendParams['school_city'] = $schoolCity;
        if ($schoolClass !== 0 && $schoolClass != null) $sendParams['school_class'] = $schoolClass;
        if ($school !== 0 && $school != null) $sendParams['school'] = $school;
        if ($schoolYear !== 0 && $schoolYear != null) $sendParams['school_year'] = $schoolYear;
        if ($religion !== '' && $religion != null) $sendParams['religion'] = $religion;
        if ($company !== '' && $company != null) $sendParams['company'] = $company;
        if ($position !== '' && $position != null) $sendParams['position'] = $position;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($fromList !== [] && $fromList != null) $sendParams['from_list'] = implode(',', $fromList);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('users.search', $sendParams);
    }
}