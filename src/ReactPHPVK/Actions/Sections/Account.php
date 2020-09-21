<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Account\Ban;
use ReactPHPVK\Actions\Sections\Account\ChangePassword;
use ReactPHPVK\Actions\Sections\Account\GetActiveOffers;
use ReactPHPVK\Actions\Sections\Account\GetAppPermissions;
use ReactPHPVK\Actions\Sections\Account\GetBanned;
use ReactPHPVK\Actions\Sections\Account\GetCounters;
use ReactPHPVK\Actions\Sections\Account\GetInfo;
use ReactPHPVK\Actions\Sections\Account\GetProfileInfo;
use ReactPHPVK\Actions\Sections\Account\GetPushSettings;
use ReactPHPVK\Actions\Sections\Account\RegisterDevice;
use ReactPHPVK\Actions\Sections\Account\SaveProfileInfo;
use ReactPHPVK\Actions\Sections\Account\SetInfo;
use ReactPHPVK\Actions\Sections\Account\SetNameInMenu;
use ReactPHPVK\Actions\Sections\Account\SetOffline;
use ReactPHPVK\Actions\Sections\Account\SetOnline;
use ReactPHPVK\Actions\Sections\Account\SetPushSettings;
use ReactPHPVK\Actions\Sections\Account\SetSilenceMode;
use ReactPHPVK\Actions\Sections\Account\Unban;
use ReactPHPVK\Actions\Sections\Account\UnregisterDevice;

class Account
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function ban(): Ban
    {
        return new Ban($this->_provider);
    }

    /**
     * Changes a user password after access is successfully restored with the [vk.com/dev/auth.restore|auth.restore] method.
     */
    public function changePassword(): ChangePassword
    {
        return new ChangePassword($this->_provider);
    }

    /**
     * Returns a list of active ads (offers) which executed by the user will bring him/her respective number of votes to his balance in the application.
     */
    public function getActiveOffers(): GetActiveOffers
    {
        return new GetActiveOffers($this->_provider);
    }

    /**
     * Gets settings of the user in this application.
     */
    public function getAppPermissions(): GetAppPermissions
    {
        return new GetAppPermissions($this->_provider);
    }

    /**
     * Returns a user's blacklist.
     */
    public function getBanned(): GetBanned
    {
        return new GetBanned($this->_provider);
    }

    /**
     * Returns non-null values of user counters.
     */
    public function getCounters(): GetCounters
    {
        return new GetCounters($this->_provider);
    }

    /**
     * Returns current account info.
     */
    public function getInfo(): GetInfo
    {
        return new GetInfo($this->_provider);
    }

    /**
     * Returns the current account info.
     */
    public function getProfileInfo(): GetProfileInfo
    {
        return new GetProfileInfo($this->_provider);
    }

    /**
     * Gets settings of push notifications.
     */
    public function getPushSettings(): GetPushSettings
    {
        return new GetPushSettings($this->_provider);
    }

    /**
     * Subscribes an iOS/Android/Windows Phone-based device to receive push notifications
     */
    public function registerDevice(): RegisterDevice
    {
        return new RegisterDevice($this->_provider);
    }

    /**
     * Edits current profile info.
     */
    public function saveProfileInfo(): SaveProfileInfo
    {
        return new SaveProfileInfo($this->_provider);
    }

    /**
     * Allows to edit the current account info.
     */
    public function setInfo(): SetInfo
    {
        return new SetInfo($this->_provider);
    }

    /**
     * Sets an application screen name (up to 17 characters), that is shown to the user in the left menu.
     */
    public function setNameInMenu(): SetNameInMenu
    {
        return new SetNameInMenu($this->_provider);
    }

    /**
     * Marks a current user as offline.
     */
    public function setOffline(): SetOffline
    {
        return new SetOffline($this->_provider);
    }

    /**
     * Marks the current user as online for 15 minutes.
     */
    public function setOnline(): SetOnline
    {
        return new SetOnline($this->_provider);
    }

    /**
     * Change push settings.
     */
    public function setPushSettings(): SetPushSettings
    {
        return new SetPushSettings($this->_provider);
    }

    /**
     * Mutes push notifications for the set period of time.
     */
    public function setSilenceMode(): SetSilenceMode
    {
        return new SetSilenceMode($this->_provider);
    }

    /**
     * 
     */
    public function unban(): Unban
    {
        return new Unban($this->_provider);
    }

    /**
     * Unsubscribes a device from push notifications.
     */
    public function unregisterDevice(): UnregisterDevice
    {
        return new UnregisterDevice($this->_provider);
    }

}