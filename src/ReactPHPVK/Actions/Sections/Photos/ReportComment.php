<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reports (submits a complaint about) a comment on a photo.
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
     * ID of the user or community that owns the photo.
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
     * ID of the comment being reported.
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
     * Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
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
        if ($this->reason !== 0) $params['reason'] = $this->reason;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->commentId = 0;
            $this->reason = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.reportComment', $params);
    }
}