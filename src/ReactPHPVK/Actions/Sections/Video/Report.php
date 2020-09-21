<?php

namespace ReactPHPVK\Actions\Sections\Video;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reports (submits a complaint about) a video.
 */
class Report
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $videoId = 0;
    private int $reason = 0;
    private string $comment = '';
    private string $searchQuery = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Report
     */
    public function _setCustom(array $value): Report
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the video.
     * 
     * @param int $value
     * @return Report
     */
    public function setOwnerId(int $value): Report
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Video ID.
     * 
     * @param int $value
     * @return Report
     */
    public function setVideoId(int $value): Report
    {
        $this->videoId = $value;
        return $this;
    }

    /**
     * Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     * 
     * @param int $value
     * @return Report
     */
    public function setReason(int $value): Report
    {
        $this->reason = $value;
        return $this;
    }

    /**
     * Comment describing the complaint.
     * 
     * @param string $value
     * @return Report
     */
    public function setComment(string $value): Report
    {
        $this->comment = $value;
        return $this;
    }

    /**
     * (If the video was found in search results.) Search query string.
     * 
     * @param string $value
     * @return Report
     */
    public function setSearchQuery(string $value): Report
    {
        $this->searchQuery = $value;
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
        $params['video_id'] = $this->videoId;
        if ($this->reason !== 0) $params['reason'] = $this->reason;
        if ($this->comment !== '') $params['comment'] = $this->comment;
        if ($this->searchQuery !== '') $params['search_query'] = $this->searchQuery;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->videoId = 0;
            $this->reason = 0;
            $this->comment = '';
            $this->searchQuery = '';
            $this->_custom = [];
        }

        return $this->_provider->request('video.report', $params);
    }
}