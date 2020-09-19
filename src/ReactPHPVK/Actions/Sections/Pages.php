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

    private ?Pages\ClearCache $clearCache = null;
    private ?Pages\Get $get = null;
    private ?Pages\GetHistory $getHistory = null;
    private ?Pages\GetTitles $getTitles = null;
    private ?Pages\GetVersion $getVersion = null;
    private ?Pages\ParseWiki $parseWiki = null;
    private ?Pages\Save $save = null;
    private ?Pages\SaveAccess $saveAccess = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to clear the cache of particular 'external' pages which may be attached to VK posts.
     */
    public function clearCache(): ClearCache
    {
        if (!$this->clearCache) {
            $this->clearCache = new ClearCache($this->_provider);
        }
        return $this->clearCache;
    }

    /**
     * Returns information about a wiki page.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of all previous versions of a wiki page.
     */
    public function getHistory(): GetHistory
    {
        if (!$this->getHistory) {
            $this->getHistory = new GetHistory($this->_provider);
        }
        return $this->getHistory;
    }

    /**
     * Returns a list of wiki pages in a group.
     */
    public function getTitles(): GetTitles
    {
        if (!$this->getTitles) {
            $this->getTitles = new GetTitles($this->_provider);
        }
        return $this->getTitles;
    }

    /**
     * Returns the text of one of the previous versions of a wiki page.
     */
    public function getVersion(): GetVersion
    {
        if (!$this->getVersion) {
            $this->getVersion = new GetVersion($this->_provider);
        }
        return $this->getVersion;
    }

    /**
     * Returns HTML representation of the wiki markup.
     */
    public function parseWiki(): ParseWiki
    {
        if (!$this->parseWiki) {
            $this->parseWiki = new ParseWiki($this->_provider);
        }
        return $this->parseWiki;
    }

    /**
     * Saves the text of a wiki page.
     */
    public function save(): Save
    {
        if (!$this->save) {
            $this->save = new Save($this->_provider);
        }
        return $this->save;
    }

    /**
     * Saves modified read and edit access settings for a wiki page.
     */
    public function saveAccess(): SaveAccess
    {
        if (!$this->saveAccess) {
            $this->saveAccess = new SaveAccess($this->_provider);
        }
        return $this->saveAccess;
    }

}