<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetChatPreview
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private string $link = '';
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetChatPreview
     */
    public function _setCustom(array $value): GetChatPreview
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetChatPreview
     */
    public function setPeerId(int $value): GetChatPreview
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Invitation link.
     * 
     * @param string $value
     * @return GetChatPreview
     */
    public function setLink(string $value): GetChatPreview
    {
        $this->link = $value;
        return $this;
    }

    /**
     * Profile fields to return.
     * 
     * @param array $value
     * @return GetChatPreview
     */
    public function setFields(array $value): GetChatPreview
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->link !== '') $params['link'] = $this->link;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->link = '';
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getChatPreview', $params);
    }
}