<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sends a complaint to the item's comment.
 */
class ReportComment
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $commentId = 0;
    private int $reason = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ReportComment
     */
    public function _setCustom(array $value): ReportComment
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return ReportComment
     */
    public function setOwnerId(int $value): ReportComment
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Comment ID.
     * 
     * @param int $value
     * @return ReportComment
     */
    public function setCommentId(int $value): ReportComment
    {
        $this->commentId = $value;
        return $this;
    }

    /**
     * Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' — insult.
     * 
     * @param int $value
     * @return ReportComment
     */
    public function setReason(int $value): ReportComment
    {
        $this->reason = $value;
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
        $params['comment_id'] = $this->commentId;
        $params['reason'] = $this->reason;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->commentId = 0;
            $this->reason = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.reportComment', $params);
    }
}