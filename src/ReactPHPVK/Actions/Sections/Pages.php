<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Pages\ClearCache;
use ReactPHPVK\Actions\Sections\Pages\Get;
use ReactPHPVK\Actions\Sections\Pages\GetHistory;
use ReactPHPVK\Actions\Sections\Pages\GetTitles;
use ReactPHPVK\Actions\Sections\Pages\GetVersion;
use ReactPHPVK\Actions\Sections\Pages\ParseWiki;
use ReactPHPVK\Actions\Sections\Pages\Save;
use ReactPHPVK\Actions\Sections\Pages\SaveAccess;

class Pages
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to clear the cache of particular 'external' pages which may be attached to VK posts.
     */
    public function clearCache(): ClearCache
    {
        return new ClearCache($this->_provider);
    }

    /**
     * Returns information about a wiki page.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of all previous versions of a wiki page.
     */
    public function getHistory(): GetHistory
    {
        return new GetHistory($this->_provider);
    }

    /**
     * Returns a list of wiki pages in a group.
     */
    public function getTitles(): GetTitles
    {
        return new GetTitles($this->_provider);
    }

    /**
     * Returns the text of one of the previous versions of a wiki page.
     */
    public function getVersion(): GetVersion
    {
        return new GetVersion($this->_provider);
    }

    /**
     * Returns HTML representation of the wiki markup.
     */
    public function parseWiki(): ParseWiki
    {
        return new ParseWiki($this->_provider);
    }

    /**
     * Saves the text of a wiki page.
     */
    public function save(): Save
    {
        return new Save($this->_provider);
    }

    /**
     * Saves modified read and edit access settings for a wiki page.
     */
    public function saveAccess(): SaveAccess
    {
        return new SaveAccess($this->_provider);
    }

}