<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Approves or creates a friend request.
 */
class Add
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $text = '';
    private bool $follow = false;
    
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
     * ID of the user whose friend request will be approved or to whom a friend request will be sent.
     * 
     * @param int $value
     * @return Add
     */
    public function setUserId(int $value): Add
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Text of the message (up to 500 characters) for the friend request, if any.
     * 
     * @param string $value
     * @return Add
     */
    public function setText(string $value): Add
    {
        $this->text = $value;
        return $this;
    }

    /**
     * '1' to pass an incoming request to followers list.
     * 
     * @param bool $value
     * @return Add
     */
    public function setFollow(bool $value): Add
    {
        $this->follow = $value;
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
        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->follow !== false) $params['follow'] = intval($this->follow);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->text = '';
            $this->follow = false;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.add', $params);
    }
}