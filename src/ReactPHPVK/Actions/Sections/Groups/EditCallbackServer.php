<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class EditCallbackServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $serverId = 0;
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
     * @return EditCallbackServer
     */
    public function _setCustom(array $value): EditCallbackServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditCallbackServer
     */
    public function setGroupId(int $value): EditCallbackServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditCallbackServer
     */
    public function setServerId(int $value): EditCallbackServer
    {
        $this->serverId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditCallbackServer
     */
    public function setUrl(string $value): EditCallbackServer
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditCallbackServer
     */
    public function setTitle(string $value): EditCallbackServer
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditCallbackServer
     */
    public function setSecretKey(string $value): EditCallbackServer
    {
        $this->secretKey = $value;
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
        $params['server_id'] = $this->serverId;
        $params['url'] = $this->url;
        $params['title'] = $this->title;
        if ($this->secretKey !== '') $params['secret_key'] = $this->secretKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->serverId = 0;
            $this->url = '';
            $this->title = '';
            $this->secretKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.editCallbackServer', $params);
    }
}