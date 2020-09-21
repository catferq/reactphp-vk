<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits the title of a chat.
 */
class EditChat
{
    private Provider $_provider;
    
    private int $chatId = 0;
    private string $title = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditChat
     */
    public function _setCustom(array $value): EditChat
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Chat ID.
     * 
     * @param int $value
     * @return EditChat
     */
    public function setChatId(int $value): EditChat
    {
        $this->chatId = $value;
        return $this;
    }

    /**
     * New title of the chat.
     * 
     * @param string $value
     * @return EditChat
     */
    public function setTitle(string $value): EditChat
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['chat_id'] = $this->chatId;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->chatId = 0;
            $this->title = '';
            $this->_custom = [];
        }

        return $this->_provider->request('messages.editChat', $params);
    }
}