<?php

namespace ReactPHPVK\Actions\Sections\Users;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of IDs of users and communities followed by the user.
 */
class GetSubscriptions
{
    private Provider $_provider;
    
    private int $userId = 0;
    private bool $extended = false;
    private int $offset = 0;
    private int $count = 20;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetSubscriptions
     */
    public function _setCustom(array $value): GetSubscriptions
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return GetSubscriptions
     */
    public function setUserId(int $value): GetSubscriptions
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * '1' — to return a combined list of users and communities, '0' — to return separate lists of users and communities (default)
     * 
     * @param bool $value
     * @return GetSubscriptions
     */
    public function setExtended(bool $value): GetSubscriptions
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of subscriptions.
     * 
     * @param int $value
     * @return GetSubscriptions
     */
    public function setOffset(int $value): GetSubscriptions
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of users and communities to return.
     * 
     * @param int $value
     * @return GetSubscriptions
     */
    public function setCount(int $value): GetSubscriptions
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetSubscriptions
     */
    public function setFields(array $value): GetSubscriptions
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->extended = false;
            $this->offset = 0;
            $this->count = 20;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('users.getSubscriptions', $params);
    }
}