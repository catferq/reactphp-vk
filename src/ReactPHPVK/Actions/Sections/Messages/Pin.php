<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Pin a message.
 */
class Pin
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private int $messageId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Pin
     */
    public function _setCustom(array $value): Pin
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return Pin
     */
    public function setPeerId(int $value): Pin
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Pin
     */
    public function setMessageId(int $value): Pin
    {
        $this->messageId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['peer_id'] = $this->peerId;
        if ($this->messageId !== 0) $params['message_id'] = $this->messageId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->messageId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.pin', $params);
    }
}