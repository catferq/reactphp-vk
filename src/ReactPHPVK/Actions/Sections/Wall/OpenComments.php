<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class OpenComments
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return OpenComments
     */
    public function _setCustom(array $value): OpenComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return OpenComments
     */
    public function setOwnerId(int $value): OpenComments
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return OpenComments
     */
    public function setPostId(int $value): OpenComments
    {
        $this->postId = $value;
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
        $params['post_id'] = $this->postId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.openComments', $params);
    }
}