<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns updates in user's private messages.
 */
class GetLongPollHistory
{
    private Provider $_provider;
    
    private int $ts = 0;
    private int $pts = 0;
    private int $previewLength = 0;
    private bool $onlines = false;
    private array $fields = [];
    private int $eventsLimit = 1000;
    private int $msgsLimit = 200;
    private int $maxMsgId = 0;
    private int $groupId = 0;
    private int $lpVersion = 0;
    private int $lastN = 0;
    private bool $credentials = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLongPollHistory
     */
    public function _setCustom(array $value): GetLongPollHistory
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Last value of the 'ts' parameter returned from the Long Poll server or by using [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setTs(int $value): GetLongPollHistory
    {
        $this->ts = $value;
        return $this;
    }

    /**
     * Lsat value of 'pts' parameter returned from the Long Poll server or by using [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setPts(int $value): GetLongPollHistory
    {
        $this->pts = $value;
        return $this;
    }

    /**
     * Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setPreviewLength(int $value): GetLongPollHistory
    {
        $this->previewLength = $value;
        return $this;
    }

    /**
     * '1' — to return history with online users only.
     * 
     * @param bool $value
     * @return GetLongPollHistory
     */
    public function setOnlines(bool $value): GetLongPollHistory
    {
        $this->onlines = $value;
        return $this;
    }

    /**
     * Additional profile [vk.com/dev/fields|fields] to return.
     * 
     * @param array $value
     * @return GetLongPollHistory
     */
    public function setFields(array $value): GetLongPollHistory
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Maximum number of events to return.
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setEventsLimit(int $value): GetLongPollHistory
    {
        $this->eventsLimit = $value;
        return $this;
    }

    /**
     * Maximum number of messages to return.
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setMsgsLimit(int $value): GetLongPollHistory
    {
        $this->msgsLimit = $value;
        return $this;
    }

    /**
     * Maximum ID of the message among existing ones in the local copy. Both messages received with API methods (for example, , ), and data received from a Long Poll server (events with code 4) are taken into account.
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setMaxMsgId(int $value): GetLongPollHistory
    {
        $this->maxMsgId = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setGroupId(int $value): GetLongPollHistory
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setLpVersion(int $value): GetLongPollHistory
    {
        $this->lpVersion = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetLongPollHistory
     */
    public function setLastN(int $value): GetLongPollHistory
    {
        $this->lastN = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetLongPollHistory
     */
    public function setCredentials(bool $value): GetLongPollHistory
    {
        $this->credentials = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ts !== 0) $params['ts'] = $this->ts;
        if ($this->pts !== 0) $params['pts'] = $this->pts;
        if ($this->previewLength !== 0) $params['preview_length'] = $this->previewLength;
        if ($this->onlines !== false) $params['onlines'] = intval($this->onlines);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->eventsLimit !== 1000) $params['events_limit'] = $this->eventsLimit;
        if ($this->msgsLimit !== 200) $params['msgs_limit'] = $this->msgsLimit;
        if ($this->maxMsgId !== 0) $params['max_msg_id'] = $this->maxMsgId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->lpVersion !== 0) $params['lp_version'] = $this->lpVersion;
        if ($this->lastN !== 0) $params['last_n'] = $this->lastN;
        if ($this->credentials !== false) $params['credentials'] = intval($this->credentials);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ts = 0;
            $this->pts = 0;
            $this->previewLength = 0;
            $this->onlines = false;
            $this->fields = [];
            $this->eventsLimit = 1000;
            $this->msgsLimit = 200;
            $this->maxMsgId = 0;
            $this->groupId = 0;
            $this->lpVersion = 0;
            $this->lastN = 0;
            $this->credentials = false;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getLongPollHistory', $params);
    }
}