<?php

namespace ReactPHPVK\Actions\Sections\Polls;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns detailed information about a poll by its ID.
 */
class GetById
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private bool $isBoard = false;
    private int $pollId = 0;
    private bool $extended = false;
    private int $friendsCount = 3;
    private array $fields = [];
    private string $nameCase = 'nom';
    
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
     * ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetById
     */
    public function setOwnerId(int $value): GetById
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * '1' – poll is in a board, '0' – poll is on a wall. '0' by default.
     * 
     * @param bool $value
     * @return GetById
     */
    public function setIsBoard(bool $value): GetById
    {
        $this->isBoard = $value;
        return $this;
    }

    /**
     * Poll ID.
     * 
     * @param int $value
     * @return GetById
     */
    public function setPollId(int $value): GetById
    {
        $this->pollId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetById
     */
    public function setExtended(bool $value): GetById
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetById
     */
    public function setFriendsCount(int $value): GetById
    {
        $this->friendsCount = $value;
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
     * @param string $value
     * @return GetById
     */
    public function setNameCase(string $value): GetById
    {
        $this->nameCase = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->isBoard !== false) $params['is_board'] = intval($this->isBoard);
        $params['poll_id'] = $this->pollId;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->friendsCount !== 3) $params['friends_count'] = $this->friendsCount;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== 'nom') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->isBoard = false;
            $this->pollId = 0;
            $this->extended = false;
            $this->friendsCount = 3;
            $this->fields = [];
            $this->nameCase = 'nom';
            $this->_custom = [];
        }

        return $this->_provider->request('polls.getById', $params);
    }
}