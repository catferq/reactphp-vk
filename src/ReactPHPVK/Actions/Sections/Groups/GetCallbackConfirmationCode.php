<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns Callback API confirmation code for the community.
 */
class GetCallbackConfirmationCode
{
    private Provider $_provider;
    
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCallbackConfirmationCode
     */
    public function _setCustom(array $value): GetCallbackConfirmationCode
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return GetCallbackConfirmationCode
     */
    public function setGroupId(int $value): GetCallbackConfirmationCode
    {
        $this->groupId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getCallbackConfirmationCode', $params);
    }
}