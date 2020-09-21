<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds user activity information to an application
 */
class AddAppEvent
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $activityId = 0;
    private int $value = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddAppEvent
     */
    public function _setCustom(array $value): AddAppEvent
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of a user to save the data
     * 
     * @param int $value
     * @return AddAppEvent
     */
    public function setUserId(int $value): AddAppEvent
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * there are 2 default activities: , * 1 – level. Works similar to ,, * 2 – points, saves points amount, Any other value is for saving completed missions
     * 
     * @param int $value
     * @return AddAppEvent
     */
    public function setActivityId(int $value): AddAppEvent
    {
        $this->activityId = $value;
        return $this;
    }

    /**
     * depends on activity_id: * 1 – number, current level number,, * 2 – number, current user's points amount, , Any other value is ignored
     * 
     * @param int $value
     * @return AddAppEvent
     */
    public function setValue(int $value): AddAppEvent
    {
        $this->value = $value;
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
        $params['activity_id'] = $this->activityId;
        if ($this->value !== 0) $params['value'] = $this->value;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->activityId = 0;
            $this->value = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('secure.addAppEvent', $params);
    }
}