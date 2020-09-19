<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits information about a video on a user or community page.
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $videoId = 0;
    private string $name = '';
    private string $desc = '';
    private array $privacyView = [];
    private array $privacyComment = [];
    private bool $noComments = false;
    private bool $repeat = false;
    
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
     * ID of the user or community that owns the video.
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
     * Video ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setVideoId(int $value): Edit
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * New video title.
     * 
     * @param string $value
     * @return Edit
     */
    public function setName(string $value): Edit
    {
        $this->name = $value;
        return $this;
    }

    /**
     * New video description.
     * 
     * @param string $value
     * @return Edit
     */
    public function setDesc(string $value): Edit
    {
        $this->desc = $value;
        return $this;
    }

    /**
     * Privacy settings in a [vk.com/dev/privacy_setting|special format]. Privacy setting is available for videos uploaded to own profile by user.
     * 
     * @param array $value
     * @return Edit
     */
    public function setPrivacyView(array $value): Edit
    {
        $this->privacyView = $value;
        return $this;
    }

    /**
     * Privacy settings for comments in a [vk.com/dev/privacy_setting|special format].
     * 
     * @param array $value
     * @return Edit
     */
    public function setPrivacyComment(array $value): Edit
    {
        $this->privacyComment = $value;
        return $this;
    }

    /**
     * Disable comments for the group video.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setNoComments(bool $value): Edit
    {
        $this->noComments = $value;
        return $this;
    }

    /**
     * '1' — to repeat the playback of the video, '0' — to play the video once,
     * 
     * @param bool $value
     * @return Edit
     */
    public function setRepeat(bool $value): Edit
    {
        $this->repeat = $value;
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
        $params['video_id'] = $this->videoId;
        if ($this->name !== '') $params['name'] = $this->name;
        if ($this->desc !== '') $params['desc'] = $this->desc;
        if ($this->privacyView !== []) $params['privacy_view'] = implode(',', $this->privacyView);
        if ($this->privacyComment !== []) $params['privacy_comment'] = implode(',', $this->privacyComment);
        if ($this->noComments !== false) $params['no_comments'] = intval($this->noComments);
        if ($this->repeat !== false) $params['repeat'] = intval($this->repeat);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->videoId = 0;
            $this->name = '';
            $this->desc = '';
            $this->privacyView = [];
            $this->privacyComment = [];
            $this->noComments = false;
            $this->repeat = false;
            $this->_custom = [];
        }

        return $this->_provider->request('video.edit', $params);
    }
}