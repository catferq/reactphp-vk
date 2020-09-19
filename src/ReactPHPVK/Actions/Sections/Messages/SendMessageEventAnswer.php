<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class SendMessageEventAnswer
{
    private Provider $_provider;
    
    private string $eventId = '';
    private int $userId = 0;
    private int $peerId = 0;
    private string $eventData = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SendMessageEventAnswer
     */
    public function _setCustom(array $value): SendMessageEventAnswer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SendMessageEventAnswer
     */
    public function setEventId(string $value): SendMessageEventAnswer
    {
        $this->eventId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SendMessageEventAnswer
     */
    public function setUserId(int $value): SendMessageEventAnswer
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SendMessageEventAnswer
     */
    public function setPeerId(int $value): SendMessageEventAnswer
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SendMessageEventAnswer
     */
    public function setEventData(string $value): SendMessageEventAnswer
    {
        $this->eventData = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['event_id'] = $this->eventId;
        $params['user_id'] = $this->userId;
        $params['peer_id'] = $this->peerId;
        if ($this->eventData !== '') $params['event_data'] = $this->eventData;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->eventId = '';
            $this->userId = 0;
            $this->peerId = 0;
            $this->eventData = '';
            $this->_custom = [];
        }

        return $this->_provider->request('messages.sendMessageEventAnswer', $params);
    }
}