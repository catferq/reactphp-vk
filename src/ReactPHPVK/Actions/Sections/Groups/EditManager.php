<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to add, remove or edit the community manager.
 */
class EditManager
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $userId = 0;
    private string $role = '';
    private bool $isContact = false;
    private string $contactPosition = '';
    private string $contactPhone = '';
    private string $contactEmail = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditManager
     */
    public function _setCustom(array $value): EditManager
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return EditManager
     */
    public function setGroupId(int $value): EditManager
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return EditManager
     */
    public function setUserId(int $value): EditManager
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Manager role. Possible values: *'moderator',, *'editor',, *'administrator',, *'advertiser'.
     * 
     * @param string $value
     * @return EditManager
     */
    public function setRole(string $value): EditManager
    {
        $this->role = $value;
        return $this;
    }

    /**
     * '1' — to show the manager in Contacts block of the community.
     * 
     * @param bool $value
     * @return EditManager
     */
    public function setIsContact(bool $value): EditManager
    {
        $this->isContact = $value;
        return $this;
    }

    /**
     * Position to show in Contacts block.
     * 
     * @param string $value
     * @return EditManager
     */
    public function setContactPosition(string $value): EditManager
    {
        $this->contactPosition = $value;
        return $this;
    }

    /**
     * Contact phone.
     * 
     * @param string $value
     * @return EditManager
     */
    public function setContactPhone(string $value): EditManager
    {
        $this->contactPhone = $value;
        return $this;
    }

    /**
     * Contact e-mail.
     * 
     * @param string $value
     * @return EditManager
     */
    public function setContactEmail(string $value): EditManager
    {
        $this->contactEmail = $value;
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
        $params['user_id'] = $this->userId;
        if ($this->role !== '') $params['role'] = $this->role;
        if ($this->isContact !== false) $params['is_contact'] = intval($this->isContact);
        if ($this->contactPosition !== '') $params['contact_position'] = $this->contactPosition;
        if ($this->contactPhone !== '') $params['contact_phone'] = $this->contactPhone;
        if ($this->contactEmail !== '') $params['contact_email'] = $this->contactEmail;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->userId = 0;
            $this->role = '';
            $this->isContact = false;
            $this->contactPosition = '';
            $this->contactPhone = '';
            $this->contactEmail = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.editManager', $params);
    }
}