<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Market
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Ads a new item to the market.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param string $name Item name.
     * @param string $description Item description.
     * @param int $categoryId Item category ID.
     * @param int $mainPhotoId Cover photo ID.
     * @param float|null $price Item price.
     * @param float|null $oldPrice
     * @param bool|null $deleted Item status ('1' — deleted, '0' — not deleted).
     * @param array|null $photoIds IDs of additional photos.
     * @param string|null $url Url for button in market item.
     * @param int|null $dimensionWidth
     * @param int|null $dimensionHeight
     * @param int|null $dimensionLength
     * @param int|null $weight
     * @param array|null $custom
     * @return Promise
     */
    function add(int $ownerId, string $name, string $description, int $categoryId, int $mainPhotoId, ?float $price = 0, ?float $oldPrice = 0, ?bool $deleted = false, ?array $photoIds = [], ?string $url = '', ?int $dimensionWidth = 0, ?int $dimensionHeight = 0, ?int $dimensionLength = 0, ?int $weight = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['name'] = $name;
        $sendParams['description'] = $description;
        $sendParams['category_id'] = $categoryId;
        $sendParams['main_photo_id'] = $mainPhotoId;
        if ($price !== 0 && $price != null) $sendParams['price'] = $price;
        if ($oldPrice !== 0 && $oldPrice != null) $sendParams['old_price'] = $oldPrice;
        if ($deleted !== false && $deleted != null) $sendParams['deleted'] = intval($deleted);
        if ($photoIds !== [] && $photoIds != null) $sendParams['photo_ids'] = implode(',', $photoIds);
        if ($url !== '' && $url != null) $sendParams['url'] = $url;
        if ($dimensionWidth !== 0 && $dimensionWidth != null) $sendParams['dimension_width'] = $dimensionWidth;
        if ($dimensionHeight !== 0 && $dimensionHeight != null) $sendParams['dimension_height'] = $dimensionHeight;
        if ($dimensionLength !== 0 && $dimensionLength != null) $sendParams['dimension_length'] = $dimensionLength;
        if ($weight !== 0 && $weight != null) $sendParams['weight'] = $weight;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.add', $sendParams);
    }

    /**
     * Creates new collection of items
     * 
     * @param int $ownerId ID of an item owner community.
     * @param string $title Collection title.
     * @param int|null $photoId Cover photo ID.
     * @param bool|null $mainAlbum Set as main ('1' – set, '0' – no).
     * @param array|null $custom
     * @return Promise
     */
    function addAlbum(int $ownerId, string $title, ?int $photoId = 0, ?bool $mainAlbum = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['title'] = $title;
        if ($photoId !== 0 && $photoId != null) $sendParams['photo_id'] = $photoId;
        if ($mainAlbum !== false && $mainAlbum != null) $sendParams['main_album'] = intval($mainAlbum);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.addAlbum', $sendParams);
    }

    /**
     * Adds an item to one or multiple collections.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param array $albumIds Collections IDs to add item to.
     * @param array|null $custom
     * @return Promise
     */
    function addToAlbum(int $ownerId, int $itemId, array $albumIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        $sendParams['album_ids'] = implode(',', $albumIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.addToAlbum', $sendParams);
    }

    /**
     * Creates a new comment for an item.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param string|null $message Comment text (required if 'attachments' parameter is not specified)
     * @param array|null $attachments Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
     * @param bool|null $fromGroup '1' - comment will be published on behalf of a community, '0' - on behalf of a user (by default).
     * @param int|null $replyToComment ID of a comment to reply with current comment to.
     * @param int|null $stickerId Sticker ID.
     * @param string|null $guid Random value to avoid resending one comment.
     * @param array|null $custom
     * @return Promise
     */
    function createComment(int $ownerId, int $itemId, ?string $message = '', ?array $attachments = [], ?bool $fromGroup = false, ?int $replyToComment = 0, ?int $stickerId = 0, ?string $guid = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($fromGroup !== false && $fromGroup != null) $sendParams['from_group'] = intval($fromGroup);
        if ($replyToComment !== 0 && $replyToComment != null) $sendParams['reply_to_comment'] = $replyToComment;
        if ($stickerId !== 0 && $stickerId != null) $sendParams['sticker_id'] = $stickerId;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.createComment', $sendParams);
    }

    /**
     * Deletes an item.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $ownerId, int $itemId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.delete', $sendParams);
    }

    /**
     * Deletes a collection of items.
     * 
     * @param int $ownerId ID of an collection owner community.
     * @param int $albumId Collection ID.
     * @param array|null $custom
     * @return Promise
     */
    function deleteAlbum(int $ownerId, int $albumId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['album_id'] = $albumId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.deleteAlbum', $sendParams);
    }

    /**
     * Deletes an item's comment
     * 
     * @param int $ownerId identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * @param int $commentId comment id
     * @param array|null $custom
     * @return Promise
     */
    function deleteComment(int $ownerId, int $commentId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['comment_id'] = $commentId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.deleteComment', $sendParams);
    }

    /**
     * Edits an item.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param string $name Item name.
     * @param string $description Item description.
     * @param int $categoryId Item category ID.
     * @param float $price Item price.
     * @param int $mainPhotoId Cover photo ID.
     * @param bool|null $deleted Item status ('1' — deleted, '0' — not deleted).
     * @param array|null $photoIds IDs of additional photos.
     * @param string|null $url Url for button in market item.
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $ownerId, int $itemId, string $name, string $description, int $categoryId, float $price, int $mainPhotoId, ?bool $deleted = false, ?array $photoIds = [], ?string $url = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        $sendParams['name'] = $name;
        $sendParams['description'] = $description;
        $sendParams['category_id'] = $categoryId;
        $sendParams['price'] = $price;
        $sendParams['main_photo_id'] = $mainPhotoId;
        if ($deleted !== false && $deleted != null) $sendParams['deleted'] = intval($deleted);
        if ($photoIds !== [] && $photoIds != null) $sendParams['photo_ids'] = implode(',', $photoIds);
        if ($url !== '' && $url != null) $sendParams['url'] = $url;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.edit', $sendParams);
    }

    /**
     * Edits a collection of items
     * 
     * @param int $ownerId ID of an collection owner community.
     * @param int $albumId Collection ID.
     * @param string $title Collection title.
     * @param int|null $photoId Cover photo id
     * @param bool|null $mainAlbum Set as main ('1' – set, '0' – no).
     * @param array|null $custom
     * @return Promise
     */
    function editAlbum(int $ownerId, int $albumId, string $title, ?int $photoId = 0, ?bool $mainAlbum = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['album_id'] = $albumId;
        $sendParams['title'] = $title;
        if ($photoId !== 0 && $photoId != null) $sendParams['photo_id'] = $photoId;
        if ($mainAlbum !== false && $mainAlbum != null) $sendParams['main_album'] = intval($mainAlbum);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.editAlbum', $sendParams);
    }

    /**
     * Chages item comment's text
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $commentId Comment ID.
     * @param string|null $message New comment text (required if 'attachments' are not specified), , 2048 symbols maximum.
     * @param array|null $attachments Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
     * @param array|null $custom
     * @return Promise
     */
    function editComment(int $ownerId, int $commentId, ?string $message = '', ?array $attachments = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['comment_id'] = $commentId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.editComment', $sendParams);
    }

    /**
     * Returns items list for a community.
     * 
     * @param int $ownerId ID of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * @param int|null $albumId
     * @param int|null $count Number of items to return.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param bool|null $extended '1' – method will return additional fields: 'likes, can_comment, car_repost, photos'. These parameters are not returned by default.
     * @param array|null $custom
     * @return Promise
     */
    function get(int $ownerId, ?int $albumId = 0, ?int $count = 100, ?int $offset = 0, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.get', $sendParams);
    }

    /**
     * Returns items album's data
     * 
     * @param int $ownerId identifier of an album owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * @param array $albumIds collections identifiers to obtain data from
     * @param array|null $custom
     * @return Promise
     */
    function getAlbumById(int $ownerId, array $albumIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['album_ids'] = implode(',', $albumIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.getAlbumById', $sendParams);
    }

    /**
     * Returns community's collections list.
     * 
     * @param int $ownerId ID of an items owner community.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of items to return.
     * @param array|null $custom
     * @return Promise
     */
    function getAlbums(int $ownerId, ?int $offset = 0, ?int $count = 50, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 50 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.getAlbums', $sendParams);
    }

    /**
     * Returns information about market items by their ids.
     * 
     * @param array $itemIds Comma-separated ids list: {user id}_{item id}. If an item belongs to a community -{community id} is used. " 'Videos' value example: , '-4363_136089719,13245770_137352259'"
     * @param bool|null $extended '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
     * @param array|null $custom
     * @return Promise
     */
    function getById(array $itemIds, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['item_ids'] = implode(',', $itemIds);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.getById', $sendParams);
    }

    /**
     * Returns a list of market categories.
     * 
     * @param int|null $count Number of results to return.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param array|null $custom
     * @return Promise
     */
    function getCategories(?int $count = 10, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($count !== 10 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.getCategories', $sendParams);
    }

    /**
     * Returns comments list for an item.
     * 
     * @param int $ownerId ID of an item owner community
     * @param int $itemId Item ID.
     * @param bool|null $needLikes '1' — to return likes info.
     * @param int|null $startCommentId ID of a comment to start a list from (details below).
     * @param int|null $offset
     * @param int|null $count Number of results to return.
     * @param string|null $sort Sort order ('asc' — from old to new, 'desc' — from new to old)
     * @param bool|null $extended '1' — comments will be returned as numbered objects, in addition lists of 'profiles' and 'groups' objects will be returned.
     * @param array|null $fields List of additional profile fields to return. See the [vk.com/dev/fields|details]
     * @param array|null $custom
     * @return Promise
     */
    function getComments(int $ownerId, int $itemId, ?bool $needLikes = false, ?int $startCommentId = 0, ?int $offset = 0, ?int $count = 20, ?string $sort = 'asc', ?bool $extended = false, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        if ($needLikes !== false && $needLikes != null) $sendParams['need_likes'] = intval($needLikes);
        if ($startCommentId !== 0 && $startCommentId != null) $sendParams['start_comment_id'] = $startCommentId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($sort !== 'asc' && $sort != null) $sendParams['sort'] = $sort;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.getComments', $sendParams);
    }

    /**
     * Removes an item from one or multiple collections.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param array $albumIds Collections IDs to remove item from.
     * @param array|null $custom
     * @return Promise
     */
    function removeFromAlbum(int $ownerId, int $itemId, array $albumIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        $sendParams['album_ids'] = implode(',', $albumIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.removeFromAlbum', $sendParams);
    }

    /**
     * Reorders the collections list.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $albumId Collection ID.
     * @param int|null $before ID of a collection to place current collection before it.
     * @param int|null $after ID of a collection to place current collection after it.
     * @param array|null $custom
     * @return Promise
     */
    function reorderAlbums(int $ownerId, int $albumId, ?int $before = 0, ?int $after = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['album_id'] = $albumId;
        if ($before !== 0 && $before != null) $sendParams['before'] = $before;
        if ($after !== 0 && $after != null) $sendParams['after'] = $after;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.reorderAlbums', $sendParams);
    }

    /**
     * Changes item place in a collection.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param int|null $albumId ID of a collection to reorder items in. Set 0 to reorder full items list.
     * @param int|null $before ID of an item to place current item before it.
     * @param int|null $after ID of an item to place current item after it.
     * @param array|null $custom
     * @return Promise
     */
    function reorderItems(int $ownerId, int $itemId, ?int $albumId = 0, ?int $before = 0, ?int $after = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($before !== 0 && $before != null) $sendParams['before'] = $before;
        if ($after !== 0 && $after != null) $sendParams['after'] = $after;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.reorderItems', $sendParams);
    }

    /**
     * Sends a complaint to the item.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Item ID.
     * @param int|null $reason Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' — insult.
     * @param array|null $custom
     * @return Promise
     */
    function report(int $ownerId, int $itemId, ?int $reason = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;
        if ($reason !== 0 && $reason != null) $sendParams['reason'] = $reason;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.report', $sendParams);
    }

    /**
     * Sends a complaint to the item's comment.
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $commentId Comment ID.
     * @param int $reason Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' — insult.
     * @param array|null $custom
     * @return Promise
     */
    function reportComment(int $ownerId, int $commentId, int $reason, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['comment_id'] = $commentId;
        $sendParams['reason'] = $reason;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.reportComment', $sendParams);
    }

    /**
     * Restores recently deleted item
     * 
     * @param int $ownerId ID of an item owner community.
     * @param int $itemId Deleted item ID.
     * @param array|null $custom
     * @return Promise
     */
    function restore(int $ownerId, int $itemId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['item_id'] = $itemId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.restore', $sendParams);
    }

    /**
     * Restores a recently deleted comment
     * 
     * @param int $ownerId identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * @param int $commentId deleted comment id
     * @param array|null $custom
     * @return Promise
     */
    function restoreComment(int $ownerId, int $commentId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['comment_id'] = $commentId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.restoreComment', $sendParams);
    }

    /**
     * Searches market items in a community's catalog
     * 
     * @param int $ownerId ID of an items owner community.
     * @param int|null $albumId
     * @param string|null $q Search query, for example "pink slippers".
     * @param int|null $priceFrom Minimum item price value.
     * @param int|null $priceTo Maximum item price value.
     * @param int|null $sort
     * @param int|null $rev '0' — do not use reverse order, '1' — use reverse order
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of items to return.
     * @param bool|null $extended '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
     * @param int|null $status
     * @param array|null $custom
     * @return Promise
     */
    function search(int $ownerId, ?int $albumId = 0, ?string $q = '', ?int $priceFrom = 0, ?int $priceTo = 0, ?int $sort = 0, ?int $rev = 1, ?int $offset = 0, ?int $count = 20, ?bool $extended = false, ?int $status = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        if ($albumId !== 0 && $albumId != null) $sendParams['album_id'] = $albumId;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($priceFrom !== 0 && $priceFrom != null) $sendParams['price_from'] = $priceFrom;
        if ($priceTo !== 0 && $priceTo != null) $sendParams['price_to'] = $priceTo;
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($rev !== 1 && $rev != null) $sendParams['rev'] = $rev;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($status !== 0 && $status != null) $sendParams['status'] = $status;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('market.search', $sendParams);
    }
}