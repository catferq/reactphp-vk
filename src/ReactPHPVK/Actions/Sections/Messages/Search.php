<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of the current user's private messages that match search criteria.
 */
class Search
{
    private Provider $_provider;
    
    private string $q = '';
    private int $peerId = 0;
    private int $date = 0;
    private int $previewLength = 0;
    private int $offset = 0;
    private int $count = 20;
    private bool $extended = false;
    private array $fields = [];
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Search
     */
    public function _setCustom(array $value): Search
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Search query string.
     * 
     * @param string $value
     * @return Search
     */
    public function setQ(string $value): Search
    {
        $this->q = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return Search
     */
    public function setPeerId(int $value): Search
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Date to search message before in Unixtime.
     * 
     * @param int $value
     * @return Search
     */
    public function setDate(int $value): Search
    {
        $this->date = $value;
        return $this;
    }

    /**
     * Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
     * 
     * @param int $value
     * @return Search
     */
    public function setPreviewLength(int $value): Search
    {
        $this->previewLength = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of messages.
     * 
     * @param int $value
     * @return Search
     */
    public function setOffset(int $value): Search
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of messages to return.
     * 
     * @param int $value
     * @return Search
     */
    public function setCount(int $value): Search
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Search
     */
    public function setExtended(bool $value): Search
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Search
     */
    public function setFields(array $value): Search
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return Search
     */
    public function setGroupId(int $value): Search
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->date !== 0) $params['date'] = $this->date;
        if ($this->previewLength !== 0) $params['preview_length'] = $this->previewLength;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->q = '';
            $this->peerId = 0;
            $this->date = 0;
            $this->previewLength = 0;
            $this->offset = 0;
            $this->count = 20;
            $this->extended = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.search', $params);
    }
}