<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits the message.
 */
class Edit
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private string $message = '';
    private float $lat = 0;
    private float $long = 0;
    private string $attachment = '';
    private bool $keepForwardMessages = false;
    private bool $keepSnippets = false;
    private int $groupId = 0;
    private bool $dontParseLinks = false;
    private int $messageId = 0;
    private int $conversationMessageId = 0;
    private string $template = '';
    private string $keyboard = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return Edit
     */
    public function setPeerId(int $value): Edit
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the message.
     * 
     * @param string $value
     * @return Edit
     */
    public function setMessage(string $value): Edit
    {
        $this->message = $value;
        return $this;
    }

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90).
     * 
     * @param float $value
     * @return Edit
     */
    public function setLat(float $value): Edit
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180).
     * 
     * @param float $value
     * @return Edit
     */
    public function setLong(float $value): Edit
    {
        $this->long = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the message, separated by commas, in the following format: "<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'wall' — wall post, '<owner_id>' — ID of the media attachment owner. '<media_id>' — media attachment ID. Example: "photo100172_166443618"
     * 
     * @param string $value
     * @return Edit
     */
    public function setAttachment(string $value): Edit
    {
        $this->attachment = $value;
        return $this;
    }

    /**
     * '1' — to keep forwarded, messages.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setKeepForwardMessages(bool $value): Edit
    {
        $this->keepForwardMessages = $value;
        return $this;
    }

    /**
     * '1' — to keep attached snippets.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setKeepSnippets(bool $value): Edit
    {
        $this->keepSnippets = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with user access token)
     * 
     * @param int $value
     * @return Edit
     */
    public function setGroupId(int $value): Edit
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setDontParseLinks(bool $value): Edit
    {
        $this->dontParseLinks = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setMessageId(int $value): Edit
    {
        $this->messageId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setConversationMessageId(int $value): Edit
    {
        $this->conversationMessageId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setTemplate(string $value): Edit
    {
        $this->template = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setKeyboard(string $value): Edit
    {
        $this->keyboard = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['peer_id'] = $this->peerId;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->attachment !== '') $params['attachment'] = $this->attachment;
        if ($this->keepForwardMessages !== false) $params['keep_forward_messages'] = intval($this->keepForwardMessages);
        if ($this->keepSnippets !== false) $params['keep_snippets'] = intval($this->keepSnippets);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->dontParseLinks !== false) $params['dont_parse_links'] = intval($this->dontParseLinks);
        if ($this->messageId !== 0) $params['message_id'] = $this->messageId;
        if ($this->conversationMessageId !== 0) $params['conversation_message_id'] = $this->conversationMessageId;
        if ($this->template !== '') $params['template'] = $this->template;
        if ($this->keyboard !== '') $params['keyboard'] = $this->keyboard;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->message = '';
            $this->lat = 0;
            $this->long = 0;
            $this->attachment = '';
            $this->keepForwardMessages = false;
            $this->keepSnippets = false;
            $this->groupId = 0;
            $this->dontParseLinks = false;
            $this->messageId = 0;
            $this->conversationMessageId = 0;
            $this->template = '';
            $this->keyboard = '';
            $this->_custom = [];
        }

        return $this->_provider->request('messages.edit', $params);
    }
}