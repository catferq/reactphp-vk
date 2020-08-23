<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Account
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * account.ban
     * 
     * @param int|null $ownerId
     * @param array|null $custom
     * @return Promise
     */
    function ban(?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.ban', $sendParams);
    }

    /**
     * Changes a user password after access is successfully restored with the [vk.com/dev/auth.restore|auth.restore] method.
     * 
     * @param string $newPassword New password that will be set as a current
     * @param string|null $restoreSid Session id received after the [vk.com/dev/auth.restore|auth.restore] method is executed. (If the password is changed right after the access was restored)
     * @param string|null $changePasswordHash Hash received after a successful OAuth authorization with a code got by SMS. (If the password is changed right after the access was restored)
     * @param string|null $oldPassword Current user password.
     * @param array|null $custom
     * @return Promise
     */
    function changePassword(string $newPassword, ?string $restoreSid = '', ?string $changePasswordHash = '', ?string $oldPassword = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['new_password'] = $newPassword;
        if ($restoreSid !== '' && $restoreSid != null) $sendParams['restore_sid'] = $restoreSid;
        if ($changePasswordHash !== '' && $changePasswordHash != null) $sendParams['change_password_hash'] = $changePasswordHash;
        if ($oldPassword !== '' && $oldPassword != null) $sendParams['old_password'] = $oldPassword;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.changePassword', $sendParams);
    }

    /**
     * Returns a list of active ads (offers) which executed by the user will bring him/her respective number of votes to his balance in the application.
     * 
     * @param int|null $offset
     * @param int|null $count Number of results to return.
     * @param array|null $custom
     * @return Promise
     */
    function getActiveOffers(?int $offset = 0, ?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getActiveOffers', $sendParams);
    }

    /**
     * Gets settings of the user in this application.
     * 
     * @param int $userId User ID whose settings information shall be got. By default: current user.
     * @param array|null $custom
     * @return Promise
     */
    function getAppPermissions(int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getAppPermissions', $sendParams);
    }

    /**
     * Returns a user's blacklist.
     * 
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of results to return.
     * @param array|null $custom
     * @return Promise
     */
    function getBanned(?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getBanned', $sendParams);
    }

    /**
     * Returns non-null values of user counters.
     * 
     * @param array|null $filter Counters to be returned.
     * @param array|null $custom
     * @return Promise
     */
    function getCounters(?array $filter = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($filter !== [] && $filter != null) $sendParams['filter'] = implode(',', $filter);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getCounters', $sendParams);
    }

    /**
     * Returns current account info.
     * 
     * @param array|null $fields Fields to return. Possible values: *'country' — user country,, *'https_required' — is "HTTPS only" option enabled,, *'own_posts_default' — is "Show my posts only" option is enabled,, *'no_wall_replies' — are wall replies disabled or not,, *'intro' — is intro passed by user or not,, *'lang' — user language. By default: all.
     * @param array|null $custom
     * @return Promise
     */
    function getInfo(?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getInfo', $sendParams);
    }

    /**
     * Returns the current account info.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getProfileInfo(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getProfileInfo', $sendParams);
    }

    /**
     * Gets settings of push notifications.
     * 
     * @param string|null $deviceId Unique device ID.
     * @param array|null $custom
     * @return Promise
     */
    function getPushSettings(?string $deviceId = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($deviceId !== '' && $deviceId != null) $sendParams['device_id'] = $deviceId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.getPushSettings', $sendParams);
    }

    /**
     * Subscribes an iOS/Android/Windows Phone-based device to receive push notifications
     * 
     * @param string $token Device token used to send notifications. (for mpns, the token shall be URL for sending of notifications)
     * @param string $deviceId Unique device ID.
     * @param string|null $deviceModel String name of device model.
     * @param int|null $deviceYear Device year.
     * @param string|null $systemVersion String version of device operating system.
     * @param string|null $settings Push settings in a [vk.com/dev/push_settings|special format].
     * @param bool|null $sandbox
     * @param array|null $custom
     * @return Promise
     */
    function registerDevice(string $token, string $deviceId, ?string $deviceModel = '', ?int $deviceYear = 0, ?string $systemVersion = '', ?string $settings = '', ?bool $sandbox = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['token'] = $token;
        $sendParams['device_id'] = $deviceId;
        if ($deviceModel !== '' && $deviceModel != null) $sendParams['device_model'] = $deviceModel;
        if ($deviceYear !== 0 && $deviceYear != null) $sendParams['device_year'] = $deviceYear;
        if ($systemVersion !== '' && $systemVersion != null) $sendParams['system_version'] = $systemVersion;
        if ($settings !== '' && $settings != null) $sendParams['settings'] = $settings;
        if ($sandbox !== false && $sandbox != null) $sendParams['sandbox'] = intval($sandbox);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.registerDevice', $sendParams);
    }

    /**
     * Edits current profile info.
     * 
     * @param string|null $firstName User first name.
     * @param string|null $lastName User last name.
     * @param string|null $maidenName User maiden name (female only)
     * @param string|null $screenName User screen name.
     * @param int|null $cancelRequestId ID of the name change request to be canceled. If this parameter is sent, all the others are ignored.
     * @param int|null $sex User sex. Possible values: , * '1' – female,, * '2' – male.
     * @param int|null $relation User relationship status. Possible values: , * '1' – single,, * '2' – in a relationship,, * '3' – engaged,, * '4' – married,, * '5' – it's complicated,, * '6' – actively searching,, * '7' – in love,, * '0' – not specified.
     * @param int|null $relationPartnerId ID of the relationship partner.
     * @param string|null $bdate User birth date, format: DD.MM.YYYY.
     * @param int|null $bdateVisibility Birth date visibility. Returned values: , * '1' – show birth date,, * '2' – show only month and day,, * '0' – hide birth date.
     * @param string|null $homeTown User home town.
     * @param int|null $countryId User country.
     * @param int|null $cityId User city.
     * @param string|null $status Status text.
     * @param array|null $custom
     * @return Promise
     */
    function saveProfileInfo(?string $firstName = '', ?string $lastName = '', ?string $maidenName = '', ?string $screenName = '', ?int $cancelRequestId = 0, ?int $sex = 0, ?int $relation = 0, ?int $relationPartnerId = 0, ?string $bdate = '', ?int $bdateVisibility = 0, ?string $homeTown = '', ?int $countryId = 0, ?int $cityId = 0, ?string $status = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($firstName !== '' && $firstName != null) $sendParams['first_name'] = $firstName;
        if ($lastName !== '' && $lastName != null) $sendParams['last_name'] = $lastName;
        if ($maidenName !== '' && $maidenName != null) $sendParams['maiden_name'] = $maidenName;
        if ($screenName !== '' && $screenName != null) $sendParams['screen_name'] = $screenName;
        if ($cancelRequestId !== 0 && $cancelRequestId != null) $sendParams['cancel_request_id'] = $cancelRequestId;
        if ($sex !== 0 && $sex != null) $sendParams['sex'] = $sex;
        if ($relation !== 0 && $relation != null) $sendParams['relation'] = $relation;
        if ($relationPartnerId !== 0 && $relationPartnerId != null) $sendParams['relation_partner_id'] = $relationPartnerId;
        if ($bdate !== '' && $bdate != null) $sendParams['bdate'] = $bdate;
        if ($bdateVisibility !== 0 && $bdateVisibility != null) $sendParams['bdate_visibility'] = $bdateVisibility;
        if ($homeTown !== '' && $homeTown != null) $sendParams['home_town'] = $homeTown;
        if ($countryId !== 0 && $countryId != null) $sendParams['country_id'] = $countryId;
        if ($cityId !== 0 && $cityId != null) $sendParams['city_id'] = $cityId;
        if ($status !== '' && $status != null) $sendParams['status'] = $status;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.saveProfileInfo', $sendParams);
    }

    /**
     * Allows to edit the current account info.
     * 
     * @param string|null $name Setting name.
     * @param string|null $value Setting value.
     * @param array|null $custom
     * @return Promise
     */
    function setInfo(?string $name = '', ?string $value = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($name !== '' && $name != null) $sendParams['name'] = $name;
        if ($value !== '' && $value != null) $sendParams['value'] = $value;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.setInfo', $sendParams);
    }

    /**
     * Sets an application screen name (up to 17 characters), that is shown to the user in the left menu.
     * 
     * @param int $userId User ID.
     * @param string|null $name Application screen name.
     * @param array|null $custom
     * @return Promise
     */
    function setNameInMenu(int $userId, ?string $name = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        if ($name !== '' && $name != null) $sendParams['name'] = $name;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.setNameInMenu', $sendParams);
    }

    /**
     * Marks a current user as offline.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function setOffline(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.setOffline', $sendParams);
    }

    /**
     * Marks the current user as online for 15 minutes.
     * 
     * @param bool|null $voip '1' if videocalls are available for current device.
     * @param array|null $custom
     * @return Promise
     */
    function setOnline(?bool $voip = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($voip !== false && $voip != null) $sendParams['voip'] = intval($voip);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.setOnline', $sendParams);
    }

    /**
     * Change push settings.
     * 
     * @param string $deviceId Unique device ID.
     * @param string|null $settings Push settings in a [vk.com/dev/push_settings|special format].
     * @param string|null $key Notification key.
     * @param array|null $value New value for the key in a [vk.com/dev/push_settings|special format].
     * @param array|null $custom
     * @return Promise
     */
    function setPushSettings(string $deviceId, ?string $settings = '', ?string $key = '', ?array $value = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['device_id'] = $deviceId;
        if ($settings !== '' && $settings != null) $sendParams['settings'] = $settings;
        if ($key !== '' && $key != null) $sendParams['key'] = $key;
        if ($value !== [] && $value != null) $sendParams['value'] = implode(',', $value);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.setPushSettings', $sendParams);
    }

    /**
     * Mutes push notifications for the set period of time.
     * 
     * @param string|null $deviceId Unique device ID.
     * @param int|null $time Time in seconds for what notifications should be disabled. '-1' to disable forever.
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * @param int|null $sound '1' — to enable sound in this dialog, '0' — to disable sound. Only if 'peer_id' contains user or community ID.
     * @param array|null $custom
     * @return Promise
     */
    function setSilenceMode(?string $deviceId = '', ?int $time = 0, ?int $peerId = 0, ?int $sound = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($deviceId !== '' && $deviceId != null) $sendParams['device_id'] = $deviceId;
        if ($time !== 0 && $time != null) $sendParams['time'] = $time;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($sound !== 0 && $sound != null) $sendParams['sound'] = $sound;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.setSilenceMode', $sendParams);
    }

    /**
     * account.unban
     * 
     * @param int|null $ownerId
     * @param array|null $custom
     * @return Promise
     */
    function unban(?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.unban', $sendParams);
    }

    /**
     * Unsubscribes a device from push notifications.
     * 
     * @param string|null $deviceId Unique device ID.
     * @param bool|null $sandbox
     * @param array|null $custom
     * @return Promise
     */
    function unregisterDevice(?string $deviceId = '', ?bool $sandbox = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($deviceId !== '' && $deviceId != null) $sendParams['device_id'] = $deviceId;
        if ($sandbox !== false && $sandbox != null) $sendParams['sandbox'] = intval($sandbox);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('account.unregisterDevice', $sendParams);
    }
}