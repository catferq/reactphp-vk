<?php

namespace ReactPHPVK\Actions\Sections\Polls;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes the current user's vote from the selected answer in the poll.
 */
class DeleteVote
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $pollId = 0;
    private int $answerId = 0;
    private bool $isBoard = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteVote
     */
    public function _setCustom(array $value): DeleteVote
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return DeleteVote
     */
    public function setOwnerId(int $value): DeleteVote
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Poll ID.
     * 
     * @param int $value
     * @return DeleteVote
     */
    public function setPollId(int $value): DeleteVote
    {
        $this->pollId = $value;
        return $this;
    }

    /**
     * Answer ID.
     * 
     * @param int $value
     * @return DeleteVote
     */
    public function setAnswerId(int $value): DeleteVote
    {
        $this->answerId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return DeleteVote
     */
    public function setIsBoard(bool $value): DeleteVote
    {
        $this->isBoard = $value;
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
        $params['answer_id'] = $this->answerId;
        if ($this->isBoard !== false) $params['is_board'] = intval($this->isBoard);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->pollId = 0;
            $this->answerId = 0;
            $this->isBoard = false;
            $this->_custom = [];
        }

        return $this->_provider->request('polls.deleteVote', $params);
    }
}