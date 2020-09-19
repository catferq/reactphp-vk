<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to edit hidden post.
 */
class EditAdsStealth
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    private string $message = '';
    private array $attachments = [];
    private bool $signed = false;
    private float $lat = 0;
    private float $long = 0;
    private int $placeId = 0;
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
     * @return EditAdsStealth
     */
    public function _setCustom(array $value): EditAdsStealth
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return EditAdsStealth
     */
    public function setOwnerId(int $value): EditAdsStealth
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Post ID. Used for publishing of scheduled and suggested posts.
     * 
     * @param int $value
     * @return EditAdsStealth
     */
    public function setPostId(int $value): EditAdsStealth
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the post.
     * 
     * @param string $value
     * @return EditAdsStealth
     */
    public function setMessage(string $value): EditAdsStealth
    {
        $this->message = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * 
     * @param array $value
     * @return EditAdsStealth
     */
    public function setAttachments(array $value): EditAdsStealth
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * 
     * @param bool $value
     * @return EditAdsStealth
     */
    public function setSigned(bool $value): EditAdsStealth
    {
        $this->signed = $value;
        return $this;
    }

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90).
     * 
     * @param float $value
     * @return EditAdsStealth
     */
    public function setLat(float $value): EditAdsStealth
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180).
     * 
     * @param float $value
     * @return EditAdsStealth
     */
    public function setLong(float $value): EditAdsStealth
    {
        $this->long = $value;
        return $this;
    }

    /**
     * ID of the location where the user was tagged.
     * 
     * @param int $value
     * @return EditAdsStealth
     */
    public function setPlaceId(int $value): EditAdsStealth
    {
        $this->placeId = $value;
        return $this;
    }

    /**
     * Link button ID
     * 
     * @param string $value
     * @return EditAdsStealth
     */
    public function setLinkButton(string $value): EditAdsStealth
    {
        $this->linkButton = $value;
        return $this;
    }

    /**
     * Link title
     * 
     * @param string $value
     * @return EditAdsStealth
     */
    public function setLinkTitle(string $value): EditAdsStealth
    {
        $this->linkTitle = $value;
        return $this;
    }

    /**
     * Link image url
     * 
     * @param string $value
     * @return EditAdsStealth
     */
    public function setLinkImage(string $value): EditAdsStealth
    {
        $this->linkImage = $value;
        return $this;
    }

    /**
     * Link video ID in format "<owner_id>_<media_id>"
     * 
     * @param string $value
     * @return EditAdsStealth
     */
    public function setLinkVideo(string $value): EditAdsStealth
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

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['post_id'] = $this->postId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->signed !== false) $params['signed'] = intval($this->signed);
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->placeId !== 0) $params['place_id'] = $this->placeId;
        if ($this->linkButton !== '') $params['link_button'] = $this->linkButton;
        if ($this->linkTitle !== '') $params['link_title'] = $this->linkTitle;
        if ($this->linkImage !== '') $params['link_image'] = $this->linkImage;
        if ($this->linkVideo !== '') $params['link_video'] = $this->linkVideo;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->message = '';
            $this->attachments = [];
            $this->signed = false;
            $this->lat = 0;
            $this->long = 0;
            $this->placeId = 0;
            $this->linkButton = '';
            $this->linkTitle = '';
            $this->linkImage = '';
            $this->linkVideo = '';
            $this->_custom = [];
        }

        return $this->_provider->request('wall.editAdsStealth', $params);
    }
}