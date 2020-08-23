<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Stories
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Allows to hide stories from chosen sources from current user's feed.
     * 
     * @param array $ownersIds List of sources IDs
     * @param array|null $custom
     * @return Promise
     */
    function banOwner(array $ownersIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owners_ids'] = implode(',', $ownersIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.banOwner', $sendParams);
    }

    /**
     * Allows to delete story.
     * 
     * @param int $ownerId Story owner's ID. Current user id is used by default.
     * @param int $storyId Story ID.
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $ownerId, int $storyId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['story_id'] = $storyId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.delete', $sendParams);
    }

    /**
     * Returns stories available for current user.
     * 
     * @param int|null $ownerId Owner ID.
     * @param bool|null $extended '1' — to return additional fields for users and communities. Default value is 0.
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $ownerId = 0, ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.get', $sendParams);
    }

    /**
     * Returns list of sources hidden from current user's feed.
     * 
     * @param bool|null $extended '1' — to return additional fields for users and communities. Default value is 0.
     * @param array|null $fields Additional fields to return
     * @param array|null $custom
     * @return Promise
     */
    function getBanned(?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getBanned', $sendParams);
    }

    /**
     * Returns story by its ID.
     * 
     * @param array $stories Stories IDs separated by commas. Use format {owner_id}+'_'+{story_id}, for example, 12345_54331.
     * @param bool|null $extended '1' — to return additional fields for users and communities. Default value is 0.
     * @param array|null $fields Additional fields to return
     * @param array|null $custom
     * @return Promise
     */
    function getById(array $stories, ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['stories'] = implode(',', $stories);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getById', $sendParams);
    }

    /**
     * Returns URL for uploading a story with photo.
     * 
     * @param bool|null $addToNews 1 — to add the story to friend's feed.
     * @param array|null $userIds List of users IDs who can see the story.
     * @param string|null $replyToStory ID of the story to reply with the current.
     * @param string|null $linkText Link text (for community's stories only).
     * @param string|null $linkUrl Link URL. Internal links on https://vk.com only.
     * @param int|null $groupId ID of the community to upload the story (should be verified or with the "fire" icon).
     * @param string|null $clickableStickers
     * @param array|null $custom
     * @return Promise
     */
    function getPhotoUploadServer(?bool $addToNews = false, ?array $userIds = [], ?string $replyToStory = '', ?string $linkText = '', ?string $linkUrl = '', ?int $groupId = 0, ?string $clickableStickers = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($addToNews !== false && $addToNews != null) $sendParams['add_to_news'] = intval($addToNews);
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($replyToStory !== '' && $replyToStory != null) $sendParams['reply_to_story'] = $replyToStory;
        if ($linkText !== '' && $linkText != null) $sendParams['link_text'] = $linkText;
        if ($linkUrl !== '' && $linkUrl != null) $sendParams['link_url'] = $linkUrl;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($clickableStickers !== '' && $clickableStickers != null) $sendParams['clickable_stickers'] = $clickableStickers;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getPhotoUploadServer', $sendParams);
    }

    /**
     * Returns replies to the story.
     * 
     * @param int $ownerId Story owner ID.
     * @param int $storyId Story ID.
     * @param string|null $accessKey Access key for the private object.
     * @param bool|null $extended '1' — to return additional fields for users and communities. Default value is 0.
     * @param array|null $fields Additional fields to return
     * @param array|null $custom
     * @return Promise
     */
    function getReplies(int $ownerId, int $storyId, ?string $accessKey = '', ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['story_id'] = $storyId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getReplies', $sendParams);
    }

    /**
     * Returns stories available for current user.
     * 
     * @param int $ownerId Story owner ID. 
     * @param int $storyId Story ID.
     * @param array|null $custom
     * @return Promise
     */
    function getStats(int $ownerId, int $storyId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['story_id'] = $storyId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getStats', $sendParams);
    }

    /**
     * Allows to receive URL for uploading story with video.
     * 
     * @param bool|null $addToNews 1 — to add the story to friend's feed.
     * @param array|null $userIds List of users IDs who can see the story.
     * @param string|null $replyToStory ID of the story to reply with the current.
     * @param string|null $linkText Link text (for community's stories only).
     * @param string|null $linkUrl Link URL. Internal links on https://vk.com only.
     * @param int|null $groupId ID of the community to upload the story (should be verified or with the "fire" icon).
     * @param string|null $clickableStickers
     * @param array|null $custom
     * @return Promise
     */
    function getVideoUploadServer(?bool $addToNews = false, ?array $userIds = [], ?string $replyToStory = '', ?string $linkText = '', ?string $linkUrl = '', ?int $groupId = 0, ?string $clickableStickers = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($addToNews !== false && $addToNews != null) $sendParams['add_to_news'] = intval($addToNews);
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($replyToStory !== '' && $replyToStory != null) $sendParams['reply_to_story'] = $replyToStory;
        if ($linkText !== '' && $linkText != null) $sendParams['link_text'] = $linkText;
        if ($linkUrl !== '' && $linkUrl != null) $sendParams['link_url'] = $linkUrl;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($clickableStickers !== '' && $clickableStickers != null) $sendParams['clickable_stickers'] = $clickableStickers;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getVideoUploadServer', $sendParams);
    }

    /**
     * Returns a list of story viewers.
     * 
     * @param int $ownerId Story owner ID.
     * @param int $storyId Story ID.
     * @param int|null $count Maximum number of results.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param bool|null $extended '1' — to return detailed information about photos
     * @param array|null $custom
     * @return Promise
     */
    function getViewers(int $ownerId, int $storyId, ?int $count = 100, ?int $offset = 0, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['story_id'] = $storyId;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.getViewers', $sendParams);
    }

    /**
     * Hides all replies in the last 24 hours from the user to current user's stories.
     * 
     * @param int $ownerId ID of the user whose replies should be hidden.
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function hideAllReplies(int $ownerId, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.hideAllReplies', $sendParams);
    }

    /**
     * Hides the reply to the current user's story.
     * 
     * @param int $ownerId ID of the user whose replies should be hidden.
     * @param int $storyId Story ID.
     * @param array|null $custom
     * @return Promise
     */
    function hideReply(int $ownerId, int $storyId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['story_id'] = $storyId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.hideReply', $sendParams);
    }

    /**
     * stories.search
     * 
     * @param string|null $q
     * @param int|null $placeId
     * @param float|null $latitude
     * @param float|null $longitude
     * @param int|null $radius
     * @param int|null $mentionedId
     * @param int|null $count
     * @param bool|null $extended
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function search(?string $q = '', ?int $placeId = 0, ?float $latitude = 0, ?float $longitude = 0, ?int $radius = 0, ?int $mentionedId = 0, ?int $count = 20, ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($placeId !== 0 && $placeId != null) $sendParams['place_id'] = $placeId;
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($radius !== 0 && $radius != null) $sendParams['radius'] = $radius;
        if ($mentionedId !== 0 && $mentionedId != null) $sendParams['mentioned_id'] = $mentionedId;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.search', $sendParams);
    }

    /**
     * Allows to show stories from hidden sources in current user's feed.
     * 
     * @param array $ownersIds List of hidden sources to show stories from.
     * @param array|null $custom
     * @return Promise
     */
    function unbanOwner(array $ownersIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owners_ids'] = implode(',', $ownersIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('stories.unbanOwner', $sendParams);
    }
}