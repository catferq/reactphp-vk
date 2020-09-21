<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a new post on a user wall or community wall. Can also be used to publish suggested or scheduled posts.
 */
class Post
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private bool $friendsOnly = false;
    private bool $fromGroup = false;
    private string $message = '';
    private array $attachments = [];
    private string $services = '';
    private bool $signed = false;
    private int $publishDate = 0;
    private float $lat = 0;
    private float $long = 0;
    private int $placeId = 0;
    private int $postId = 0;
    private string $guid = '';
    private bool $markAsAds = false;
    private bool $closeComments = false;
    private bool $muteNotifications = false;
    private string $copyright = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Post
     */
    public function _setCustom(array $value): Post
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Post
     */
    public function setOwnerId(int $value): Post
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * '1' — post will be available to friends only, '0' — post will be available to all users (default)
     * 
     * @param bool $value
     * @return Post
     */
    public function setFriendsOnly(bool $value): Post
    {
        $this->friendsOnly = $value;
        return $this;
    }

    /**
     * For a community: '1' — post will be published by the community, '0' — post will be published by the user (default)
     * 
     * @param bool $value
     * @return Post
     */
    public function setFromGroup(bool $value): Post
    {
        $this->fromGroup = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the post.
     * 
     * @param string $value
     * @return Post
     */
    public function setMessage(string $value): Post
    {
        $this->message = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * 
     * @param array $value
     * @return Post
     */
    public function setAttachments(array $value): Post
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * List of services or websites the update will be exported to, if the user has so requested. Sample values: 'twitter', 'facebook'.
     * 
     * @param string $value
     * @return Post
     */
    public function setServices(string $value): Post
    {
        $this->services = $value;
        return $this;
    }

    /**
     * Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * 
     * @param bool $value
     * @return Post
     */
    public function setSigned(bool $value): Post
    {
        $this->signed = $value;
        return $this;
    }

    /**
     * Publication date (in Unix time). If used, posting will be delayed until the set time.
     * 
     * @param int $value
     * @return Post
     */
    public function setPublishDate(int $value): Post
    {
        $this->publishDate = $value;
        return $this;
    }

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90).
     * 
     * @param float $value
     * @return Post
     */
    public function setLat(float $value): Post
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180).
     * 
     * @param float $value
     * @return Post
     */
    public function setLong(float $value): Post
    {
        $this->long = $value;
        return $this;
    }

    /**
     * ID of the location where the user was tagged.
     * 
     * @param int $value
     * @return Post
     */
    public function setPlaceId(int $value): Post
    {
        $this->placeId = $value;
        return $this;
    }

    /**
     * Post ID. Used for publishing of scheduled and suggested posts.
     * 
     * @param int $value
     * @return Post
     */
    public function setPostId(int $value): Post
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Post
     */
    public function setGuid(string $value): Post
    {
        $this->guid = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Post
     */
    public function setMarkAsAds(bool $value): Post
    {
        $this->markAsAds = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Post
     */
    public function setCloseComments(bool $value): Post
    {
        $this->closeComments = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Post
     */
    public function setMuteNotifications(bool $value): Post
    {
        $this->muteNotifications = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Post
     */
    public function setCopyright(string $value): Post
    {
        $this->copyright = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->friendsOnly !== false) $params['friends_only'] = intval($this->friendsOnly);
        if ($this->fromGroup !== false) $params['from_group'] = intval($this->fromGroup);
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->services !== '') $params['services'] = $this->services;
        if ($this->signed !== false) $params['signed'] = intval($this->signed);
        if ($this->publishDate !== 0) $params['publish_date'] = $this->publishDate;
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->placeId !== 0) $params['place_id'] = $this->placeId;
        if ($this->postId !== 0) $params['post_id'] = $this->postId;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->markAsAds !== false) $params['mark_as_ads'] = intval($this->markAsAds);
        if ($this->closeComments !== false) $params['close_comments'] = intval($this->closeComments);
        if ($this->muteNotifications !== false) $params['mute_notifications'] = intval($this->muteNotifications);
        if ($this->copyright !== '') $params['copyright'] = $this->copyright;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->friendsOnly = false;
            $this->fromGroup = false;
            $this->message = '';
            $this->attachments = [];
            $this->services = '';
            $this->signed = false;
            $this->publishDate = 0;
            $this->lat = 0;
            $this->long = 0;
            $this->placeId = 0;
            $this->postId = 0;
            $this->guid = '';
            $this->markAsAds = false;
            $this->closeComments = false;
            $this->muteNotifications = false;
            $this->copyright = '';
            $this->_custom = [];
        }

        return $this->_provider->request('wall.post', $params);
    }
}