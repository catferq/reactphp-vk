<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a community.
 */
class Edit
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $title = '';
    private string $description = '';
    private string $screenName = '';
    private int $access = 0;
    private string $website = '';
    private string $subject = '';
    private string $email = '';
    private string $phone = '';
    private string $rss = '';
    private int $eventStartDate = 0;
    private int $eventFinishDate = 0;
    private int $eventGroupId = 0;
    private int $publicCategory = 0;
    private int $publicSubcategory = 0;
    private string $publicDate = '';
    private int $wall = 0;
    private int $topics = 0;
    private int $photos = 0;
    private int $video = 0;
    private int $audio = 0;
    private bool $links = false;
    private bool $events = false;
    private bool $places = false;
    private bool $contacts = false;
    private int $docs = 0;
    private int $wiki = 0;
    private bool $messages = false;
    private bool $articles = false;
    private bool $addresses = false;
    private int $ageLimits = 1;
    private bool $market = false;
    private bool $marketComments = false;
    private array $marketCountry = [];
    private array $marketCity = [];
    private int $marketCurrency = 0;
    private int $marketContact = 0;
    private int $marketWiki = 0;
    private bool $obsceneFilter = false;
    private bool $obsceneStopwords = false;
    private array $obsceneWords = [];
    private int $mainSection = 0;
    private int $secondarySection = 0;
    private int $country = 0;
    private int $city = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setGroupId(int $value): Edit
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Community title.
     * 
     * @param string $value
     * @return Edit
     */
    public function setTitle(string $value): Edit
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Community description.
     * 
     * @param string $value
     * @return Edit
     */
    public function setDescription(string $value): Edit
    {
        $this->description = $value;
        return $this;
    }

    /**
     * Community screen name.
     * 
     * @param string $value
     * @return Edit
     */
    public function setScreenName(string $value): Edit
    {
        $this->screenName = $value;
        return $this;
    }

    /**
     * Community type. Possible values: *'0' – open,, *'1' – closed,, *'2' – private.
     * 
     * @param int $value
     * @return Edit
     */
    public function setAccess(int $value): Edit
    {
        $this->access = $value;
        return $this;
    }

    /**
     * Website that will be displayed in the community information field.
     * 
     * @param string $value
     * @return Edit
     */
    public function setWebsite(string $value): Edit
    {
        $this->website = $value;
        return $this;
    }

    /**
     * Community subject. Possible values: , *'1' – auto/moto,, *'2' – activity holidays,, *'3' – business,, *'4' – pets,, *'5' – health,, *'6' – dating and communication, , *'7' – games,, *'8' – IT (computers and software),, *'9' – cinema,, *'10' – beauty and fashion,, *'11' – cooking,, *'12' – art and culture,, *'13' – literature,, *'14' – mobile services and internet,, *'15' – music,, *'16' – science and technology,, *'17' – real estate,, *'18' – news and media,, *'19' – security,, *'20' – education,, *'21' – home and renovations,, *'22' – politics,, *'23' – food,, *'24' – industry,, *'25' – travel,, *'26' – work,, *'27' – entertainment,, *'28' – religion,, *'29' – family,, *'30' – sports,, *'31' – insurance,, *'32' – television,, *'33' – goods and services,, *'34' – hobbies,, *'35' – finance,, *'36' – photo,, *'37' – esoterics,, *'38' – electronics and appliances,, *'39' – erotic,, *'40' – humor,, *'41' – society, humanities,, *'42' – design and graphics.
     * 
     * @param string $value
     * @return Edit
     */
    public function setSubject(string $value): Edit
    {
        $this->subject = $value;
        return $this;
    }

    /**
     * Organizer email (for events).
     * 
     * @param string $value
     * @return Edit
     */
    public function setEmail(string $value): Edit
    {
        $this->email = $value;
        return $this;
    }

    /**
     * Organizer phone number (for events).
     * 
     * @param string $value
     * @return Edit
     */
    public function setPhone(string $value): Edit
    {
        $this->phone = $value;
        return $this;
    }

    /**
     * RSS feed address for import (available only to communities with special permission. Contact vk.com/support to get it.
     * 
     * @param string $value
     * @return Edit
     */
    public function setRss(string $value): Edit
    {
        $this->rss = $value;
        return $this;
    }

    /**
     * Event start date in Unixtime format.
     * 
     * @param int $value
     * @return Edit
     */
    public function setEventStartDate(int $value): Edit
    {
        $this->eventStartDate = $value;
        return $this;
    }

    /**
     * Event finish date in Unixtime format.
     * 
     * @param int $value
     * @return Edit
     */
    public function setEventFinishDate(int $value): Edit
    {
        $this->eventFinishDate = $value;
        return $this;
    }

    /**
     * Organizer community ID (for events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setEventGroupId(int $value): Edit
    {
        $this->eventGroupId = $value;
        return $this;
    }

    /**
     * Public page category ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setPublicCategory(int $value): Edit
    {
        $this->publicCategory = $value;
        return $this;
    }

    /**
     * Public page subcategory ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setPublicSubcategory(int $value): Edit
    {
        $this->publicSubcategory = $value;
        return $this;
    }

    /**
     * Founding date of a company or organization owning the community in "dd.mm.YYYY" format.
     * 
     * @param string $value
     * @return Edit
     */
    public function setPublicDate(string $value): Edit
    {
        $this->publicDate = $value;
        return $this;
    }

    /**
     * Wall settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (groups and events only),, *'3' – closed (groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setWall(int $value): Edit
    {
        $this->wall = $value;
        return $this;
    }

    /**
     * Board topics settings. Possbile values: , *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setTopics(int $value): Edit
    {
        $this->topics = $value;
        return $this;
    }

    /**
     * Photos settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setPhotos(int $value): Edit
    {
        $this->photos = $value;
        return $this;
    }

    /**
     * Video settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setVideo(int $value): Edit
    {
        $this->video = $value;
        return $this;
    }

    /**
     * Audio settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setAudio(int $value): Edit
    {
        $this->audio = $value;
        return $this;
    }

    /**
     * Links settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setLinks(bool $value): Edit
    {
        $this->links = $value;
        return $this;
    }

    /**
     * Events settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setEvents(bool $value): Edit
    {
        $this->events = $value;
        return $this;
    }

    /**
     * Places settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setPlaces(bool $value): Edit
    {
        $this->places = $value;
        return $this;
    }

    /**
     * Contacts settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setContacts(bool $value): Edit
    {
        $this->contacts = $value;
        return $this;
    }

    /**
     * Documents settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setDocs(int $value): Edit
    {
        $this->docs = $value;
        return $this;
    }

    /**
     * Wiki pages settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * 
     * @param int $value
     * @return Edit
     */
    public function setWiki(int $value): Edit
    {
        $this->wiki = $value;
        return $this;
    }

    /**
     * Community messages. Possible values: *'0' — disabled,, *'1' — enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setMessages(bool $value): Edit
    {
        $this->messages = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setArticles(bool $value): Edit
    {
        $this->articles = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setAddresses(bool $value): Edit
    {
        $this->addresses = $value;
        return $this;
    }

    /**
     * Community age limits. Possible values: *'1' — no limits,, *'2' — 16+,, *'3' — 18+.
     * 
     * @param int $value
     * @return Edit
     */
    public function setAgeLimits(int $value): Edit
    {
        $this->ageLimits = $value;
        return $this;
    }

    /**
     * Market settings. Possible values: *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setMarket(bool $value): Edit
    {
        $this->market = $value;
        return $this;
    }

    /**
     * market comments settings. Possible values: *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setMarketComments(bool $value): Edit
    {
        $this->marketComments = $value;
        return $this;
    }

    /**
     * Market delivery countries.
     * 
     * @param array $value
     * @return Edit
     */
    public function setMarketCountry(array $value): Edit
    {
        $this->marketCountry = $value;
        return $this;
    }

    /**
     * Market delivery cities (if only one country is specified).
     * 
     * @param array $value
     * @return Edit
     */
    public function setMarketCity(array $value): Edit
    {
        $this->marketCity = $value;
        return $this;
    }

    /**
     * Market currency settings. Possbile values: , *'643' – Russian rubles,, *'980' – Ukrainian hryvnia,, *'398' – Kazakh tenge,, *'978' – Euro,, *'840' – US dollars
     * 
     * @param int $value
     * @return Edit
     */
    public function setMarketCurrency(int $value): Edit
    {
        $this->marketCurrency = $value;
        return $this;
    }

    /**
     * Seller contact for market. Set '0' for community messages.
     * 
     * @param int $value
     * @return Edit
     */
    public function setMarketContact(int $value): Edit
    {
        $this->marketContact = $value;
        return $this;
    }

    /**
     * ID of a wiki page with market description.
     * 
     * @param int $value
     * @return Edit
     */
    public function setMarketWiki(int $value): Edit
    {
        $this->marketWiki = $value;
        return $this;
    }

    /**
     * Obscene expressions filter in comments. Possible values: , *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setObsceneFilter(bool $value): Edit
    {
        $this->obsceneFilter = $value;
        return $this;
    }

    /**
     * Stopwords filter in comments. Possible values: , *'0' – disabled,, *'1' – enabled.
     * 
     * @param bool $value
     * @return Edit
     */
    public function setObsceneStopwords(bool $value): Edit
    {
        $this->obsceneStopwords = $value;
        return $this;
    }

    /**
     * Keywords for stopwords filter.
     * 
     * @param array $value
     * @return Edit
     */
    public function setObsceneWords(array $value): Edit
    {
        $this->obsceneWords = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setMainSection(int $value): Edit
    {
        $this->mainSection = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setSecondarySection(int $value): Edit
    {
        $this->secondarySection = $value;
        return $this;
    }

    /**
     * Country of the community.
     * 
     * @param int $value
     * @return Edit
     */
    public function setCountry(int $value): Edit
    {
        $this->country = $value;
        return $this;
    }

    /**
     * City of the community.
     * 
     * @param int $value
     * @return Edit
     */
    public function setCity(int $value): Edit
    {
        $this->city = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->description !== '') $params['description'] = $this->description;
        if ($this->screenName !== '') $params['screen_name'] = $this->screenName;
        if ($this->access !== 0) $params['access'] = $this->access;
        if ($this->website !== '') $params['website'] = $this->website;
        if ($this->subject !== '') $params['subject'] = $this->subject;
        if ($this->email !== '') $params['email'] = $this->email;
        if ($this->phone !== '') $params['phone'] = $this->phone;
        if ($this->rss !== '') $params['rss'] = $this->rss;
        if ($this->eventStartDate !== 0) $params['event_start_date'] = $this->eventStartDate;
        if ($this->eventFinishDate !== 0) $params['event_finish_date'] = $this->eventFinishDate;
        if ($this->eventGroupId !== 0) $params['event_group_id'] = $this->eventGroupId;
        if ($this->publicCategory !== 0) $params['public_category'] = $this->publicCategory;
        if ($this->publicSubcategory !== 0) $params['public_subcategory'] = $this->publicSubcategory;
        if ($this->publicDate !== '') $params['public_date'] = $this->publicDate;
        if ($this->wall !== 0) $params['wall'] = $this->wall;
        if ($this->topics !== 0) $params['topics'] = $this->topics;
        if ($this->photos !== 0) $params['photos'] = $this->photos;
        if ($this->video !== 0) $params['video'] = $this->video;
        if ($this->audio !== 0) $params['audio'] = $this->audio;
        if ($this->links !== false) $params['links'] = intval($this->links);
        if ($this->events !== false) $params['events'] = intval($this->events);
        if ($this->places !== false) $params['places'] = intval($this->places);
        if ($this->contacts !== false) $params['contacts'] = intval($this->contacts);
        if ($this->docs !== 0) $params['docs'] = $this->docs;
        if ($this->wiki !== 0) $params['wiki'] = $this->wiki;
        if ($this->messages !== false) $params['messages'] = intval($this->messages);
        if ($this->articles !== false) $params['articles'] = intval($this->articles);
        if ($this->addresses !== false) $params['addresses'] = intval($this->addresses);
        if ($this->ageLimits !== 1) $params['age_limits'] = $this->ageLimits;
        if ($this->market !== false) $params['market'] = intval($this->market);
        if ($this->marketComments !== false) $params['market_comments'] = intval($this->marketComments);
        if ($this->marketCountry !== []) $params['market_country'] = implode(',', $this->marketCountry);
        if ($this->marketCity !== []) $params['market_city'] = implode(',', $this->marketCity);
        if ($this->marketCurrency !== 0) $params['market_currency'] = $this->marketCurrency;
        if ($this->marketContact !== 0) $params['market_contact'] = $this->marketContact;
        if ($this->marketWiki !== 0) $params['market_wiki'] = $this->marketWiki;
        if ($this->obsceneFilter !== false) $params['obscene_filter'] = intval($this->obsceneFilter);
        if ($this->obsceneStopwords !== false) $params['obscene_stopwords'] = intval($this->obsceneStopwords);
        if ($this->obsceneWords !== []) $params['obscene_words'] = implode(',', $this->obsceneWords);
        if ($this->mainSection !== 0) $params['main_section'] = $this->mainSection;
        if ($this->secondarySection !== 0) $params['secondary_section'] = $this->secondarySection;
        if ($this->country !== 0) $params['country'] = $this->country;
        if ($this->city !== 0) $params['city'] = $this->city;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->title = '';
            $this->description = '';
            $this->screenName = '';
            $this->access = 0;
            $this->website = '';
            $this->subject = '';
            $this->email = '';
            $this->phone = '';
            $this->rss = '';
            $this->eventStartDate = 0;
            $this->eventFinishDate = 0;
            $this->eventGroupId = 0;
            $this->publicCategory = 0;
            $this->publicSubcategory = 0;
            $this->publicDate = '';
            $this->wall = 0;
            $this->topics = 0;
            $this->photos = 0;
            $this->video = 0;
            $this->audio = 0;
            $this->links = false;
            $this->events = false;
            $this->places = false;
            $this->contacts = false;
            $this->docs = 0;
            $this->wiki = 0;
            $this->messages = false;
            $this->articles = false;
            $this->addresses = false;
            $this->ageLimits = 1;
            $this->market = false;
            $this->marketComments = false;
            $this->marketCountry = [];
            $this->marketCity = [];
            $this->marketCurrency = 0;
            $this->marketContact = 0;
            $this->marketWiki = 0;
            $this->obsceneFilter = false;
            $this->obsceneStopwords = false;
            $this->obsceneWords = [];
            $this->mainSection = 0;
            $this->secondarySection = 0;
            $this->country = 0;
            $this->city = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.edit', $params);
    }
}