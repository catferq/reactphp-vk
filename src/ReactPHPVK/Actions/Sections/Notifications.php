<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Notifications\Get;
use ReactPHPVK\Actions\Sections\Notifications\MarkAsViewed;
use ReactPHPVK\Actions\Sections\Notifications\SendMessage;

class Notifications
{
    private Provider $_provider;

    private ?Notifications\Get $get = null;
    private ?Notifications\MarkAsViewed $markAsViewed = null;
    private ?Notifications\SendMessage $sendMessage = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns a list of notifications about other users' feedback to the current user's wall posts.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
     */
    public function markAsViewed(): MarkAsViewed
    {
        if (!$this->markAsViewed) {
            $this->markAsViewed = new MarkAsViewed($this->_provider);
        }
        return $this->markAsViewed;
    }

    /**
     * 
     */
    public function sendMessage(): SendMessage
    {
        if (!$this->sendMessage) {
            $this->sendMessage = new SendMessage($this->_provider);
        }
        return $this->sendMessage;
    }

}