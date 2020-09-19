<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns applications data.
 */
class Get
{
    private Provider $_provider;
    
    private int $appId = 0;
    private array $appIds = [];
    private string $platform = 'web';
    private bool $extended = false;
    private bool $returnFriends = false;
    private array $fields = [];
    private string $nameCase = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Application ID
     * 
     * @param int $value
     * @return Get
     */
    public function setAppId(int $value): Get
    {
        $this->appId = $value;
        return $this;
    }

    /**
     * List of application ID
     * 
     * @param array $value
     * @return Get
     */
    public function setAppIds(array $value): Get
    {
        $this->appIds = $value;
        return $this;
    }

    /**
     * platform. Possible values: *'ios' — iOS,, *'android' — Android,, *'winphone' — Windows Phone,, *'web' — приложения на vk.com. By default: 'web'.
     * 
     * @param string $value
     * @return Get
     */
    public function setPlatform(string $value): Get
    {
        $this->platform = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Get
     */
    public function setExtended(bool $value): Get
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Get
     */
    public function setReturnFriends(bool $value): Get
    {
        $this->returnFriends = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', (only if return_friends - 1)
     * 
     * @param array $value
     * @return Get
     */
    public function setFields(array $value): Get
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: 'nom' — nominative (default),, 'gen' — genitive,, 'dat' — dative,, 'acc' — accusative,, 'ins' — instrumental,, 'abl' — prepositional. (only if 'return_friends' = '1')
     * 
     * @param string $value
     * @return Get
     */
    public function setNameCase(string $value): Get
    {
        $this->nameCase = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->appId !== 0) $params['app_id'] = $this->appId;
        if ($this->appIds !== []) $params['app_ids'] = implode(',', $this->appIds);
        if ($this->platform !== 'web') $params['platform'] = $this->platform;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->returnFriends !== false) $params['return_friends'] = intval($this->returnFriends);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->appId = 0;
            $this->appIds = [];
            $this->platform = 'web';
            $this->extended = false;
            $this->returnFriends = false;
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('apps.get', $params);
    }
}