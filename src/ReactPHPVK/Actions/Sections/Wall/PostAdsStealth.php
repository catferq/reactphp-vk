<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to create hidden post which will not be shown on the community's wall and can be used for creating an ad with type "Community post".
 */
class PostAdsStealth
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $message = '';
    private array $attachments = [];
    private bool $signed = false;
    private float $lat = 0;
    private float $long = 0;
    private int $placeId = 0;
    private string $guid = '';
    private string $linkButton = '';
    private string $linkTitle = '';
    private string $linkImage = '';
    private string $linkVideo = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return PostAdsStealth
     */
    public function _setCustom(array $value): PostAdsStealth
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return PostAdsStealth
     */
    public function setOwnerId(int $value): PostAdsStealth
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the post.
     * 
     * @param string $value
     * @return PostAdsStealth
     */
    public function setMessage(string $value): PostAdsStealth
    {
        $this->message = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * 
     * @param array $value
     * @return PostAdsStealth
     */
    public function setAttachments(array $value): PostAdsStealth
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * 
     * @param bool $value
     * @return PostAdsStealth
     */
    public function setSigned(bool $value): PostAdsStealth
    {
        $this->signed = $value;
        return $this;
    }

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90).
     * 
     * @param float $value
     * @return PostAdsStealth
     */
    public function setLat(float $value): PostAdsStealth
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180).
     * 
     * @param float $value
     * @return PostAdsStealth
     */
    public function setLong(float $value): PostAdsStealth
    {
        $this->long = $value;
        return $this;
    }

    /**
     * ID of the location where the user was tagged.
     * 
     * @param int $value
     * @return PostAdsStealth
     */
    public function setPlaceId(int $value): PostAdsStealth
    {
        $this->placeId = $value;
        return $this;
    }

    /**
     * Unique identifier to avoid duplication the same post.
     * 
     * @param string $value
     * @return PostAdsStealth
     */
    public function setGuid(string $value): PostAdsStealth
    {
        $this->guid = $value;
        return $this;
    }

    /**
     * Link button ID
     * 
     * @param string $value
     * @return PostAdsStealth
     */
    public function setLinkButton(string $value): PostAdsStealth
    {
        $this->linkButton = $value;
        return $this;
    }

    /**
     * Link title
     * 
     * @param string $value
     * @return PostAdsStealth
     */
    public function setLinkTitle(string $value): PostAdsStealth
    {
        $this->linkTitle = $value;
        return $this;
    }

    /**
     * Link image url
     * 
     * @param string $value
     * @return PostAdsStealth
     */
    public function setLinkImage(string $value): PostAdsStealth
    {
        $this->linkImage = $value;
        return $this;
    }

    /**
     * Link video ID in format "<owner_id>_<media_id>"
     * 
     * @param string $value
     * @return PostAdsStealth
     */
    public function setLinkVideo(string $value): PostAdsStealth
    {
        $this->linkVideo = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->signed !== false) $params['signed'] = intval($this->signed);
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->placeId !== 0) $params['place_id'] = $this->placeId;
        if ($this->guid !== '') $params['guid'] = $this->guid;
        if ($this->linkButton !== '') $params['link_button'] = $this->linkButton;
        if ($this->linkTitle !== '') $params['link_title'] = $this->linkTitle;
        if ($this->linkImage !== '') $params['link_image'] = $this->linkImage;
        if ($this->linkVideo !== '') $params['link_video'] = $this->linkVideo;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->signed = false;
            $this->lat = 0;
            $this->long = 0;
            $this->placeId = 0;
            $this->guid = '';
            $this->linkButton = '';
            $this->linkTitle = '';
            $this->linkImage = '';
            $this->linkVideo = '';
            $this->_custom = [];
        }

        return $this->_provider->request('wall.postAdsStealth', $params);
    }
}