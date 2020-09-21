<?php

namespace ReactPHPVK\Actions\Sections\Polls;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of IDs of users who selected specific answers in the poll.
 */
class GetVoters
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $pollId = 0;
    private array $answerIds = [];
    private bool $isBoard = false;
    private bool $friendsOnly = false;
    private int $offset = 0;
    private int $count = 0;
    private array $fields = [];
    private string $nameCase = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetVoters
     */
    public function _setCustom(array $value): GetVoters
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetVoters
     */
    public function setOwnerId(int $value): GetVoters
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Poll ID.
     * 
     * @param int $value
     * @return GetVoters
     */
    public function setPollId(int $value): GetVoters
    {
        $this->pollId = $value;
        return $this;
    }

    /**
     * Answer IDs.
     * 
     * @param array $value
     * @return GetVoters
     */
    public function setAnswerIds(array $value): GetVoters
    {
        $this->answerIds = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetVoters
     */
    public function setIsBoard(bool $value): GetVoters
    {
        $this->isBoard = $value;
        return $this;
    }

    /**
     * '1' — to return only current user's friends, '0' — to return all users (default),
     * 
     * @param bool $value
     * @return GetVoters
     */
    public function setFriendsOnly(bool $value): GetVoters
    {
        $this->friendsOnly = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of voters. '0' — (default)
     * 
     * @param int $value
     * @return GetVoters
     */
    public function setOffset(int $value): GetVoters
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of user IDs to return (if the 'friends_only' parameter is not set, maximum '1000', otherwise '10'). '100' — (default)
     * 
     * @param int $value
     * @return GetVoters
     */
    public function setCount(int $value): GetVoters
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate (birthdate)', 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online', 'counters'.
     * 
     * @param array $value
     * @return GetVoters
     */
    public function setFields(array $value): GetVoters
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * 
     * @param string $value
     * @return GetVoters
     */
    public function setNameCase(string $value): GetVoters
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
        $params['poll_id'] = $this->pollId;
        $params['answer_ids'] = implode(',', $this->answerIds);
        if ($this->isBoard !== false) $params['is_board'] = intval($this->isBoard);
        if ($this->friendsOnly !== false) $params['friends_only'] = intval($this->friendsOnly);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->nameCase !== '') $params['name_case'] = $this->nameCase;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->pollId = 0;
            $this->answerIds = [];
            $this->isBoard = false;
            $this->friendsOnly = false;
            $this->offset = 0;
            $this->count = 0;
            $this->fields = [];
            $this->nameCase = '';
            $this->_custom = [];
        }

        return $this->_provider->request('polls.getVoters', $params);
    }
}