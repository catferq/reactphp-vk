<?php

namespace ReactPHPVK\Actions\Sections\Account;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Changes a user password after access is successfully restored with the [vk.com/dev/auth.restore|auth.restore] method.
 */
class ChangePassword
{
    private Provider $_provider;
    
    private string $restoreSid = '';
    private string $changePasswordHash = '';
    private string $oldPassword = '';
    private string $newPassword = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ChangePassword
     */
    public function _setCustom(array $value): ChangePassword
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Session id received after the [vk.com/dev/auth.restore|auth.restore] method is executed. (If the password is changed right after the access was restored)
     * 
     * @param string $value
     * @return ChangePassword
     */
    public function setRestoreSid(string $value): ChangePassword
    {
        $this->restoreSid = $value;
        return $this;
    }

    /**
     * Hash received after a successful OAuth authorization with a code got by SMS. (If the password is changed right after the access was restored)
     * 
     * @param string $value
     * @return ChangePassword
     */
    public function setChangePasswordHash(string $value): ChangePassword
    {
        $this->changePasswordHash = $value;
        return $this;
    }

    /**
     * Current user password.
     * 
     * @param string $value
     * @return ChangePassword
     */
    public function setOldPassword(string $value): ChangePassword
    {
        $this->oldPassword = $value;
        return $this;
    }

    /**
     * New password that will be set as a current
     * 
     * @param string $value
     * @return ChangePassword
     */
    public function setNewPassword(string $value): ChangePassword
    {
        $this->newPassword = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->restoreSid !== '') $params['restore_sid'] = $this->restoreSid;
        if ($this->changePasswordHash !== '') $params['change_password_hash'] = $this->changePasswordHash;
        if ($this->oldPassword !== '') $params['old_password'] = $this->oldPassword;
        $params['new_password'] = $this->newPassword;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->restoreSid = '';
            $this->changePasswordHash = '';
            $this->oldPassword = '';
            $this->newPassword = '';
            $this->_custom = [];
        }

        return $this->_provider->request('account.changePassword', $params);
    }
}