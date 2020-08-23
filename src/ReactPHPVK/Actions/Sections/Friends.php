<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Friends
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Approves or creates a friend request.
     * 
     * @param int|null $userId ID of the user whose friend request will be approved or to whom a friend request will be sent.
     * @param string|null $text Text of the message (up to 500 characters) for the friend request, if any.
     * @param bool|null $follow '1' to pass an incoming request to followers list.
     * @param array|null $custom
     * @return Promise
     */
    function add(?int $userId = 0, ?string $text = '', ?bool $follow = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($text !== '' && $text != null) $sendParams['text'] = $text;
        if ($follow !== false && $follow != null) $sendParams['follow'] = intval($follow);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.add', $sendParams);
    }

    /**
     * Creates a new friend list for the current user.
     * 
     * @param string $name Name of the friend list.
     * @param array|null $userIds IDs of users to be added to the friend list.
     * @param array|null $custom
     * @return Promise
     */
    function addList(string $name, ?array $userIds = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['name'] = $name;
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.addList', $sendParams);
    }

    /**
     * Checks the current user's friendship status with other specified users.
     * 
     * @param array $userIds IDs of the users whose friendship status to check.
     * @param bool|null $needSign '1' — to return 'sign' field. 'sign' is md5("{id}_{user_id}_{friends_status}_{application_secret}"), where id is current user ID. This field allows to check that data has not been modified by the client. By default: '0'.
     * @param bool|null $extended Return friend request read_state field
     * @param array|null $custom
     * @return Promise
     */
    function areFriends(array $userIds, ?bool $needSign = false, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_ids'] = implode(',', $userIds);
        if ($needSign !== false && $needSign != null) $sendParams['need_sign'] = intval($needSign);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.areFriends', $sendParams);
    }

    /**
     * Declines a friend request or deletes a user from the current user's friend list.
     * 
     * @param int|null $userId ID of the user whose friend request is to be declined or who is to be deleted from the current user's friend list.
     * @param array|null $custom
     * @return Promise
     */
    function delete(?int $userId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.delete', $sendParams);
    }

    /**
     * Marks all incoming friend requests as viewed.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function deleteAllRequests(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.deleteAllRequests', $sendParams);
    }

    /**
     * Deletes a friend list of the current user.
     * 
     * @param int $listId ID of the friend list to delete.
     * @param array|null $custom
     * @return Promise
     */
    function deleteList(int $listId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['list_id'] = $listId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.deleteList', $sendParams);
    }

    /**
     * Edits the friend lists of the selected user.
     * 
     * @param int $userId ID of the user whose friend list is to be edited.
     * @param array|null $listIds IDs of the friend lists to which to add the user.
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $userId, ?array $listIds = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        if ($listIds !== [] && $listIds != null) $sendParams['list_ids'] = implode(',', $listIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.edit', $sendParams);
    }

    /**
     * Edits a friend list of the current user.
     * 
     * @param int $listId Friend list ID.
     * @param string|null $name Name of the friend list.
     * @param array|null $userIds IDs of users in the friend list.
     * @param array|null $addUserIds (Applies if 'user_ids' parameter is not set.), User IDs to add to the friend list.
     * @param array|null $deleteUserIds (Applies if 'user_ids' parameter is not set.), User IDs to delete from the friend list.
     * @param array|null $custom
     * @return Promise
     */
    function editList(int $listId, ?string $name = '', ?array $userIds = [], ?array $addUserIds = [], ?array $deleteUserIds = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['list_id'] = $listId;
        if ($name !== '' && $name != null) $sendParams['name'] = $name;
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($addUserIds !== [] && $addUserIds != null) $sendParams['add_user_ids'] = implode(',', $addUserIds);
        if ($deleteUserIds !== [] && $deleteUserIds != null) $sendParams['delete_user_ids'] = implode(',', $deleteUserIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.editList', $sendParams);
    }

    /**
     * Returns a list of user IDs or detailed information about a user's friends.
     * 
     * @param int|null $userId User ID. By default, the current user ID.
     * @param string|null $order Sort order: , 'name' — by name (enabled only if the 'fields' parameter is used), 'hints' — by rating, similar to how friends are sorted in My friends section, , This parameter is available only for [vk.com/dev/standalone|desktop applications].
     * @param int|null $listId ID of the friend list returned by the [vk.com/dev/friends.getLists|friends.getLists] method to be used as the source. This parameter is taken into account only when the uid parameter is set to the current user ID. This parameter is available only for [vk.com/dev/standalone|desktop applications].
     * @param int|null $count Number of friends to return.
     * @param int|null $offset Offset needed to return a specific subset of friends.
     * @param array|null $fields Profile fields to return. Sample values: 'uid', 'first_name', 'last_name', 'nickname', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'domain', 'has_mobile', 'rate', 'contacts', 'education'.
     * @param string|null $nameCase Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param string|null $ref
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $userId = 0, ?string $order = '', ?int $listId = 0, ?int $count = 5000, ?int $offset = 0, ?array $fields = [], ?string $nameCase = '', ?string $ref = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($order !== '' && $order != null) $sendParams['order'] = $order;
        if ($listId !== 0 && $listId != null) $sendParams['list_id'] = $listId;
        if ($count !== 5000 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;
        if ($ref !== '' && $ref != null) $sendParams['ref'] = $ref;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.get', $sendParams);
    }

    /**
     * Returns a list of IDs of the current user's friends who installed the application.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getAppUsers(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getAppUsers', $sendParams);
    }

    /**
     * Returns a list of the current user's friends whose phone numbers, validated or specified in a profile, are in a given list.
     * 
     * @param array|null $phones List of phone numbers in MSISDN format (maximum 1000). Example: "+79219876543,+79111234567"
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online, counters'.
     * @param array|null $custom
     * @return Promise
     */
    function getByPhones(?array $phones = [], ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($phones !== [] && $phones != null) $sendParams['phones'] = implode(',', $phones);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getByPhones', $sendParams);
    }

    /**
     * Returns a list of the user's friend lists.
     * 
     * @param int|null $userId User ID.
     * @param bool|null $returnSystem '1' — to return system friend lists. By default: '0'.
     * @param array|null $custom
     * @return Promise
     */
    function getLists(?int $userId = 0, ?bool $returnSystem = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($returnSystem !== false && $returnSystem != null) $sendParams['return_system'] = intval($returnSystem);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getLists', $sendParams);
    }

    /**
     * Returns a list of user IDs of the mutual friends of two users.
     * 
     * @param int|null $sourceUid ID of the user whose friends will be checked against the friends of the user specified in 'target_uid'.
     * @param int|null $targetUid ID of the user whose friends will be checked against the friends of the user specified in 'source_uid'.
     * @param array|null $targetUids IDs of the users whose friends will be checked against the friends of the user specified in 'source_uid'.
     * @param string|null $order Sort order: 'random' — random order
     * @param int|null $count Number of mutual friends to return.
     * @param int|null $offset Offset needed to return a specific subset of mutual friends.
     * @param array|null $custom
     * @return Promise
     */
    function getMutual(?int $sourceUid = 0, ?int $targetUid = 0, ?array $targetUids = [], ?string $order = '', ?int $count = 0, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($sourceUid !== 0 && $sourceUid != null) $sendParams['source_uid'] = $sourceUid;
        if ($targetUid !== 0 && $targetUid != null) $sendParams['target_uid'] = $targetUid;
        if ($targetUids !== [] && $targetUids != null) $sendParams['target_uids'] = implode(',', $targetUids);
        if ($order !== '' && $order != null) $sendParams['order'] = $order;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getMutual', $sendParams);
    }

    /**
     * Returns a list of user IDs of a user's friends who are online.
     * 
     * @param int|null $userId User ID.
     * @param int|null $listId Friend list ID. If this parameter is not set, information about all online friends is returned.
     * @param bool|null $onlineMobile '1' — to return an additional 'online_mobile' field, '0' — (default),
     * @param string|null $order Sort order: 'random' — random order
     * @param int|null $count Number of friends to return.
     * @param int|null $offset Offset needed to return a specific subset of friends.
     * @param array|null $custom
     * @return Promise
     */
    function getOnline(?int $userId = 0, ?int $listId = 0, ?bool $onlineMobile = false, ?string $order = '', ?int $count = 0, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($listId !== 0 && $listId != null) $sendParams['list_id'] = $listId;
        if ($onlineMobile !== false && $onlineMobile != null) $sendParams['online_mobile'] = intval($onlineMobile);
        if ($order !== '' && $order != null) $sendParams['order'] = $order;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getOnline', $sendParams);
    }

    /**
     * Returns a list of user IDs of the current user's recently added friends.
     * 
     * @param int|null $count Number of recently added friends to return.
     * @param array|null $custom
     * @return Promise
     */
    function getRecent(?int $count = 100, ?array $custom = [])
    {
        $sendParams = [];

        if ($count !== 100 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getRecent', $sendParams);
    }

    /**
     * Returns information about the current user's incoming and outgoing friend requests.
     * 
     * @param int|null $offset Offset needed to return a specific subset of friend requests.
     * @param int|null $count Number of friend requests to return (default 100, maximum 1000).
     * @param bool|null $extended '1' — to return response messages from users who have sent a friend request or, if 'suggested' is set to '1', to return a list of suggested friends
     * @param bool|null $needMutual '1' — to return a list of mutual friends (up to 20), if any
     * @param bool|null $out '1' — to return outgoing requests, '0' — to return incoming requests (default)
     * @param int|null $sort Sort order: '1' — by number of mutual friends, '0' — by date
     * @param bool|null $needViewed
     * @param bool|null $suggested '1' — to return a list of suggested friends, '0' — to return friend requests (default)
     * @param string|null $ref
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getRequests(?int $offset = 0, ?int $count = 100, ?bool $extended = false, ?bool $needMutual = false, ?bool $out = false, ?int $sort = 0, ?bool $needViewed = false, ?bool $suggested = false, ?string $ref = '', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($needMutual !== false && $needMutual != null) $sendParams['need_mutual'] = intval($needMutual);
        if ($out !== false && $out != null) $sendParams['out'] = intval($out);
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($needViewed !== false && $needViewed != null) $sendParams['need_viewed'] = intval($needViewed);
        if ($suggested !== false && $suggested != null) $sendParams['suggested'] = intval($suggested);
        if ($ref !== '' && $ref != null) $sendParams['ref'] = $ref;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getRequests', $sendParams);
    }

    /**
     * Returns a list of profiles of users whom the current user may know.
     * 
     * @param array|null $filter Types of potential friends to return: 'mutual' — users with many mutual friends , 'contacts' — users found with the [vk.com/dev/account.importContacts|account.importContacts] method , 'mutual_contacts' — users who imported the same contacts as the current user with the [vk.com/dev/account.importContacts|account.importContacts] method
     * @param int|null $count Number of suggestions to return.
     * @param int|null $offset Offset needed to return a specific subset of suggestions.
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online', 'counters'.
     * @param string|null $nameCase Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param array|null $custom
     * @return Promise
     */
    function getSuggestions(?array $filter = [], ?int $count = 500, ?int $offset = 0, ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($filter !== [] && $filter != null) $sendParams['filter'] = implode(',', $filter);
        if ($count !== 500 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.getSuggestions', $sendParams);
    }

    /**
     * Returns a list of friends matching the search criteria.
     * 
     * @param int $userId User ID.
     * @param string|null $q Search query string (e.g., 'Vasya Babich').
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online',
     * @param string|null $nameCase Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param int|null $offset Offset needed to return a specific subset of friends.
     * @param int|null $count Number of friends to return.
     * @param array|null $custom
     * @return Promise
     */
    function search(int $userId, ?string $q = '', ?array $fields = [], ?string $nameCase = 'Nom', ?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== 'Nom' && $nameCase != null) $sendParams['name_case'] = $nameCase;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('friends.search', $sendParams);
    }
}