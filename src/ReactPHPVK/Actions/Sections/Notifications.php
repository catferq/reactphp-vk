<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Notifications\Get;
use ReactPHPVK\Actions\Sections\Notifications\MarkAsViewed;
use ReactPHPVK\Actions\Sections\Notifications\SendMessage;

class Notifications
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns a list of notifications about other users' feedback to the current user's wall posts.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
     */
    public function markAsViewed(): MarkAsViewed
    {
        return new MarkAsViewed($this->_provider);
    }

    /**
     * 
     */
    public function sendMessage(): SendMessage
    {
        return new SendMessage($this->_provider);
    }

}