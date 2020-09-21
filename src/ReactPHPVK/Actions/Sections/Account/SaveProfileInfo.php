<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits current profile info.
 */
class SaveProfileInfo
{
    private Provider $_provider;
    
    private string $firstName = '';
    private string $lastName = '';
    private string $maidenName = '';
    private string $screenName = '';
    private int $cancelRequestId = 0;
    private int $sex = 0;
    private int $relation = 0;
    private int $relationPartnerId = 0;
    private string $bdate = '';
    private int $bdateVisibility = 0;
    private string $homeTown = '';
    private int $countryId = 0;
    private int $cityId = 0;
    private string $status = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SaveProfileInfo
     */
    public function _setCustom(array $value): SaveProfileInfo
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User first name.
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setFirstName(string $value): SaveProfileInfo
    {
        $this->firstName = $value;
        return $this;
    }

    /**
     * User last name.
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setLastName(string $value): SaveProfileInfo
    {
        $this->lastName = $value;
        return $this;
    }

    /**
     * User maiden name (female only)
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setMaidenName(string $value): SaveProfileInfo
    {
        $this->maidenName = $value;
        return $this;
    }

    /**
     * User screen name.
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setScreenName(string $value): SaveProfileInfo
    {
        $this->screenName = $value;
        return $this;
    }

    /**
     * ID of the name change request to be canceled. If this parameter is sent, all the others are ignored.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setCancelRequestId(int $value): SaveProfileInfo
    {
        $this->cancelRequestId = $value;
        return $this;
    }

    /**
     * User sex. Possible values: , * '1' – female,, * '2' – male.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setSex(int $value): SaveProfileInfo
    {
        $this->sex = $value;
        return $this;
    }

    /**
     * User relationship status. Possible values: , * '1' – single,, * '2' – in a relationship,, * '3' – engaged,, * '4' – married,, * '5' – it's complicated,, * '6' – actively searching,, * '7' – in love,, * '0' – not specified.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setRelation(int $value): SaveProfileInfo
    {
        $this->relation = $value;
        return $this;
    }

    /**
     * ID of the relationship partner.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setRelationPartnerId(int $value): SaveProfileInfo
    {
        $this->relationPartnerId = $value;
        return $this;
    }

    /**
     * User birth date, format: DD.MM.YYYY.
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setBdate(string $value): SaveProfileInfo
    {
        $this->bdate = $value;
        return $this;
    }

    /**
     * Birth date visibility. Returned values: , * '1' – show birth date,, * '2' – show only month and day,, * '0' – hide birth date.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setBdateVisibility(int $value): SaveProfileInfo
    {
        $this->bdateVisibility = $value;
        return $this;
    }

    /**
     * User home town.
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setHomeTown(string $value): SaveProfileInfo
    {
        $this->homeTown = $value;
        return $this;
    }

    /**
     * User country.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setCountryId(int $value): SaveProfileInfo
    {
        $this->countryId = $value;
        return $this;
    }

    /**
     * User city.
     * 
     * @param int $value
     * @return SaveProfileInfo
     */
    public function setCityId(int $value): SaveProfileInfo
    {
        $this->cityId = $value;
        return $this;
    }

    /**
     * Status text.
     * 
     * @param string $value
     * @return SaveProfileInfo
     */
    public function setStatus(string $value): SaveProfileInfo
    {
        $this->status = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->firstName !== '') $params['first_name'] = $this->firstName;
        if ($this->lastName !== '') $params['last_name'] = $this->lastName;
        if ($this->maidenName !== '') $params['maiden_name'] = $this->maidenName;
        if ($this->screenName !== '') $params['screen_name'] = $this->screenName;
        if ($this->cancelRequestId !== 0) $params['cancel_request_id'] = $this->cancelRequestId;
        if ($this->sex !== 0) $params['sex'] = $this->sex;
        if ($this->relation !== 0) $params['relation'] = $this->relation;
        if ($this->relationPartnerId !== 0) $params['relation_partner_id'] = $this->relationPartnerId;
        if ($this->bdate !== '') $params['bdate'] = $this->bdate;
        if ($this->bdateVisibility !== 0) $params['bdate_visibility'] = $this->bdateVisibility;
        if ($this->homeTown !== '') $params['home_town'] = $this->homeTown;
        if ($this->countryId !== 0) $params['country_id'] = $this->countryId;
        if ($this->cityId !== 0) $params['city_id'] = $this->cityId;
        if ($this->status !== '') $params['status'] = $this->status;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->firstName = '';
            $this->lastName = '';
            $this->maidenName = '';
            $this->screenName = '';
            $this->cancelRequestId = 0;
            $this->sex = 0;
            $this->relation = 0;
            $this->relationPartnerId = 0;
            $this->bdate = '';
            $this->bdateVisibility = 0;
            $this->homeTown = '';
            $this->countryId = 0;
            $this->cityId = 0;
            $this->status = '';
            $this->_custom = [];
        }

        return $this->_provider->request('account.saveProfileInfo', $params);
    }
}