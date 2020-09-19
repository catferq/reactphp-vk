<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Checks the current user's friendship status with other specified users.
 */
class AreFriends
{
    private Provider $_provider;
    
    private array $userIds = [];
    private bool $needSign = false;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AreFriends
     */
    public function _setCustom(array $value): AreFriends
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * IDs of the users whose friendship status to check.
     * 
     * @param array $value
     * @return AreFriends
     */
    public function setUserIds(array $value): AreFriends
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * '1' — to return 'sign' field. 'sign' is md5("{id}_{user_id}_{friends_status}_{application_secret}"), where id is current user ID. This field allows to check that data has not been modified by the client. By default: '0'.
     * 
     * @param bool $value
     * @return AreFriends
     */
    public function setNeedSign(bool $value): AreFriends
    {
        $this->needSign = $value;
        return $this;
    }

    /**
     * Return friend request read_state field
     * 
     * @param bool $value
     * @return AreFriends
     */
    public function setExtended(bool $value): AreFriends
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['user_ids'] = implode(',', $this->userIds);
        if ($this->needSign !== false) $params['need_sign'] = intval($this->needSign);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->needSign = false;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.areFriends', $params);
    }
}