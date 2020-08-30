<?php

namespace ReactPHPVK\Client;

use ReactPHPVK\Actions\Sections\Account;
use ReactPHPVK\Actions\Sections\Ads;
use ReactPHPVK\Actions\Sections\AppWidgets;
use ReactPHPVK\Actions\Sections\Apps;
use ReactPHPVK\Actions\Sections\Auth;
use ReactPHPVK\Actions\Sections\Board;
use ReactPHPVK\Actions\Sections\Database;
use ReactPHPVK\Actions\Sections\Docs;
use ReactPHPVK\Actions\Sections\DownloadedGames;
use ReactPHPVK\Actions\Sections\Fave;
use ReactPHPVK\Actions\Sections\Friends;
use ReactPHPVK\Actions\Sections\Gifts;
use ReactPHPVK\Actions\Sections\Groups;
use ReactPHPVK\Actions\Sections\Leads;
use ReactPHPVK\Actions\Sections\Likes;
use ReactPHPVK\Actions\Sections\Market;
use ReactPHPVK\Actions\Sections\Messages;
use ReactPHPVK\Actions\Sections\Newsfeed;
use ReactPHPVK\Actions\Sections\Notes;
use ReactPHPVK\Actions\Sections\Notifications;
use ReactPHPVK\Actions\Sections\Orders;
use ReactPHPVK\Actions\Sections\Pages;
use ReactPHPVK\Actions\Sections\Photos;
use ReactPHPVK\Actions\Sections\Polls;
use ReactPHPVK\Actions\Sections\PrettyCards;
use ReactPHPVK\Actions\Sections\Search;
use ReactPHPVK\Actions\Sections\Secure;
use ReactPHPVK\Actions\Sections\Stats;
use ReactPHPVK\Actions\Sections\Status;
use ReactPHPVK\Actions\Sections\Storage;
use ReactPHPVK\Actions\Sections\Stories;
use ReactPHPVK\Actions\Sections\Streaming;
use ReactPHPVK\Actions\Sections\Users;
use ReactPHPVK\Actions\Sections\Utils;
use ReactPHPVK\Actions\Sections\Video;
use ReactPHPVK\Actions\Sections\Wall;
use ReactPHPVK\Actions\Sections\Widgets;
use ReactPHPVK\Throttling\QManager;
use Clue\React\Buzz\Browser;
use React\EventLoop\LoopInterface;

class AVKClient
{
    public Provider $provider;

    private ?Account $account = null;
    private ?Ads $ads = null;
    private ?AppWidgets $appWidgets = null;
    private ?Apps $apps = null;
    private ?Auth $auth = null;
    private ?Board $board = null;
    private ?Database $database = null;
    private ?Docs $docs = null;
    private ?DownloadedGames $downloadedGames = null;
    private ?Fave $fave = null;
    private ?Friends $friends = null;
    private ?Gifts $gifts = null;
    private ?Groups $groups = null;
    private ?Leads $leads = null;
    private ?Likes $likes = null;
    private ?Market $market = null;
    private ?Messages $messages = null;
    private ?Newsfeed $newsfeed = null;
    private ?Notes $notes = null;
    private ?Notifications $notifications = null;
    private ?Orders $orders = null;
    private ?Pages $pages = null;
    private ?Photos $photos = null;
    private ?Polls $polls = null;
    private ?PrettyCards $prettyCards = null;
    private ?Search $search = null;
    private ?Secure $secure = null;
    private ?Stats $stats = null;
    private ?Status $status = null;
    private ?Storage $storage = null;
    private ?Stories $stories = null;
    private ?Streaming $streaming = null;
    private ?Users $users = null;
    private ?Utils $utils = null;
    private ?Video $video = null;
    private ?Wall $wall = null;
    private ?Widgets $widgets = null;

    /**
     * Provider constructor.
     * @param LoopInterface $loop
     * @param string $accessToken
     * @param Browser|null $browser
     * @param float $limiter
     * @param float $version
     * @param string|null $language
     * @param QManager|null $qManager
     */
    public function __construct(LoopInterface $loop, string $accessToken, Browser $browser = null, float $limiter = 0, float $version = 5.122, $language = null, QManager $qManager = null)
    {
        $this->provider = new Provider($loop, $accessToken, $browser, $limiter, $version, $language, $qManager);
    }

    public function account(): Account
    {
        if (!$this->account) {
            $this->account = new Account($this->provider);
        }
        return $this->account;
    }

    public function ads(): Ads
    {
        if (!$this->ads) {
            $this->ads = new Ads($this->provider);
        }
        return $this->ads;
    }

    public function appWidgets(): AppWidgets
    {
        if (!$this->appWidgets) {
            $this->appWidgets = new AppWidgets($this->provider);
        }
        return $this->appWidgets;
    }

    public function apps(): Apps
    {
        if (!$this->apps) {
            $this->apps = new Apps($this->provider);
        }
        return $this->apps;
    }

    public function auth(): Auth
    {
        if (!$this->auth) {
            $this->auth = new Auth($this->provider);
        }
        return $this->auth;
    }

    public function board(): Board
    {
        if (!$this->board) {
            $this->board = new Board($this->provider);
        }
        return $this->board;
    }

    public function database(): Database
    {
        if (!$this->database) {
            $this->database = new Database($this->provider);
        }
        return $this->database;
    }

    public function docs(): Docs
    {
        if (!$this->docs) {
            $this->docs = new Docs($this->provider);
        }
        return $this->docs;
    }

    public function downloadedGames(): DownloadedGames
    {
        if (!$this->downloadedGames) {
            $this->downloadedGames = new DownloadedGames($this->provider);
        }
        return $this->downloadedGames;
    }

    public function fave(): Fave
    {
        if (!$this->fave) {
            $this->fave = new Fave($this->provider);
        }
        return $this->fave;
    }

    public function friends(): Friends
    {
        if (!$this->friends) {
            $this->friends = new Friends($this->provider);
        }
        return $this->friends;
    }

    public function gifts(): Gifts
    {
        if (!$this->gifts) {
            $this->gifts = new Gifts($this->provider);
        }
        return $this->gifts;
    }

    public function groups(): Groups
    {
        if (!$this->groups) {
            $this->groups = new Groups($this->provider);
        }
        return $this->groups;
    }

    public function leads(): Leads
    {
        if (!$this->leads) {
            $this->leads = new Leads($this->provider);
        }
        return $this->leads;
    }

    public function likes(): Likes
    {
        if (!$this->likes) {
            $this->likes = new Likes($this->provider);
        }
        return $this->likes;
    }

    public function market(): Market
    {
        if (!$this->market) {
            $this->market = new Market($this->provider);
        }
        return $this->market;
    }

    public function messages(): Messages
    {
        if (!$this->messages) {
            $this->messages = new Messages($this->provider);
        }
        return $this->messages;
    }

    public function newsfeed(): Newsfeed
    {
        if (!$this->newsfeed) {
            $this->newsfeed = new Newsfeed($this->provider);
        }
        return $this->newsfeed;
    }

    public function notes(): Notes
    {
        if (!$this->notes) {
            $this->notes = new Notes($this->provider);
        }
        return $this->notes;
    }

    public function notifications(): Notifications
    {
        if (!$this->notifications) {
            $this->notifications = new Notifications($this->provider);
        }
        return $this->notifications;
    }

    public function orders(): Orders
    {
        if (!$this->orders) {
            $this->orders = new Orders($this->provider);
        }
        return $this->orders;
    }

    public function pages(): Pages
    {
        if (!$this->pages) {
            $this->pages = new Pages($this->provider);
        }
        return $this->pages;
    }

    public function photos(): Photos
    {
        if (!$this->photos) {
            $this->photos = new Photos($this->provider);
        }
        return $this->photos;
    }

    public function polls(): Polls
    {
        if (!$this->polls) {
            $this->polls = new Polls($this->provider);
        }
        return $this->polls;
    }

    public function prettyCards(): PrettyCards
    {
        if (!$this->prettyCards) {
            $this->prettyCards = new PrettyCards($this->provider);
        }
        return $this->prettyCards;
    }

    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->provider);
        }
        return $this->search;
    }

    public function secure(): Secure
    {
        if (!$this->secure) {
            $this->secure = new Secure($this->provider);
        }
        return $this->secure;
    }

    public function stats(): Stats
    {
        if (!$this->stats) {
            $this->stats = new Stats($this->provider);
        }
        return $this->stats;
    }

    public function status(): Status
    {
        if (!$this->status) {
            $this->status = new Status($this->provider);
        }
        return $this->status;
    }

    public function storage(): Storage
    {
        if (!$this->storage) {
            $this->storage = new Storage($this->provider);
        }
        return $this->storage;
    }

    public function stories(): Stories
    {
        if (!$this->stories) {
            $this->stories = new Stories($this->provider);
        }
        return $this->stories;
    }

    public function streaming(): Streaming
    {
        if (!$this->streaming) {
            $this->streaming = new Streaming($this->provider);
        }
        return $this->streaming;
    }

    public function users(): Users
    {
        if (!$this->users) {
            $this->users = new Users($this->provider);
        }
        return $this->users;
    }

    public function utils(): Utils
    {
        if (!$this->utils) {
            $this->utils = new Utils($this->provider);
        }
        return $this->utils;
    }

    public function video(): Video
    {
        if (!$this->video) {
            $this->video = new Video($this->provider);
        }
        return $this->video;
    }

    public function wall(): Wall
    {
        if (!$this->wall) {
            $this->wall = new Wall($this->provider);
        }
        return $this->wall;
    }

    public function widgets(): Widgets
    {
        if (!$this->widgets) {
            $this->widgets = new Widgets($this->provider);
        }
        return $this->widgets;
    }
}
