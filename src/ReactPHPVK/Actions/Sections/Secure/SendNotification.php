<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sends notification to the user.
 */
class SendNotification
{
    private Provider $_provider;
    
    private array $userIds = [];
    private int $userId = 0;
    private string $message = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SendNotification
     */
    public function _setCustom(array $value): SendNotification
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return SendNotification
     */
    public function setUserIds(array $value): SendNotification
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SendNotification
     */
    public function setUserId(int $value): SendNotification
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * notification text which should be sent in 'UTF-8' encoding ('254' characters maximum).
     * 
     * @param string $value
     * @return SendNotification
     */
    public function setMessage(string $value): SendNotification
    {
        $this->message = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        $params['message'] = $this->message;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->userId = 0;
            $this->message = '';
            $this->_custom = [];
        }

        return $this->_provider->request('secure.sendNotification', $params);
    }
}