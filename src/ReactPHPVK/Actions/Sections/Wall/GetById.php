<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of posts from user or community walls by their IDs.
 */
class GetById
{
    private Provider $_provider;
    
    private array $posts = [];
    private bool $extended = false;
    private int $copyHistoryDepth = 2;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User or community IDs and post IDs, separated by underscores. Use a negative value to designate a community ID. Example: "93388_21539,93388_20904,2943_4276,-1_1"
     * 
     * @param array $value
     * @return GetById
     */
    public function setPosts(array $value): GetById
    {
        $this->posts = $value;
        return $this;
    }

    /**
     * '1' — to return user and community objects needed to display posts, '0' — no additional fields are returned (default)
     * 
     * @param bool $value
     * @return GetById
     */
    public function setExtended(bool $value): GetById
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Sets the number of parent elements to include in the array 'copy_history' that is returned if the post is a repost from another wall.
     * 
     * @param int $value
     * @return GetById
     */
    public function setCopyHistoryDepth(int $value): GetById
    {
        $this->copyHistoryDepth = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetById
     */
    public function setFields(array $value): GetById
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

        $params['posts'] = implode(',', $this->posts);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->copyHistoryDepth !== 2) $params['copy_history_depth'] = $this->copyHistoryDepth;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->posts = [];
            $this->extended = false;
            $this->copyHistoryDepth = 2;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('wall.getById', $params);
    }
}