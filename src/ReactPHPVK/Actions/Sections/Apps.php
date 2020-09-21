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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Deletes all request notifications from the current app.
     */
    public function deleteAppRequests(): DeleteAppRequests
    {
        return new DeleteAppRequests($this->_provider);
    }

    /**
     * Returns applications data.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of applications (apps) available to users in the App Catalog.
     */
    public function getCatalog(): GetCatalog
    {
        return new GetCatalog($this->_provider);
    }

    /**
     * Creates friends list for requests and invites in current app.
     */
    public function getFriendsList(): GetFriendsList
    {
        return new GetFriendsList($this->_provider);
    }

    /**
     * Returns players rating in the game.
     */
    public function getLeaderboard(): GetLeaderboard
    {
        return new GetLeaderboard($this->_provider);
    }

    /**
     * Returns scopes for auth
     */
    public function getScopes(): GetScopes
    {
        return new GetScopes($this->_provider);
    }

    /**
     * Returns user score in app
     */
    public function getScore(): GetScore
    {
        return new GetScore($this->_provider);
    }

    /**
     * 
     */
    public function promoHasActiveGift(): PromoHasActiveGift
    {
        return new PromoHasActiveGift($this->_provider);
    }

    /**
     * 
     */
    public function promoUseGift(): PromoUseGift
    {
        return new PromoUseGift($this->_provider);
    }

    /**
     * Sends a request to another user in an app that uses VK authorization.
     */
    public function sendRequest(): SendRequest
    {
        return new SendRequest($this->_provider);
    }

}