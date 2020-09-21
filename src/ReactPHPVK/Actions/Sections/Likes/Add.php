<?php

namespace ReactPHPVK\Actions\Sections\Likes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds the specified object to the 'Likes' list of the current user.
 */
class Add
{
    private Provider $_provider;
    
    private string $type = '';
    private int $ownerId = 0;
    private int $itemId = 0;
    private string $accessKey = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Add
     */
    public function _setCustom(array $value): Add
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion, 'sitepage' — page of the site where the [vk.com/dev/Like|Like widget] is installed
     * 
     * @param string $value
     * @return Add
     */
    public function setType(string $value): Add
    {
        $this->type = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the object.
     * 
     * @param int $value
     * @return Add
     */
    public function setOwnerId(int $value): Add
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Object ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setItemId(int $value): Add
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Access key required for an object owned by a private entity.
     * 
     * @param string $value
     * @return Add
     */
    public function setAccessKey(string $value): Add
    {
        $this->accessKey = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['type'] = $this->type;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = '';
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->accessKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('likes.add', $params);
    }
}