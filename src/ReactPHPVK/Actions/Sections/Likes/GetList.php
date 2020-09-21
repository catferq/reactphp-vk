<?php

namespace ReactPHPVK\Actions\Sections\Likes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of IDs of users who added the specified object to their 'Likes' list.
 */
class GetList
{
    private Provider $_provider;
    
    private string $type = '';
    private int $ownerId = 0;
    private int $itemId = 0;
    private string $pageUrl = '';
    private string $filter = '';
    private int $friendsOnly = 0;
    private bool $extended = false;
    private int $offset = 0;
    private int $count = 0;
    private bool $skipOwn = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetList
     */
    public function _setCustom(array $value): GetList
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * , Object type: 'post' — post on user or community wall, 'comment' — comment on a wall post, 'photo' — photo, 'audio' — audio, 'video' — video, 'note' — note, 'photo_comment' — comment on the photo, 'video_comment' — comment on the video, 'topic_comment' — comment in the discussion, 'sitepage' — page of the site where the [vk.com/dev/Like|Like widget] is installed
     * 
     * @param string $value
     * @return GetList
     */
    public function setType(string $value): GetList
    {
        $this->type = $value;
        return $this;
    }

    /**
     * ID of the user, community, or application that owns the object. If the 'type' parameter is set as 'sitepage', the application ID is passed as 'owner_id'. Use negative value for a community id. If the 'type' parameter is not set, the 'owner_id' is assumed to be either the current user or the same application ID as if the 'type' parameter was set to 'sitepage'.
     * 
     * @param int $value
     * @return GetList
     */
    public function setOwnerId(int $value): GetList
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Object ID. If 'type' is set as 'sitepage', 'item_id' can include the 'page_id' parameter value used during initialization of the [vk.com/dev/Like|Like widget].
     * 
     * @param int $value
     * @return GetList
     */
    public function setItemId(int $value): GetList
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * URL of the page where the [vk.com/dev/Like|Like widget] is installed. Used instead of the 'item_id' parameter.
     * 
     * @param string $value
     * @return GetList
     */
    public function setPageUrl(string $value): GetList
    {
        $this->pageUrl = $value;
        return $this;
    }

    /**
     * Filters to apply: 'likes' — returns information about all users who liked the object (default), 'copies' — returns information only about users who told their friends about the object
     * 
     * @param string $value
     * @return GetList
     */
    public function setFilter(string $value): GetList
    {
        $this->filter = $value;
        return $this;
    }

    /**
     * Specifies which users are returned: '1' — to return only the current user's friends, '0' — to return all users (default)
     * 
     * @param int $value
     * @return GetList
     */
    public function setFriendsOnly(int $value): GetList
    {
        $this->friendsOnly = $value;
        return $this;
    }

    /**
     * Specifies whether extended information will be returned. '1' — to return extended information about users and communities from the 'Likes' list, '0' — to return no additional information (default)
     * 
     * @param bool $value
     * @return GetList
     */
    public function setExtended(bool $value): GetList
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Offset needed to select a specific subset of users.
     * 
     * @param int $value
     * @return GetList
     */
    public function setOffset(int $value): GetList
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of user IDs to return (maximum '1000'). Default is '100' if 'friends_only' is set to '0', otherwise, the default is '10' if 'friends_only' is set to '1'.
     * 
     * @param int $value
     * @return GetList
     */
    public function setCount(int $value): GetList
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetList
     */
    public function setSkipOwn(bool $value): GetList
    {
        $this->skipOwn = $value;
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
        if ($this->itemId !== 0) $params['item_id'] = $this->itemId;
        if ($this->pageUrl !== '') $params['page_url'] = $this->pageUrl;
        if ($this->filter !== '') $params['filter'] = $this->filter;
        if ($this->friendsOnly !== 0) $params['friends_only'] = $this->friendsOnly;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->skipOwn !== false) $params['skip_own'] = intval($this->skipOwn);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = '';
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->pageUrl = '';
            $this->filter = '';
            $this->friendsOnly = 0;
            $this->extended = false;
            $this->offset = 0;
            $this->count = 0;
            $this->skipOwn = false;
            $this->_custom = [];
        }

        return $this->_provider->request('likes.getList', $params);
    }
}