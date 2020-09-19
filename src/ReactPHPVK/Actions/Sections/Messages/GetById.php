<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns messages by their IDs.
 */
class GetById
{
    private Provider $_provider;
    
    private array $messageIds = [];
    private int $previewLength = 0;
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
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Message IDs.
     * 
     * @param array $value
     * @return GetById
     */
    public function setMessageIds(array $value): GetById
    {
        $this->messageIds = $value;
        return $this;
    }

    /**
     * Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
     * 
     * @param int $value
     * @return GetById
     */
    public function setPreviewLength(int $value): GetById
    {
        $this->previewLength = $value;
        return $this;
    }

    /**
     * Information whether the response should be extended
     * 
     * @param bool $value
     * @return GetById
     */
    public function setExtended(bool $value): GetById
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetById
     */
    public function setFields(array $value): GetById
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetById
     */
    public function setGroupId(int $value): GetById
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

        $params['message_ids'] = implode(',', $this->messageIds);
        if ($this->previewLength !== 0) $params['preview_length'] = $this->previewLength;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->messageIds = [];
            $this->previewLength = 0;
            $this->extended = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getById', $params);
    }
}