<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Ban
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $ownerId = 0;
    private int $endDate = 0;
    private int $reason = 0;
    private string $comment = '';
    private bool $commentVisible = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Ban
     */
    public function _setCustom(array $value): Ban
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Ban
     */
    public function setGroupId(int $value): Ban
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Ban
     */
    public function setOwnerId(int $value): Ban
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Ban
     */
    public function setEndDate(int $value): Ban
    {
        $this->endDate = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Ban
     */
    public function setReason(int $value): Ban
    {
        $this->reason = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Ban
     */
    public function setComment(string $value): Ban
    {
        $this->comment = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Ban
     */
    public function setCommentVisible(bool $value): Ban
    {
        $this->commentVisible = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->endDate !== 0) $params['end_date'] = $this->endDate;
        if ($this->reason !== 0) $params['reason'] = $this->reason;
        if ($this->comment !== '') $params['comment'] = $this->comment;
        if ($this->commentVisible !== false) $params['comment_visible'] = intval($this->commentVisible);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->ownerId = 0;
            $this->endDate = 0;
            $this->reason = 0;
            $this->comment = '';
            $this->commentVisible = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.ban', $params);
    }
}