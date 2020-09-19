<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sends a message.
 */
class Send
{
    private Provider $_provider;
    
    private int $userId = 0;
    private int $randomId = 0;
    private int $peerId = 0;
    private string $domain = '';
    private int $chatId = 0;
    private array $userIds = [];
    private string $message = '';
    private float $lat = 0;
    private float $long = 0;
    private string $attachment = '';
    private int $replyTo = 0;
    private array $forwardMessages = [];
    private int $stickerId = 0;
    private int $groupId = 0;
    private string $keyboard = '';
    private string $payload = '';
    private bool $dontParseLinks = false;
    private bool $disableMentions = false;
    private string $intent = 'default';
    private int $subscribeId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Send
     */
    public function _setCustom(array $value): Send
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID (by default — current user).
     * 
     * @param int $value
     * @return Send
     */
    public function setUserId(int $value): Send
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Unique identifier to avoid resending the message.
     * 
     * @param int $value
     * @return Send
     */
    public function setRandomId(int $value): Send
    {
        $this->randomId = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return Send
     */
    public function setPeerId(int $value): Send
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * User's short address (for example, 'illarionov').
     * 
     * @param string $value
     * @return Send
     */
    public function setDomain(string $value): Send
    {
        $this->domain = $value;
        return $this;
    }

    /**
     * ID of conversation the message will relate to.
     * 
     * @param int $value
     * @return Send
     */
    public function setChatId(int $value): Send
    {
        $this->chatId = $value;
        return $this;
    }

    /**
     * IDs of message recipients (if new conversation shall be started).
     * 
     * @param array $value
     * @return Send
     */
    public function setUserIds(array $value): Send
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * (Required if 'attachments' is not set.) Text of the message.
     * 
     * @param string $value
     * @return Send
     */
    public function setMessage(string $value): Send
    {
        $this->message = $value;
        return $this;
    }

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90).
     * 
     * @param float $value
     * @return Send
     */
    public function setLat(float $value): Send
    {
        $this->lat = $value;
        return $this;
    }

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180).
     * 
     * @param float $value
     * @return Send
     */
    public function setLong(float $value): Send
    {
        $this->long = $value;
        return $this;
    }

    /**
     * (Required if 'message' is not set.) List of objects attached to the message, separated by commas, in the following format: "<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'wall' — wall post, '<owner_id>' — ID of the media attachment owner. '<media_id>' — media attachment ID. Example: "photo100172_166443618"
     * 
     * @param string $value
     * @return Send
     */
    public function setAttachment(string $value): Send
    {
        $this->attachment = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Send
     */
    public function setReplyTo(int $value): Send
    {
        $this->replyTo = $value;
        return $this;
    }

    /**
     * ID of forwarded messages, separated with a comma. Listed messages of the sender will be shown in the message body at the recipient's. Example: "123,431,544"
     * 
     * @param array $value
     * @return Send
     */
    public function setForwardMessages(array $value): Send
    {
        $this->forwardMessages = $value;
        return $this;
    }

    /**
     * Sticker id.
     * 
     * @param int $value
     * @return Send
     */
    public function setStickerId(int $value): Send
    {
        $this->stickerId = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return Send
     */
    public function setGroupId(int $value): Send
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Send
     */
    public function setKeyboard(string $value): Send
    {
        $this->keyboard = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Send
     */
    public function setPayload(string $value): Send
    {
        $this->payload = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Send
     */
    public function setDontParseLinks(bool $value): Send
    {
        $this->dontParseLinks = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Send
     */
    public function setDisableMentions(bool $value): Send
    {
        $this->disableMentions = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Send
     */
    public function setIntent(string $value): Send
    {
        $this->intent = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Send
     */
    public function setSubscribeId(int $value): Send
    {
        $this->subscribeId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        $params['random_id'] = $this->randomId;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->domain !== '') $params['domain'] = $this->domain;
        if ($this->chatId !== 0) $params['chat_id'] = $this->chatId;
        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->lat !== 0) $params['lat'] = $this->lat;
        if ($this->long !== 0) $params['long'] = $this->long;
        if ($this->attachment !== '') $params['attachment'] = $this->attachment;
        if ($this->replyTo !== 0) $params['reply_to'] = $this->replyTo;
        if ($this->forwardMessages !== []) $params['forward_messages'] = implode(',', $this->forwardMessages);
        if ($this->stickerId !== 0) $params['sticker_id'] = $this->stickerId;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->keyboard !== '') $params['keyboard'] = $this->keyboard;
        if ($this->payload !== '') $params['payload'] = $this->payload;
        if ($this->dontParseLinks !== false) $params['dont_parse_links'] = intval($this->dontParseLinks);
        if ($this->disableMentions !== false) $params['disable_mentions'] = intval($this->disableMentions);
        if ($this->intent !== 'default') $params['intent'] = $this->intent;
        if ($this->subscribeId !== 0) $params['subscribe_id'] = $this->subscribeId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->randomId = 0;
            $this->peerId = 0;
            $this->domain = '';
            $this->chatId = 0;
            $this->userIds = [];
            $this->message = '';
            $this->lat = 0;
            $this->long = 0;
            $this->attachment = '';
            $this->replyTo = 0;
            $this->forwardMessages = [];
            $this->stickerId = 0;
            $this->groupId = 0;
            $this->keyboard = '';
            $this->payload = '';
            $this->dontParseLinks = false;
            $this->disableMentions = false;
            $this->intent = 'default';
            $this->subscribeId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.send', $params);
    }
}