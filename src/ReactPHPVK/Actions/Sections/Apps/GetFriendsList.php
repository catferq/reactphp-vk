<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates friends list for requests and invites in current app.
 */
class GetFriendsList
{
    private Provider $_provider;
    
    private bool $extended = false;
    private int $count = 20;
    private int $offset = 0;
    private string $type = 'invite';
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetFriendsList
     */
    public function _setCustom(array $value): GetFriendsList
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetFriendsList
     */
    public function setExtended(bool $value): GetFriendsList
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * List size.
     * 
     * @param int $value
     * @return GetFriendsList
     */
    public function setCount(int $value): GetFriendsList
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetFriendsList
     */
    public function setOffset(int $value): GetFriendsList
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * List type. Possible values: * 'invite' — available for invites (don't play the game),, * 'request' — available for request (play the game). By default: 'invite'.
     * 
     * @param string $value
     * @return GetFriendsList
     */
    public function setType(string $value): GetFriendsList
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Additional profile fields, see [vk.com/dev/fields|description].
     * 
     * @param array $value
     * @return GetFriendsList
     */
    public function setFields(array $value): GetFriendsList
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->type !== 'invite') $params['type'] = $this->type;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->extended = false;
            $this->count = 20;
            $this->offset = 0;
            $this->type = 'invite';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('apps.getFriendsList', $params);
    }
}