<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Apps
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Deletes all request notifications from the current app.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function deleteAppRequests(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.deleteAppRequests', $sendParams);
    }

    /**
     * Returns applications data.
     * 
     * @param int|null $appId Application ID
     * @param array|null $appIds List of application ID
     * @param string|null $platform platform. Possible values: *'ios' — iOS,, *'android' — Android,, *'winphone' — Windows Phone,, *'web' — приложения на vk.com. By default: 'web'.
     * @param bool|null $extended
     * @param bool|null $returnFriends
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', (only if return_friends - 1)
     * @param string|null $nameCase Case for declension of user name and surname: 'nom' — nominative (default),, 'gen' — genitive,, 'dat' — dative,, 'acc' — accusative,, 'ins' — instrumental,, 'abl' — prepositional. (only if 'return_friends' = '1')
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $appId = 0, ?array $appIds = [], ?string $platform = 'web', ?bool $extended = false, ?bool $returnFriends = false, ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($appId !== 0 && $appId != null) $sendParams['app_id'] = $appId;
        if ($appIds !== [] && $appIds != null) $sendParams['app_ids'] = implode(',', $appIds);
        if ($platform !== 'web' && $platform != null) $sendParams['platform'] = $platform;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($returnFriends !== false && $returnFriends != null) $sendParams['return_friends'] = intval($returnFriends);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.get', $sendParams);
    }

    /**
     * Returns a list of applications (apps) available to users in the App Catalog.
     * 
     * @param int $count Number of apps to return.
     * @param string|null $sort Sort order: 'popular_today' — popular for one day (default), 'visitors' — by visitors number , 'create_date' — by creation date, 'growth_rate' — by growth rate, 'popular_week' — popular for one week
     * @param int|null $offset Offset required to return a specific subset of apps.
     * @param string|null $platform
     * @param bool|null $extended '1' — to return additional fields 'screenshots', 'MAU', 'catalog_position', and 'international'. If set, 'count' must be less than or equal to '100'. '0' — not to return additional fields (default).
     * @param bool|null $returnFriends
     * @param array|null $fields
     * @param string|null $nameCase
     * @param string|null $q Search query string.
     * @param int|null $genreId
     * @param string|null $filter 'installed' — to return list of installed apps (only for mobile platform).
     * @param array|null $custom
     * @return Promise
     */
    function getCatalog(int $count, ?string $sort = '', ?int $offset = 0, ?string $platform = '', ?bool $extended = false, ?bool $returnFriends = false, ?array $fields = [], ?string $nameCase = '', ?string $q = '', ?int $genreId = 0, ?string $filter = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['count'] = $count;
        if ($sort !== '' && $sort != null) $sendParams['sort'] = $sort;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($platform !== '' && $platform != null) $sendParams['platform'] = $platform;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($returnFriends !== false && $returnFriends != null) $sendParams['return_friends'] = intval($returnFriends);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($genreId !== 0 && $genreId != null) $sendParams['genre_id'] = $genreId;
        if ($filter !== '' && $filter != null) $sendParams['filter'] = $filter;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.getCatalog', $sendParams);
    }

    /**
     * Creates friends list for requests and invites in current app.
     * 
     * @param bool|null $extended
     * @param int|null $count List size.
     * @param int|null $offset
     * @param string|null $type List type. Possible values: * 'invite' — available for invites (don't play the game),, * 'request' — available for request (play the game). By default: 'invite'.
     * @param array|null $fields Additional profile fields, see [vk.com/dev/fields|description].
     * @param array|null $custom
     * @return Promise
     */
    function getFriendsList(?bool $extended = false, ?int $count = 20, ?int $offset = 0, ?string $type = 'invite', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($type !== 'invite' && $type != null) $sendParams['type'] = $type;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.getFriendsList', $sendParams);
    }

    /**
     * Returns players rating in the game.
     * 
     * @param string $type Leaderboard type. Possible values: *'level' — by level,, *'points' — by mission points,, *'score' — by score ().
     * @param bool|null $global Rating type. Possible values: *'1' — global rating among all players,, *'0' — rating among user friends.
     * @param bool|null $extended 1 — to return additional info about users
     * @param array|null $custom
     * @return Promise
     */
    function getLeaderboard(string $type, ?bool $global = true, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['type'] = $type;
        if ($global !== true && $global != null) $sendParams['global'] = intval($global);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.getLeaderboard', $sendParams);
    }

    /**
     * Returns scopes for auth
     * 
     * @param string|null $type
     * @param array|null $custom
     * @return Promise
     */
    function getScopes(?string $type = 'user', ?array $custom = [])
    {
        $sendParams = [];

        if ($type !== 'user' && $type != null) $sendParams['type'] = $type;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.getScopes', $sendParams);
    }

    /**
     * Returns user score in app
     * 
     * @param int $userId
     * @param array|null $custom
     * @return Promise
     */
    function getScore(int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.getScore', $sendParams);
    }

    /**
     * apps.promoHasActiveGift
     * 
     * @param int $promoId Id of game promo action
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function promoHasActiveGift(int $promoId, ?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['promo_id'] = $promoId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.promoHasActiveGift', $sendParams);
    }

    /**
     * apps.promoUseGift
     * 
     * @param int $promoId Id of game promo action
     * @param int|null $userId
     * @param array|null $custom
     * @return Promise
     */
    function promoUseGift(int $promoId, ?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['promo_id'] = $promoId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.promoUseGift', $sendParams);
    }

    /**
     * Sends a request to another user in an app that uses VK authorization.
     * 
     * @param int $userId id of the user to send a request
     * @param string|null $text request text
     * @param string|null $type request type. Values: 'invite' – if the request is sent to a user who does not have the app installed,, 'request' – if a user has already installed the app
     * @param string|null $name
     * @param string|null $key special string key to be sent with the request
     * @param bool|null $separate
     * @param array|null $custom
     * @return Promise
     */
    function sendRequest(int $userId, ?string $text = '', ?string $type = 'request', ?string $name = '', ?string $key = '', ?bool $separate = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        if ($text !== '' && $text != null) $sendParams['text'] = $text;
        if ($type !== 'request' && $type != null) $sendParams['type'] = $type;
        if ($name !== '' && $name != null) $sendParams['name'] = $name;
        if ($key !== '' && $key != null) $sendParams['key'] = $key;
        if ($separate !== false && $separate != null) $sendParams['separate'] = intval($separate);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('apps.sendRequest', $sendParams);
    }
}