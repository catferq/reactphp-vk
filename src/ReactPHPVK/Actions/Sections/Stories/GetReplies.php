<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns replies to the story.
 */
class GetReplies
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $storyId = 0;
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
     * @return GetReplies
     */
    public function _setCustom(array $value): GetReplies
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Story owner ID.
     * 
     * @param int $value
     * @return GetReplies
     */
    public function setOwnerId(int $value): GetReplies
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Story ID.
     * 
     * @param int $value
     * @return GetReplies
     */
    public function setStoryId(int $value): GetReplies
    {
        $this->storyId = $value;
        return $this;
    }

    /**
     * Access key for the private object.
     * 
     * @param string $value
     * @return GetReplies
     */
    public function setAccessKey(string $value): GetReplies
    {
        $this->accessKey = $value;
        return $this;
    }

    /**
     * '1' — to return additional fields for users and communities. Default value is 0.
     * 
     * @param bool $value
     * @return GetReplies
     */
    public function setExtended(bool $value): GetReplies
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Additional fields to return
     * 
     * @param array $value
     * @return GetReplies
     */
    public function setFields(array $value): GetReplies
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

        $params['owner_id'] = $this->ownerId;
        $params['story_id'] = $this->storyId;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->storyId = 0;
            $this->accessKey = '';
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stories.getReplies', $params);
    }
}