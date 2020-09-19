<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a post on a user wall or community wall.
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    private bool $friendsOnly = false;
    private string $message = '';
    private array $attachments = [];
    private string $services = '';
    private bool $signed = false;
    private int $publishDate = 0;
    private float $lat = 0;
    private float $long = 0;
    private int $placeId = 0;
    private bool $markAsAds = false;
    private bool $closeComments = false;
    private int $posterBkgId = 0;
    private int $posterBkgOwnerId = 0;
    private string $posterBkgAccessHash = '';
    private string $copyright = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setOwnerId(int $value): Edit
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setPostId(int $value): Edit
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setFriendsOnly(bool $value): Edit
    {
        $this->friendsOnly = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the post.
     * 
     * @param string $value
     * @return Edit
     */
    public function setMessage(string $value): Edit
    {
        $this->message = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error is thrown."
     * 
     * @param array $value
     * @return Edit
     */
    public function setAttachments(array $value): Edit
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setServices(string $value): Edit
    {
        $this->services = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setSigned(bool $value): Edit
    {
        $this->signed = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setPublishDate(int $value): Edit
    {
        $this->publishDate = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Edit
     */
    public function setLat(float $value): Edit
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Edit
     */
    public function setLong(float $value): Edit
    {
        $this->long = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setPlaceId(int $value): Edit
    {
        $this->placeId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setMarkAsAds(bool $value): Edit
    {
        $this->markAsAds = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setCloseComments(bool $value): Edit
    {
        $this->closeComments = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setPosterBkgId(int $value): Edit
    {
        $this->posterBkgId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setPosterBkgOwnerId(int $value): Edit
    {
        $this->posterBkgOwnerId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setPosterBkgAccessHash(string $value): Edit
    {
        $this->posterBkgAccessHash = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setCopyright(string $value): Edit
    {
        $this->copyright = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['post_id'] = $this->postId;
        if ($this->friendsOnly !== false) $params['friends_only'] = intval($this->friendsOnly);
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->services !== '') $params['services'] = $this->services;
        if ($this->signed !== false) $params['signed'] = intval($this->signed);
        if ($this->publishDate !== 0) $params['publish_date'] = $this->publishDate;
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->placeId !== 0) $params['place_id'] = $this->placeId;
        if ($this->markAsAds !== false) $params['mark_as_ads'] = intval($this->markAsAds);
        if ($this->closeComments !== false) $params['close_comments'] = intval($this->closeComments);
        if ($this->posterBkgId !== 0) $params['poster_bkg_id'] = $this->posterBkgId;
        if ($this->posterBkgOwnerId !== 0) $params['poster_bkg_owner_id'] = $this->posterBkgOwnerId;
        if ($this->posterBkgAccessHash !== '') $params['poster_bkg_access_hash'] = $this->posterBkgAccessHash;
        if ($this->copyright !== '') $params['copyright'] = $this->copyright;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->friendsOnly = false;
            $this->message = '';
            $this->attachments = [];
            $this->services = '';
            $this->signed = false;
            $this->publishDate = 0;
            $this->lat = 0;
            $this->long = 0;
            $this->placeId = 0;
            $this->markAsAds = false;
            $this->closeComments = false;
            $this->posterBkgId = 0;
            $this->posterBkgOwnerId = 0;
            $this->posterBkgAccessHash = '';
            $this->copyright = '';
            $this->_custom = [];
        }

        return $this->_provider->request('wall.edit', $params);
    }
}