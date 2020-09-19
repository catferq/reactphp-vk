<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Gets settings of the user in this application.
 */
class GetAppPermissions
{
    private Provider $_provider;
    
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAppPermissions
     */
    public function _setCustom(array $value): GetAppPermissions
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID whose settings information shall be got. By default: current user.
     * 
     * @param int $value
     * @return GetAppPermissions
     */
    public function setUserId(int $value): GetAppPermissions
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('account.getAppPermissions', $params);
    }
}