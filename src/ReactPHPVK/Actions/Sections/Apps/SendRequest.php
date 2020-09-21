<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sends a request to another user in an app that uses VK authorization.
 */
class SendRequest
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $text = '';
    private string $type = 'request';
    private string $name = '';
    private string $key = '';
    private bool $separate = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SendRequest
     */
    public function _setCustom(array $value): SendRequest
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * id of the user to send a request
     * 
     * @param int $value
     * @return SendRequest
     */
    public function setUserId(int $value): SendRequest
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * request text
     * 
     * @param string $value
     * @return SendRequest
     */
    public function setText(string $value): SendRequest
    {
        $this->text = $value;
        return $this;
    }

    /**
     * request type. Values: 'invite' – if the request is sent to a user who does not have the app installed,, 'request' – if a user has already installed the app
     * 
     * @param string $value
     * @return SendRequest
     */
    public function setType(string $value): SendRequest
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SendRequest
     */
    public function setName(string $value): SendRequest
    {
        $this->name = $value;
        return $this;
    }

    /**
     * special string key to be sent with the request
     * 
     * @param string $value
     * @return SendRequest
     */
    public function setKey(string $value): SendRequest
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SendRequest
     */
    public function setSeparate(bool $value): SendRequest
    {
        $this->separate = $value;
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
        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->type !== 'request') $params['type'] = $this->type;
        if ($this->name !== '') $params['name'] = $this->name;
        if ($this->key !== '') $params['key'] = $this->key;
        if ($this->separate !== false) $params['separate'] = intval($this->separate);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->text = '';
            $this->type = 'request';
            $this->name = '';
            $this->key = '';
            $this->separate = false;
            $this->_custom = [];
        }

        return $this->_provider->request('apps.sendRequest', $params);
    }
}