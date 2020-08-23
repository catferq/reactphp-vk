<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Secure
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Adds user activity information to an application
     * 
     * @param int $userId ID of a user to save the data
     * @param int $activityId there are 2 default activities: , * 1 – level. Works similar to ,, * 2 – points, saves points amount, Any other value is for saving completed missions
     * @param int|null $value depends on activity_id: * 1 – number, current level number,, * 2 – number, current user's points amount, , Any other value is ignored
     * @param array|null $custom
     * @return Promise
     */
    function addAppEvent(int $userId, int $activityId, ?int $value = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['activity_id'] = $activityId;
        if ($value !== 0 && $value != null) $sendParams['value'] = $value;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.addAppEvent', $sendParams);
    }

    /**
     * Checks the user authentication in 'IFrame' and 'Flash' apps using the 'access_token' parameter.
     * 
     * @param string|null $token client 'access_token'
     * @param string|null $ip user 'ip address'. Note that user may access using the 'ipv6' address, in this case it is required to transmit the 'ipv6' address. If not transmitted, the address will not be checked.
     * @param array|null $custom
     * @return Promise
     */
    function checkToken(?string $token = '', ?string $ip = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($token !== '' && $token != null) $sendParams['token'] = $token;
        if ($ip !== '' && $ip != null) $sendParams['ip'] = $ip;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.checkToken', $sendParams);
    }

    /**
     * Returns payment balance of the application in hundredth of a vote.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getAppBalance(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.getAppBalance', $sendParams);
    }

    /**
     * Shows a list of SMS notifications sent by the application using [vk.com/dev/secure.sendSMSNotification|secure.sendSMSNotification] method.
     * 
     * @param int|null $userId
     * @param int|null $dateFrom filter by start date. It is set as UNIX-time.
     * @param int|null $dateTo filter by end date. It is set as UNIX-time.
     * @param int|null $limit number of returned posts. By default — 1000.
     * @param array|null $custom
     * @return Promise
     */
    function getSMSHistory(?int $userId = 0, ?int $dateFrom = 0, ?int $dateTo = 0, ?int $limit = 1000, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($dateFrom !== 0 && $dateFrom != null) $sendParams['date_from'] = $dateFrom;
        if ($dateTo !== 0 && $dateTo != null) $sendParams['date_to'] = $dateTo;
        if ($limit !== 1000 && $limit != null) $sendParams['limit'] = $limit;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.getSMSHistory', $sendParams);
    }

    /**
     * Shows history of votes transaction between users and the application.
     * 
     * @param int|null $type
     * @param int|null $uidFrom
     * @param int|null $uidTo
     * @param int|null $dateFrom
     * @param int|null $dateTo
     * @param int|null $limit
     * @param array|null $custom
     * @return Promise
     */
    function getTransactionsHistory(?int $type = 0, ?int $uidFrom = 0, ?int $uidTo = 0, ?int $dateFrom = 0, ?int $dateTo = 0, ?int $limit = 1000, ?array $custom = [])
    {
        $sendParams = [];

        if ($type !== 0 && $type != null) $sendParams['type'] = $type;
        if ($uidFrom !== 0 && $uidFrom != null) $sendParams['uid_from'] = $uidFrom;
        if ($uidTo !== 0 && $uidTo != null) $sendParams['uid_to'] = $uidTo;
        if ($dateFrom !== 0 && $dateFrom != null) $sendParams['date_from'] = $dateFrom;
        if ($dateTo !== 0 && $dateTo != null) $sendParams['date_to'] = $dateTo;
        if ($limit !== 1000 && $limit != null) $sendParams['limit'] = $limit;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.getTransactionsHistory', $sendParams);
    }

    /**
     * Returns one of the previously set game levels of one or more users in the application.
     * 
     * @param array $userIds
     * @param array|null $custom
     * @return Promise
     */
    function getUserLevel(array $userIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_ids'] = implode(',', $userIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.getUserLevel', $sendParams);
    }

    /**
     * Opens the game achievement and gives the user a sticker
     * 
     * @param array $userIds
     * @param int $achievementId
     * @param array|null $custom
     * @return Promise
     */
    function giveEventSticker(array $userIds, int $achievementId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_ids'] = implode(',', $userIds);
        $sendParams['achievement_id'] = $achievementId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.giveEventSticker', $sendParams);
    }

    /**
     * Sends notification to the user.
     * 
     * @param string $message notification text which should be sent in 'UTF-8' encoding ('254' characters maximum).
     * @param array|null $userIds
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function sendNotification(string $message, ?array $userIds = [], ?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['message'] = $message;
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.sendNotification', $sendParams);
    }

    /**
     * Sends 'SMS' notification to a user's mobile device.
     * 
     * @param int $userId ID of the user to whom SMS notification is sent. The user shall allow the application to send him/her notifications (, +1).
     * @param string $message 'SMS' text to be sent in 'UTF-8' encoding. Only Latin letters and numbers are allowed. Maximum size is '160' characters.
     * @param array|null $custom
     * @return Promise
     */
    function sendSMSNotification(int $userId, string $message, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        $sendParams['message'] = $message;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.sendSMSNotification', $sendParams);
    }

    /**
     * Sets a counter which is shown to the user in bold in the left menu.
     * 
     * @param array|null $counters
     * @param int|null $userId
     * @param int|null $counter counter value.
     * @param bool|null $increment
     * @param array|null $custom
     * @return Promise
     */
    function setCounter(?array $counters = [], ?int $userId = 0, ?int $counter = 0, ?bool $increment = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($counters !== [] && $counters != null) $sendParams['counters'] = implode(',', $counters);
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($counter !== 0 && $counter != null) $sendParams['counter'] = $counter;
        if ($increment !== false && $increment != null) $sendParams['increment'] = intval($increment);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('secure.setCounter', $sendParams);
    }
}