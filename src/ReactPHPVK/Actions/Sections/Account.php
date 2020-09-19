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

    private ?Account\Ban $ban = null;
    private ?Account\ChangePassword $changePassword = null;
    private ?Account\GetActiveOffers $getActiveOffers = null;
    private ?Account\GetAppPermissions $getAppPermissions = null;
    private ?Account\GetBanned $getBanned = null;
    private ?Account\GetCounters $getCounters = null;
    private ?Account\GetInfo $getInfo = null;
    private ?Account\GetProfileInfo $getProfileInfo = null;
    private ?Account\GetPushSettings $getPushSettings = null;
    private ?Account\RegisterDevice $registerDevice = null;
    private ?Account\SaveProfileInfo $saveProfileInfo = null;
    private ?Account\SetInfo $setInfo = null;
    private ?Account\SetNameInMenu $setNameInMenu = null;
    private ?Account\SetOffline $setOffline = null;
    private ?Account\SetOnline $setOnline = null;
    private ?Account\SetPushSettings $setPushSettings = null;
    private ?Account\SetSilenceMode $setSilenceMode = null;
    private ?Account\Unban $unban = null;
    private ?Account\UnregisterDevice $unregisterDevice = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function ban(): Ban
    {
        if (!$this->ban) {
            $this->ban = new Ban($this->_provider);
        }
        return $this->ban;
    }

    /**
     * Changes a user password after access is successfully restored with the [vk.com/dev/auth.restore|auth.restore] method.
     */
    public function changePassword(): ChangePassword
    {
        if (!$this->changePassword) {
            $this->changePassword = new ChangePassword($this->_provider);
        }
        return $this->changePassword;
    }

    /**
     * Returns a list of active ads (offers) which executed by the user will bring him/her respective number of votes to his balance in the application.
     */
    public function getActiveOffers(): GetActiveOffers
    {
        if (!$this->getActiveOffers) {
            $this->getActiveOffers = new GetActiveOffers($this->_provider);
        }
        return $this->getActiveOffers;
    }

    /**
     * Gets settings of the user in this application.
     */
    public function getAppPermissions(): GetAppPermissions
    {
        if (!$this->getAppPermissions) {
            $this->getAppPermissions = new GetAppPermissions($this->_provider);
        }
        return $this->getAppPermissions;
    }

    /**
     * Returns a user's blacklist.
     */
    public function getBanned(): GetBanned
    {
        if (!$this->getBanned) {
            $this->getBanned = new GetBanned($this->_provider);
        }
        return $this->getBanned;
    }

    /**
     * Returns non-null values of user counters.
     */
    public function getCounters(): GetCounters
    {
        if (!$this->getCounters) {
            $this->getCounters = new GetCounters($this->_provider);
        }
        return $this->getCounters;
    }

    /**
     * Returns current account info.
     */
    public function getInfo(): GetInfo
    {
        if (!$this->getInfo) {
            $this->getInfo = new GetInfo($this->_provider);
        }
        return $this->getInfo;
    }

    /**
     * Returns the current account info.
     */
    public function getProfileInfo(): GetProfileInfo
    {
        if (!$this->getProfileInfo) {
            $this->getProfileInfo = new GetProfileInfo($this->_provider);
        }
        return $this->getProfileInfo;
    }

    /**
     * Gets settings of push notifications.
     */
    public function getPushSettings(): GetPushSettings
    {
        if (!$this->getPushSettings) {
            $this->getPushSettings = new GetPushSettings($this->_provider);
        }
        return $this->getPushSettings;
    }

    /**
     * Subscribes an iOS/Android/Windows Phone-based device to receive push notifications
     */
    public function registerDevice(): RegisterDevice
    {
        if (!$this->registerDevice) {
            $this->registerDevice = new RegisterDevice($this->_provider);
        }
        return $this->registerDevice;
    }

    /**
     * Edits current profile info.
     */
    public function saveProfileInfo(): SaveProfileInfo
    {
        if (!$this->saveProfileInfo) {
            $this->saveProfileInfo = new SaveProfileInfo($this->_provider);
        }
        return $this->saveProfileInfo;
    }

    /**
     * Allows to edit the current account info.
     */
    public function setInfo(): SetInfo
    {
        if (!$this->setInfo) {
            $this->setInfo = new SetInfo($this->_provider);
        }
        return $this->setInfo;
    }

    /**
     * Sets an application screen name (up to 17 characters), that is shown to the user in the left menu.
     */
    public function setNameInMenu(): SetNameInMenu
    {
        if (!$this->setNameInMenu) {
            $this->setNameInMenu = new SetNameInMenu($this->_provider);
        }
        return $this->setNameInMenu;
    }

    /**
     * Marks a current user as offline.
     */
    public function setOffline(): SetOffline
    {
        if (!$this->setOffline) {
            $this->setOffline = new SetOffline($this->_provider);
        }
        return $this->setOffline;
    }

    /**
     * Marks the current user as online for 15 minutes.
     */
    public function setOnline(): SetOnline
    {
        if (!$this->setOnline) {
            $this->setOnline = new SetOnline($this->_provider);
        }
        return $this->setOnline;
    }

    /**
     * Change push settings.
     */
    public function setPushSettings(): SetPushSettings
    {
        if (!$this->setPushSettings) {
            $this->setPushSettings = new SetPushSettings($this->_provider);
        }
        return $this->setPushSettings;
    }

    /**
     * Mutes push notifications for the set period of time.
     */
    public function setSilenceMode(): SetSilenceMode
    {
        if (!$this->setSilenceMode) {
            $this->setSilenceMode = new SetSilenceMode($this->_provider);
        }
        return $this->setSilenceMode;
    }

    /**
     * 
     */
    public function unban(): Unban
    {
        if (!$this->unban) {
            $this->unban = new Unban($this->_provider);
        }
        return $this->unban;
    }

    /**
     * Unsubscribes a device from push notifications.
     */
    public function unregisterDevice(): UnregisterDevice
    {
        if (!$this->unregisterDevice) {
            $this->unregisterDevice = new UnregisterDevice($this->_provider);
        }
        return $this->unregisterDevice;
    }

}