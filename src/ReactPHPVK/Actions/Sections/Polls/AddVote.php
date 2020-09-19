<?php

namespace ReactPHPVK\Actions\Sections\Polls;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds the current user's vote to the selected answer in the poll.
 */
class AddVote
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $pollId = 0;
    private array $answerIds = [];
    private bool $isBoard = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddVote
     */
    public function _setCustom(array $value): AddVote
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return AddVote
     */
    public function setOwnerId(int $value): AddVote
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Poll ID.
     * 
     * @param int $value
     * @return AddVote
     */
    public function setPollId(int $value): AddVote
    {
        $this->pollId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return AddVote
     */
    public function setAnswerIds(array $value): AddVote
    {
        $this->answerIds = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return AddVote
     */
    public function setIsBoard(bool $value): AddVote
    {
        $this->isBoard = $value;
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
        $params['poll_id'] = $this->pollId;
        $params['answer_ids'] = implode(',', $this->answerIds);
        if ($this->isBoard !== false) $params['is_board'] = intval($this->isBoard);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->pollId = 0;
            $this->answerIds = [];
            $this->isBoard = false;
            $this->_custom = [];
        }

        return $this->_provider->request('polls.addVote', $params);
    }
}