<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reports (submits a complaint about) a post on a user wall or community wall.
 */
class ReportPost
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $postId = 0;
    private int $reason = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ReportPost
     */
    public function _setCustom(array $value): ReportPost
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the wall.
     * 
     * @param int $value
     * @return ReportPost
     */
    public function setOwnerId(int $value): ReportPost
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Post ID.
     * 
     * @param int $value
     * @return ReportPost
     */
    public function setPostId(int $value): ReportPost
    {
        $this->postId = $value;
        return $this;
    }

    /**
     * Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     * 
     * @param int $value
     * @return ReportPost
     */
    public function setReason(int $value): ReportPost
    {
        $this->reason = $value;
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
        if ($this->reason !== 0) $params['reason'] = $this->reason;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->postId = 0;
            $this->reason = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.reportPost', $params);
    }
}