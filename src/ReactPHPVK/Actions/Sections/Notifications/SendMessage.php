<?php

namespace ReactPHPVK\Actions\Sections\Notifications;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class SendMessage
{
    private Provider $_provider;
    
    private array $userIds = [];
    private string $message = '';
    private string $fragment = '';
    private int $groupId = 0;
    private int $randomId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SendMessage
     */
    public function _setCustom(array $value): SendMessage
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return SendMessage
     */
    public function setUserIds(array $value): SendMessage
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SendMessage
     */
    public function setMessage(string $value): SendMessage
    {
        $this->message = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SendMessage
     */
    public function setFragment(string $value): SendMessage
    {
        $this->fragment = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SendMessage
     */
    public function setGroupId(int $value): SendMessage
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SendMessage
     */
    public function setRandomId(int $value): SendMessage
    {
        $this->randomId = $value;
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
        $params['message'] = $this->message;
        if ($this->fragment !== '') $params['fragment'] = $this->fragment;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        $params['random_id'] = $this->randomId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->message = '';
            $this->fragment = '';
            $this->groupId = 0;
            $this->randomId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('notifications.sendMessage', $params);
    }
}