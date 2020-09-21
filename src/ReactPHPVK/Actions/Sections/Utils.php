<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Utils\CheckLink;
use ReactPHPVK\Actions\Sections\Utils\DeleteFromLastShortened;
use ReactPHPVK\Actions\Sections\Utils\GetLastShortenedLinks;
use ReactPHPVK\Actions\Sections\Utils\GetLinkStats;
use ReactPHPVK\Actions\Sections\Utils\GetServerTime;
use ReactPHPVK\Actions\Sections\Utils\GetShortLink;
use ReactPHPVK\Actions\Sections\Utils\ResolveScreenName;

class Utils
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Checks whether a link is blocked in VK.
     */
    public function checkLink(): CheckLink
    {
        return new CheckLink($this->_provider);
    }

    /**
     * Deletes shortened link from user's list.
     */
    public function deleteFromLastShortened(): DeleteFromLastShortened
    {
        return new DeleteFromLastShortened($this->_provider);
    }

    /**
     * Returns a list of user's shortened links.
     */
    public function getLastShortenedLinks(): GetLastShortenedLinks
    {
        return new GetLastShortenedLinks($this->_provider);
    }

    /**
     * Returns stats data for shortened link.
     */
    public function getLinkStats(): GetLinkStats
    {
        return new GetLinkStats($this->_provider);
    }

    /**
     * Returns the current time of the VK server.
     */
    public function getServerTime(): GetServerTime
    {
        return new GetServerTime($this->_provider);
    }

    /**
     * Allows to receive a link shortened via vk.cc.
     */
    public function getShortLink(): GetShortLink
    {
        return new GetShortLink($this->_provider);
    }

    /**
     * Detects a type of object (e.g., user, community, application) and its ID by screen name.
     */
    public function resolveScreenName(): ResolveScreenName
    {
        return new ResolveScreenName($this->_provider);
    }

}