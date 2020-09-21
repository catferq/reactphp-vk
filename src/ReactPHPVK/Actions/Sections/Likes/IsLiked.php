<?php

namespace ReactPHPVK\Actions\Sections\Likes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Checks for the object in the 'Likes' list of the specified user.
 */
class IsLiked
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $type = '';
    private int $ownerId = 0;
    private int $itemId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return IsLiked
     */
    public function _setCustom(array $value): IsLiked
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID.
     * 
     * @param int $value
     * @return IsLiked
     */
    public function setUserId(int $value): IsLiked
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion
     * 
     * @param string $value
     * @return IsLiked
     */
    public function setType(string $value): IsLiked
    {
        $this->type = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the object.
     * 
     * @param int $value
     * @return IsLiked
     */
    public function setOwnerId(int $value): IsLiked
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Object ID.
     * 
     * @param int $value
     * @return IsLiked
     */
    public function setItemId(int $value): IsLiked
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        $params['type'] = $this->type;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->type = '';
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('likes.isLiked', $params);
    }
}