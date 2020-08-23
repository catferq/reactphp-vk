<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Fave
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * fave.addArticle
     * 
     * @param string $url
     * @param array|null $custom
     * @return Promise
     */
    function addArticle(string $url, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['url'] = $url;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addArticle', $sendParams);
    }

    /**
     * Adds a link to user faves.
     * 
     * @param string $link Link URL.
     * @param array|null $custom
     * @return Promise
     */
    function addLink(string $link, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['link'] = $link;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addLink', $sendParams);
    }

    /**
     * fave.addPage
     * 
     * @param int|null $userId
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function addPage(?int $userId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addPage', $sendParams);
    }

    /**
     * fave.addPost
     * 
     * @param int $ownerId
     * @param int $id
     * @param string|null $accessKey
     * @param array|null $custom
     * @return Promise
     */
    function addPost(int $ownerId, int $id, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['id'] = $id;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addPost', $sendParams);
    }

    /**
     * fave.addProduct
     * 
     * @param int $ownerId
     * @param int $id
     * @param string|null $accessKey
     * @param array|null $custom
     * @return Promise
     */
    function addProduct(int $ownerId, int $id, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['id'] = $id;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addProduct', $sendParams);
    }

    /**
     * fave.addTag
     * 
     * @param string|null $name
     * @param string|null $position
     * @param array|null $custom
     * @return Promise
     */
    function addTag(?string $name = '', ?string $position = 'back', ?array $custom = [])
    {
        $sendParams = [];

        if ($name !== '' && $name != null) $sendParams['name'] = $name;
        if ($position !== 'back' && $position != null) $sendParams['position'] = $position;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addTag', $sendParams);
    }

    /**
     * fave.addVideo
     * 
     * @param int $ownerId
     * @param int $id
     * @param string|null $accessKey
     * @param array|null $custom
     * @return Promise
     */
    function addVideo(int $ownerId, int $id, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['id'] = $id;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.addVideo', $sendParams);
    }

    /**
     * fave.editTag
     * 
     * @param int $id
     * @param string $name
     * @param array|null $custom
     * @return Promise
     */
    function editTag(int $id, string $name, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['id'] = $id;
        $sendParams['name'] = $name;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.editTag', $sendParams);
    }

    /**
     * fave.get
     * 
     * @param bool|null $extended '1' — to return additional 'wall', 'profiles', and 'groups' fields. By default: '0'.
     * @param string|null $itemType
     * @param int|null $tagId Tag ID.
     * @param int|null $offset Offset needed to return a specific subset of users.
     * @param int|null $count Number of users to return.
     * @param string|null $fields
     * @param bool|null $isFromSnackbar
     * @param array|null $custom
     * @return Promise
     */
    function get(?bool $extended = false, ?string $itemType = '', ?int $tagId = 0, ?int $offset = 0, ?int $count = 50, ?string $fields = '', ?bool $isFromSnackbar = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($itemType !== '' && $itemType != null) $sendParams['item_type'] = $itemType;
        if ($tagId !== 0 && $tagId != null) $sendParams['tag_id'] = $tagId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 50 && $count != null) $sendParams['count'] = $count;
        if ($fields !== '' && $fields != null) $sendParams['fields'] = $fields;
        if ($isFromSnackbar !== false && $isFromSnackbar != null) $sendParams['is_from_snackbar'] = intval($isFromSnackbar);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.get', $sendParams);
    }

    /**
     * fave.getPages
     * 
     * @param int|null $offset
     * @param int|null $count
     * @param string|null $type
     * @param array|null $fields
     * @param int|null $tagId
     * @param array|null $custom
     * @return Promise
     */
    function getPages(?int $offset = 0, ?int $count = 50, ?string $type = '', ?array $fields = [], ?int $tagId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 50 && $count != null) $sendParams['count'] = $count;
        if ($type !== '' && $type != null) $sendParams['type'] = $type;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($tagId !== 0 && $tagId != null) $sendParams['tag_id'] = $tagId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.getPages', $sendParams);
    }

    /**
     * fave.getTags
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getTags(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.getTags', $sendParams);
    }

    /**
     * fave.markSeen
     * 
     * @param array|null $custom
     * @return Promise
     */
    function markSeen(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.markSeen', $sendParams);
    }

    /**
     * fave.removeArticle
     * 
     * @param int $ownerId
     * @param int $articleId
     * @param array|null $custom
     * @return Promise
     */
    function removeArticle(int $ownerId, int $articleId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['article_id'] = $articleId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.removeArticle', $sendParams);
    }

    /**
     * Removes link from the user's faves.
     * 
     * @param string|null $linkId Link ID (can be obtained by [vk.com/dev/faves.getLinks|faves.getLinks] method).
     * @param string|null $link Link URL
     * @param array|null $custom
     * @return Promise
     */
    function removeLink(?string $linkId = '', ?string $link = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($linkId !== '' && $linkId != null) $sendParams['link_id'] = $linkId;
        if ($link !== '' && $link != null) $sendParams['link'] = $link;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.removeLink', $sendParams);
    }

    /**
     * fave.removePage
     * 
     * @param int|null $userId
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function removePage(?int $userId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.removePage', $sendParams);
    }

    /**
     * fave.removePost
     * 
     * @param int $ownerId
     * @param int $id
     * @param array|null $custom
     * @return Promise
     */
    function removePost(int $ownerId, int $id, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['id'] = $id;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.removePost', $sendParams);
    }

    /**
     * fave.removeProduct
     * 
     * @param int $ownerId
     * @param int $id
     * @param array|null $custom
     * @return Promise
     */
    function removeProduct(int $ownerId, int $id, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['id'] = $id;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.removeProduct', $sendParams);
    }

    /**
     * fave.removeTag
     * 
     * @param int $id
     * @param array|null $custom
     * @return Promise
     */
    function removeTag(int $id, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['id'] = $id;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.removeTag', $sendParams);
    }

    /**
     * fave.reorderTags
     * 
     * @param array $ids
     * @param array|null $custom
     * @return Promise
     */
    function reorderTags(array $ids, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['ids'] = implode(',', $ids);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.reorderTags', $sendParams);
    }

    /**
     * fave.setPageTags
     * 
     * @param int|null $userId
     * @param int|null $groupId
     * @param array|null $tagIds
     * @param array|null $custom
     * @return Promise
     */
    function setPageTags(?int $userId = 0, ?int $groupId = 0, ?array $tagIds = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($tagIds !== [] && $tagIds != null) $sendParams['tag_ids'] = implode(',', $tagIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.setPageTags', $sendParams);
    }

    /**
     * fave.setTags
     * 
     * @param string|null $itemType
     * @param int|null $itemOwnerId
     * @param int|null $itemId
     * @param array|null $tagIds
     * @param string|null $linkId
     * @param string|null $linkUrl
     * @param array|null $custom
     * @return Promise
     */
    function setTags(?string $itemType = '', ?int $itemOwnerId = 0, ?int $itemId = 0, ?array $tagIds = [], ?string $linkId = '', ?string $linkUrl = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($itemType !== '' && $itemType != null) $sendParams['item_type'] = $itemType;
        if ($itemOwnerId !== 0 && $itemOwnerId != null) $sendParams['item_owner_id'] = $itemOwnerId;
        if ($itemId !== 0 && $itemId != null) $sendParams['item_id'] = $itemId;
        if ($tagIds !== [] && $tagIds != null) $sendParams['tag_ids'] = implode(',', $tagIds);
        if ($linkId !== '' && $linkId != null) $sendParams['link_id'] = $linkId;
        if ($linkUrl !== '' && $linkUrl != null) $sendParams['link_url'] = $linkUrl;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.setTags', $sendParams);
    }

    /**
     * fave.trackPageInteraction
     * 
     * @param int|null $userId
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function trackPageInteraction(?int $userId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('fave.trackPageInteraction', $sendParams);
    }
}