<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates an empty album for videos.
 */
class AddAlbum
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $title = '';
    private array $privacy = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddAlbum
     */
    public function _setCustom(array $value): AddAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID (if the album will be created in a community).
     * 
     * @param int $value
     * @return AddAlbum
     */
    public function setGroupId(int $value): AddAlbum
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Album title.
     * 
     * @param string $value
     * @return AddAlbum
     */
    public function setTitle(string $value): AddAlbum
    {
        $this->title = $value;
        return $this;
    }

    /**
     * new access permissions for the album. Possible values: , *'0' – all users,, *'1' – friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
     * 
     * @param array $value
     * @return AddAlbum
     */
    public function setPrivacy(array $value): AddAlbum
    {
        $this->privacy = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->privacy !== []) $params['privacy'] = implode(',', $this->privacy);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->title = '';
            $this->privacy = [];
            $this->_custom = [];
        }

        return $this->_provider->request('video.addAlbum', $params);
    }
}