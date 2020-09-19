<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of comments on a photo.
 */
class GetComments
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private bool $needLikes = false;
    private int $startCommentId = 0;
    private int $offset = 0;
    private int $count = 20;
    private string $sort = '';
    private string $accessKey = '';
    private bool $extended = false;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetComments
     */
    public function _setCustom(array $value): GetComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setOwnerId(int $value): GetComments
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setPhotoId(int $value): GetComments
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * '1' — to return an additional 'likes' field, '0' — (default)
     * 
     * @param bool $value
     * @return GetComments
     */
    public function setNeedLikes(bool $value): GetComments
    {
        $this->needLikes = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setStartCommentId(int $value): GetComments
    {
        $this->startCommentId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of comments. By default, '0'.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setOffset(int $value): GetComments
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of comments to return.
     * 
     * @param int $value
     * @return GetComments
     */
    public function setCount(int $value): GetComments
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Sort order: 'asc' — old first, 'desc' — new first
     * 
     * @param string $value
     * @return GetComments
     */
    public function setSort(string $value): GetComments
    {
        $this->sort = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetComments
     */
    public function setAccessKey(string $value): GetComments
    {
        $this->accessKey = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetComments
     */
    public function setExtended(bool $value): GetComments
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetComments
     */
    public function setFields(array $value): GetComments
    {
        $this->fields = $value;
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
        $params['photo_id'] = $this->photoId;
        if ($this->needLikes !== false) $params['need_likes'] = intval($this->needLikes);
        if ($this->startCommentId !== 0) $params['start_comment_id'] = $this->startCommentId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->sort !== '') $params['sort'] = $this->sort;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->needLikes = false;
            $this->startCommentId = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->sort = '';
            $this->accessKey = '';
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getComments', $params);
    }
}