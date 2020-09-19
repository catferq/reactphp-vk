<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Apps\DeleteAppRequests;
use ReactPHPVK\Actions\Sections\Apps\Get;
use ReactPHPVK\Actions\Sections\Apps\GetCatalog;
use ReactPHPVK\Actions\Sections\Apps\GetFriendsList;
use ReactPHPVK\Actions\Sections\Apps\GetLeaderboard;
use ReactPHPVK\Actions\Sections\Apps\GetScopes;
use ReactPHPVK\Actions\Sections\Apps\GetScore;
use ReactPHPVK\Actions\Sections\Apps\PromoHasActiveGift;
use ReactPHPVK\Actions\Sections\Apps\PromoUseGift;
use ReactPHPVK\Actions\Sections\Apps\SendRequest;

class Apps
{
    private Provider $_provider;

    private ?Apps\DeleteAppRequests $deleteAppRequests = null;
    private ?Apps\Get $get = null;
    private ?Apps\GetCatalog $getCatalog = null;
    private ?Apps\GetFriendsList $getFriendsList = null;
    private ?Apps\GetLeaderboard $getLeaderboard = null;
    private ?Apps\GetScopes $getScopes = null;
    private ?Apps\GetScore $getScore = null;
    private ?Apps\PromoHasActiveGift $promoHasActiveGift = null;
    private ?Apps\PromoUseGift $promoUseGift = null;
    private ?Apps\SendRequest $sendRequest = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Deletes all request notifications from the current app.
     */
    public function deleteAppRequests(): DeleteAppRequests
    {
        if (!$this->deleteAppRequests) {
            $this->deleteAppRequests = new DeleteAppRequests($this->_provider);
        }
        return $this->deleteAppRequests;
    }

    /**
     * Returns applications data.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of applications (apps) available to users in the App Catalog.
     */
    public function getCatalog(): GetCatalog
    {
        if (!$this->getCatalog) {
            $this->getCatalog = new GetCatalog($this->_provider);
        }
        return $this->getCatalog;
    }

    /**
     * Creates friends list for requests and invites in current app.
     */
    public function getFriendsList(): GetFriendsList
    {
        if (!$this->getFriendsList) {
            $this->getFriendsList = new GetFriendsList($this->_provider);
        }
        return $this->getFriendsList;
    }

    /**
     * Returns players rating in the game.
     */
    public function getLeaderboard(): GetLeaderboard
    {
        if (!$this->getLeaderboard) {
            $this->getLeaderboard = new GetLeaderboard($this->_provider);
        }
        return $this->getLeaderboard;
    }

    /**
     * Returns scopes for auth
     */
    public function getScopes(): GetScopes
    {
        if (!$this->getScopes) {
            $this->getScopes = new GetScopes($this->_provider);
        }
        return $this->getScopes;
    }

    /**
     * Returns user score in app
     */
    public function getScore(): GetScore
    {
        if (!$this->getScore) {
            $this->getScore = new GetScore($this->_provider);
        }
        return $this->getScore;
    }

    /**
     * 
     */
    public function promoHasActiveGift(): PromoHasActiveGift
    {
        if (!$this->promoHasActiveGift) {
            $this->promoHasActiveGift = new PromoHasActiveGift($this->_provider);
        }
        return $this->promoHasActiveGift;
    }

    /**
     * 
     */
    public function promoUseGift(): PromoUseGift
    {
        if (!$this->promoUseGift) {
            $this->promoUseGift = new PromoUseGift($this->_provider);
        }
        return $this->promoUseGift;
    }

    /**
     * Sends a request to another user in an app that uses VK authorization.
     */
    public function sendRequest(): SendRequest
    {
        if (!$this->sendRequest) {
            $this->sendRequest = new SendRequest($this->_provider);
        }
        return $this->sendRequest;
    }

}