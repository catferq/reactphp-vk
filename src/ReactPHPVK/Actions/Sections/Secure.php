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

    private ?Secure\AddAppEvent $addAppEvent = null;
    private ?Secure\CheckToken $checkToken = null;
    private ?Secure\GetAppBalance $getAppBalance = null;
    private ?Secure\GetSMSHistory $getSMSHistory = null;
    private ?Secure\GetTransactionsHistory $getTransactionsHistory = null;
    private ?Secure\GetUserLevel $getUserLevel = null;
    private ?Secure\GiveEventSticker $giveEventSticker = null;
    private ?Secure\SendNotification $sendNotification = null;
    private ?Secure\SendSMSNotification $sendSMSNotification = null;
    private ?Secure\SetCounter $setCounter = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds user activity information to an application
     */
    public function addAppEvent(): AddAppEvent
    {
        if (!$this->addAppEvent) {
            $this->addAppEvent = new AddAppEvent($this->_provider);
        }
        return $this->addAppEvent;
    }

    /**
     * Checks the user authentication in 'IFrame' and 'Flash' apps using the 'access_token' parameter.
     */
    public function checkToken(): CheckToken
    {
        if (!$this->checkToken) {
            $this->checkToken = new CheckToken($this->_provider);
        }
        return $this->checkToken;
    }

    /**
     * Returns payment balance of the application in hundredth of a vote.
     */
    public function getAppBalance(): GetAppBalance
    {
        if (!$this->getAppBalance) {
            $this->getAppBalance = new GetAppBalance($this->_provider);
        }
        return $this->getAppBalance;
    }

    /**
     * Shows a list of SMS notifications sent by the application using [vk.com/dev/secure.sendSMSNotification|secure.sendSMSNotification] method.
     */
    public function getSMSHistory(): GetSMSHistory
    {
        if (!$this->getSMSHistory) {
            $this->getSMSHistory = new GetSMSHistory($this->_provider);
        }
        return $this->getSMSHistory;
    }

    /**
     * Shows history of votes transaction between users and the application.
     */
    public function getTransactionsHistory(): GetTransactionsHistory
    {
        if (!$this->getTransactionsHistory) {
            $this->getTransactionsHistory = new GetTransactionsHistory($this->_provider);
        }
        return $this->getTransactionsHistory;
    }

    /**
     * Returns one of the previously set game levels of one or more users in the application.
     */
    public function getUserLevel(): GetUserLevel
    {
        if (!$this->getUserLevel) {
            $this->getUserLevel = new GetUserLevel($this->_provider);
        }
        return $this->getUserLevel;
    }

    /**
     * Opens the game achievement and gives the user a sticker
     */
    public function giveEventSticker(): GiveEventSticker
    {
        if (!$this->giveEventSticker) {
            $this->giveEventSticker = new GiveEventSticker($this->_provider);
        }
        return $this->giveEventSticker;
    }

    /**
     * Sends notification to the user.
     */
    public function sendNotification(): SendNotification
    {
        if (!$this->sendNotification) {
            $this->sendNotification = new SendNotification($this->_provider);
        }
        return $this->sendNotification;
    }

    /**
     * Sends 'SMS' notification to a user's mobile device.
     */
    public function sendSMSNotification(): SendSMSNotification
    {
        if (!$this->sendSMSNotification) {
            $this->sendSMSNotification = new SendSMSNotification($this->_provider);
        }
        return $this->sendSMSNotification;
    }

    /**
     * Sets a counter which is shown to the user in bold in the left menu.
     */
    public function setCounter(): SetCounter
    {
        if (!$this->setCounter) {
            $this->setCounter = new SetCounter($this->_provider);
        }
        return $this->setCounter;
    }

}