<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Widgets\GetComments;
use ReactPHPVK\Actions\Sections\Widgets\GetPages;

class Widgets
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Gets a list of comments for the page added through the [vk.com/dev/Comments|Comments widget].
     */
    public function getComments(): GetComments
    {
        return new GetComments($this->_provider);
    }

    /**
     * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like widget] is installed.
     */
    public function getPages(): GetPages
    {
        return new GetPages($this->_provider);
    }

}