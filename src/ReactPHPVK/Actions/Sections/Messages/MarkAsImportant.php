<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Marks and unmarks messages as important (starred).
 */
class MarkAsImportant
{
    private Provider $_provider;
    
    private array $messageIds = [];
    private int $important = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MarkAsImportant
     */
    public function _setCustom(array $value): MarkAsImportant
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * IDs of messages to mark as important.
     * 
     * @param array $value
     * @return MarkAsImportant
     */
    public function setMessageIds(array $value): MarkAsImportant
    {
        $this->messageIds = $value;
        return $this;
    }

    /**
     * '1' — to add a star (mark as important), '0' — to remove the star
     * 
     * @param int $value
     * @return MarkAsImportant
     */
    public function setImportant(int $value): MarkAsImportant
    {
        $this->important = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->messageIds !== []) $params['message_ids'] = implode(',', $this->messageIds);
        if ($this->important !== 0) $params['important'] = $this->important;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->messageIds = [];
            $this->important = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.markAsImportant', $params);
    }
}