<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Orders
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * orders.cancelSubscription
     * 
     * @param int $userId
     * @param int $subscriptionId
     * @param bool|null $pendingCancel
     * @param array|null $custom
     * @return Promise
     */
    function cancelSubscription(int $userId, int $subscriptionId, ?bool $pendingCancel = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['subscription_id'] = $subscriptionId;
        if ($pendingCancel !== false && $pendingCancel != null) $sendParams['pending_cancel'] = intval($pendingCancel);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.cancelSubscription', $sendParams);
    }

    /**
     * Changes order status.
     * 
     * @param int $orderId order ID.
     * @param string $action action to be done with the order. Available actions: *cancel — to cancel unconfirmed order. *charge — to confirm unconfirmed order. Applies only if processing of [vk.com/dev/payments_status|order_change_state] notification failed. *refund — to cancel confirmed order.
     * @param int|null $appOrderId internal ID of the order in the application.
     * @param bool|null $testMode if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
     * @param array|null $custom
     * @return Promise
     */
    function changeState(int $orderId, string $action, ?int $appOrderId = 0, ?bool $testMode = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['order_id'] = $orderId;
        $sendParams['action'] = $action;
        if ($appOrderId !== 0 && $appOrderId != null) $sendParams['app_order_id'] = $appOrderId;
        if ($testMode !== false && $testMode != null) $sendParams['test_mode'] = intval($testMode);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.changeState', $sendParams);
    }

    /**
     * Returns a list of orders.
     * 
     * @param int|null $offset
     * @param int|null $count number of returned orders.
     * @param bool|null $testMode if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $offset = 0, ?int $count = 100, ?bool $testMode = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($testMode !== false && $testMode != null) $sendParams['test_mode'] = intval($testMode);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.get', $sendParams);
    }

    /**
     * orders.getAmount
     * 
     * @param int $userId
     * @param array $votes
     * @param array|null $custom
     * @return Promise
     */
    function getAmount(int $userId, array $votes, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['votes'] = implode(',', $votes);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.getAmount', $sendParams);
    }

    /**
     * Returns information about orders by their IDs.
     * 
     * @param int|null $orderId order ID.
     * @param array|null $orderIds order IDs (when information about several orders is requested).
     * @param bool|null $testMode if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
     * @param array|null $custom
     * @return Promise
     */
    function getById(?int $orderId = 0, ?array $orderIds = [], ?bool $testMode = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($orderId !== 0 && $orderId != null) $sendParams['order_id'] = $orderId;
        if ($orderIds !== [] && $orderIds != null) $sendParams['order_ids'] = implode(',', $orderIds);
        if ($testMode !== false && $testMode != null) $sendParams['test_mode'] = intval($testMode);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.getById', $sendParams);
    }

    /**
     * orders.getUserSubscriptionById
     * 
     * @param int $userId
     * @param int $subscriptionId
     * @param array|null $custom
     * @return Promise
     */
    function getUserSubscriptionById(int $userId, int $subscriptionId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['subscription_id'] = $subscriptionId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.getUserSubscriptionById', $sendParams);
    }

    /**
     * orders.getUserSubscriptions
     * 
     * @param int $userId
     * @param array|null $custom
     * @return Promise
     */
    function getUserSubscriptions(int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.getUserSubscriptions', $sendParams);
    }

    /**
     * orders.updateSubscription
     * 
     * @param int $userId
     * @param int $subscriptionId
     * @param int $price
     * @param array|null $custom
     * @return Promise
     */
    function updateSubscription(int $userId, int $subscriptionId, int $price, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['subscription_id'] = $subscriptionId;
        $sendParams['price'] = $price;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('orders.updateSubscription', $sendParams);
    }
}