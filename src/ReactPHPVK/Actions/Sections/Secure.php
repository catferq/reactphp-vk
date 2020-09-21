<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Secure\AddAppEvent;
use ReactPHPVK\Actions\Sections\Secure\CheckToken;
use ReactPHPVK\Actions\Sections\Secure\GetAppBalance;
use ReactPHPVK\Actions\Sections\Secure\GetSMSHistory;
use ReactPHPVK\Actions\Sections\Secure\GetTransactionsHistory;
use ReactPHPVK\Actions\Sections\Secure\GetUserLevel;
use ReactPHPVK\Actions\Sections\Secure\GiveEventSticker;
use ReactPHPVK\Actions\Sections\Secure\SendNotification;
use ReactPHPVK\Actions\Sections\Secure\SendSMSNotification;
use ReactPHPVK\Actions\Sections\Secure\SetCounter;

class Secure
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds user activity information to an application
     */
    public function addAppEvent(): AddAppEvent
    {
        return new AddAppEvent($this->_provider);
    }

    /**
     * Checks the user authentication in 'IFrame' and 'Flash' apps using the 'access_token' parameter.
     */
    public function checkToken(): CheckToken
    {
        return new CheckToken($this->_provider);
    }

    /**
     * Returns payment balance of the application in hundredth of a vote.
     */
    public function getAppBalance(): GetAppBalance
    {
        return new GetAppBalance($this->_provider);
    }

    /**
     * Shows a list of SMS notifications sent by the application using [vk.com/dev/secure.sendSMSNotification|secure.sendSMSNotification] method.
     */
    public function getSMSHistory(): GetSMSHistory
    {
        return new GetSMSHistory($this->_provider);
    }

    /**
     * Shows history of votes transaction between users and the application.
     */
    public function getTransactionsHistory(): GetTransactionsHistory
    {
        return new GetTransactionsHistory($this->_provider);
    }

    /**
     * Returns one of the previously set game levels of one or more users in the application.
     */
    public function getUserLevel(): GetUserLevel
    {
        return new GetUserLevel($this->_provider);
    }

    /**
     * Opens the game achievement and gives the user a sticker
     */
    public function giveEventSticker(): GiveEventSticker
    {
        return new GiveEventSticker($this->_provider);
    }

    /**
     * Sends notification to the user.
     */
    public function sendNotification(): SendNotification
    {
        return new SendNotification($this->_provider);
    }

    /**
     * Sends 'SMS' notification to a user's mobile device.
     */
    public function sendSMSNotification(): SendSMSNotification
    {
        return new SendSMSNotification($this->_provider);
    }

    /**
     * Sets a counter which is shown to the user in bold in the left menu.
     */
    public function setCounter(): SetCounter
    {
        return new SetCounter($this->_provider);
    }

}