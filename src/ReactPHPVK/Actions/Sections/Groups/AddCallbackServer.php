<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddCallbackServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $url = '';
    private string $title = '';
    private string $secretKey = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddCallbackServer
     */
    public function _setCustom(array $value): AddCallbackServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddCallbackServer
     */
    public function setGroupId(int $value): AddCallbackServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddCallbackServer
     */
    public function setUrl(string $value): AddCallbackServer
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddCallbackServer
     */
    public function setTitle(string $value): AddCallbackServer
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddCallbackServer
     */
    public function setSecretKey(string $value): AddCallbackServer
    {
        $this->secretKey = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['url'] = $this->url;
        $params['title'] = $this->title;
        if ($this->secretKey !== '') $params['secret_key'] = $this->secretKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->url = '';
            $this->title = '';
            $this->secretKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.addCallbackServer', $params);
    }
}