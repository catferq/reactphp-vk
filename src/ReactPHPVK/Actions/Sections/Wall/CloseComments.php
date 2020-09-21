<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class CloseComments
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
     * @return CloseComments
     */
    public function _setCustom(array $value): CloseComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CloseComments
     */
    public function setOwnerId(int $value): CloseComments
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return CloseComments
     */
    public function setPostId(int $value): CloseComments
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
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

        return $this->_provider->request('wall.closeComments', $params);
    }
}