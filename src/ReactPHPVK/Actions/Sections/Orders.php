<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Orders\CancelSubscription;
use ReactPHPVK\Actions\Sections\Orders\ChangeState;
use ReactPHPVK\Actions\Sections\Orders\Get;
use ReactPHPVK\Actions\Sections\Orders\GetAmount;
use ReactPHPVK\Actions\Sections\Orders\GetById;
use ReactPHPVK\Actions\Sections\Orders\GetUserSubscriptionById;
use ReactPHPVK\Actions\Sections\Orders\GetUserSubscriptions;
use ReactPHPVK\Actions\Sections\Orders\UpdateSubscription;

class Orders
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function cancelSubscription(): CancelSubscription
    {
        return new CancelSubscription($this->_provider);
    }

    /**
     * Changes order status.
     */
    public function changeState(): ChangeState
    {
        return new ChangeState($this->_provider);
    }

    /**
     * Returns a list of orders.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * 
     */
    public function getAmount(): GetAmount
    {
        return new GetAmount($this->_provider);
    }

    /**
     * Returns information about orders by their IDs.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * 
     */
    public function getUserSubscriptionById(): GetUserSubscriptionById
    {
        return new GetUserSubscriptionById($this->_provider);
    }

    /**
     * 
     */
    public function getUserSubscriptions(): GetUserSubscriptions
    {
        return new GetUserSubscriptions($this->_provider);
    }

    /**
     * 
     */
    public function updateSubscription(): UpdateSubscription
    {
        return new UpdateSubscription($this->_provider);
    }

}