<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sends 'SMS' notification to a user's mobile device.
 */
class SendSMSNotification
{
    private Provider $_provider;
    
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
     * @return SendSMSNotification
     */
    public function _setCustom(array $value): SendSMSNotification
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user to whom SMS notification is sent. The user shall allow the application to send him/her notifications (, +1).
     * 
     * @param int $value
     * @return SendSMSNotification
     */
    public function setUserId(int $value): SendSMSNotification
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * 'SMS' text to be sent in 'UTF-8' encoding. Only Latin letters and numbers are allowed. Maximum size is '160' characters.
     * 
     * @param string $value
     * @return SendSMSNotification
     */
    public function setMessage(string $value): SendSMSNotification
    {
        $this->message = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        $params['message'] = $this->message;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->message = '';
            $this->_custom = [];
        }

        return $this->_provider->request('secure.sendSMSNotification', $params);
    }
}