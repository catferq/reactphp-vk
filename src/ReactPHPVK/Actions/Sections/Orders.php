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

    private ?Orders\CancelSubscription $cancelSubscription = null;
    private ?Orders\ChangeState $changeState = null;
    private ?Orders\Get $get = null;
    private ?Orders\GetAmount $getAmount = null;
    private ?Orders\GetById $getById = null;
    private ?Orders\GetUserSubscriptionById $getUserSubscriptionById = null;
    private ?Orders\GetUserSubscriptions $getUserSubscriptions = null;
    private ?Orders\UpdateSubscription $updateSubscription = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function cancelSubscription(): CancelSubscription
    {
        if (!$this->cancelSubscription) {
            $this->cancelSubscription = new CancelSubscription($this->_provider);
        }
        return $this->cancelSubscription;
    }

    /**
     * Changes order status.
     */
    public function changeState(): ChangeState
    {
        if (!$this->changeState) {
            $this->changeState = new ChangeState($this->_provider);
        }
        return $this->changeState;
    }

    /**
     * Returns a list of orders.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * 
     */
    public function getAmount(): GetAmount
    {
        if (!$this->getAmount) {
            $this->getAmount = new GetAmount($this->_provider);
        }
        return $this->getAmount;
    }

    /**
     * Returns information about orders by their IDs.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * 
     */
    public function getUserSubscriptionById(): GetUserSubscriptionById
    {
        if (!$this->getUserSubscriptionById) {
            $this->getUserSubscriptionById = new GetUserSubscriptionById($this->_provider);
        }
        return $this->getUserSubscriptionById;
    }

    /**
     * 
     */
    public function getUserSubscriptions(): GetUserSubscriptions
    {
        if (!$this->getUserSubscriptions) {
            $this->getUserSubscriptions = new GetUserSubscriptions($this->_provider);
        }
        return $this->getUserSubscriptions;
    }

    /**
     * 
     */
    public function updateSubscription(): UpdateSubscription
    {
        if (!$this->updateSubscription) {
            $this->updateSubscription = new UpdateSubscription($this->_provider);
        }
        return $this->updateSubscription;
    }

}