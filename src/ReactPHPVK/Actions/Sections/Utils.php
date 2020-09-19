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

    private ?Utils\CheckLink $checkLink = null;
    private ?Utils\DeleteFromLastShortened $deleteFromLastShortened = null;
    private ?Utils\GetLastShortenedLinks $getLastShortenedLinks = null;
    private ?Utils\GetLinkStats $getLinkStats = null;
    private ?Utils\GetServerTime $getServerTime = null;
    private ?Utils\GetShortLink $getShortLink = null;
    private ?Utils\ResolveScreenName $resolveScreenName = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Checks whether a link is blocked in VK.
     */
    public function checkLink(): CheckLink
    {
        if (!$this->checkLink) {
            $this->checkLink = new CheckLink($this->_provider);
        }
        return $this->checkLink;
    }

    /**
     * Deletes shortened link from user's list.
     */
    public function deleteFromLastShortened(): DeleteFromLastShortened
    {
        if (!$this->deleteFromLastShortened) {
            $this->deleteFromLastShortened = new DeleteFromLastShortened($this->_provider);
        }
        return $this->deleteFromLastShortened;
    }

    /**
     * Returns a list of user's shortened links.
     */
    public function getLastShortenedLinks(): GetLastShortenedLinks
    {
        if (!$this->getLastShortenedLinks) {
            $this->getLastShortenedLinks = new GetLastShortenedLinks($this->_provider);
        }
        return $this->getLastShortenedLinks;
    }

    /**
     * Returns stats data for shortened link.
     */
    public function getLinkStats(): GetLinkStats
    {
        if (!$this->getLinkStats) {
            $this->getLinkStats = new GetLinkStats($this->_provider);
        }
        return $this->getLinkStats;
    }

    /**
     * Returns the current time of the VK server.
     */
    public function getServerTime(): GetServerTime
    {
        if (!$this->getServerTime) {
            $this->getServerTime = new GetServerTime($this->_provider);
        }
        return $this->getServerTime;
    }

    /**
     * Allows to receive a link shortened via vk.cc.
     */
    public function getShortLink(): GetShortLink
    {
        if (!$this->getShortLink) {
            $this->getShortLink = new GetShortLink($this->_provider);
        }
        return $this->getShortLink;
    }

    /**
     * Detects a type of object (e.g., user, community, application) and its ID by screen name.
     */
    public function resolveScreenName(): ResolveScreenName
    {
        if (!$this->resolveScreenName) {
            $this->resolveScreenName = new ResolveScreenName($this->_provider);
        }
        return $this->resolveScreenName;
    }

}