<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Widgets\GetComments;
use ReactPHPVK\Actions\Sections\Widgets\GetPages;

class Widgets
{
    private Provider $_provider;

    private ?Widgets\GetComments $getComments = null;
    private ?Widgets\GetPages $getPages = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Gets a list of comments for the page added through the [vk.com/dev/Comments|Comments widget].
     */
    public function getComments(): GetComments
    {
        if (!$this->getComments) {
            $this->getComments = new GetComments($this->_provider);
        }
        return $this->getComments;
    }

    /**
     * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like widget] is installed.
     */
    public function getPages(): GetPages
    {
        if (!$this->getPages) {
            $this->getPages = new GetPages($this->_provider);
        }
        return $this->getPages;
    }

}