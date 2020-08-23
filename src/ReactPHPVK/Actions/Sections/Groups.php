<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Groups
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * groups.addAddress
     * 
     * @param int $groupId
     * @param string $title
     * @param string $address
     * @param int $countryId
     * @param int $cityId
     * @param float $latitude
     * @param float $longitude
     * @param string|null $additionalAddress
     * @param int|null $metroId
     * @param string|null $phone
     * @param string|null $workInfoStatus
     * @param string|null $timetable
     * @param bool|null $isMainAddress
     * @param array|null $custom
     * @return Promise
     */
    function addAddress(int $groupId, string $title, string $address, int $countryId, int $cityId, float $latitude, float $longitude, ?string $additionalAddress = '', ?int $metroId = 0, ?string $phone = '', ?string $workInfoStatus = 'no_information', ?string $timetable = '', ?bool $isMainAddress = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['title'] = $title;
        $sendParams['address'] = $address;
        $sendParams['country_id'] = $countryId;
        $sendParams['city_id'] = $cityId;
        $sendParams['latitude'] = $latitude;
        $sendParams['longitude'] = $longitude;
        if ($additionalAddress !== '' && $additionalAddress != null) $sendParams['additional_address'] = $additionalAddress;
        if ($metroId !== 0 && $metroId != null) $sendParams['metro_id'] = $metroId;
        if ($phone !== '' && $phone != null) $sendParams['phone'] = $phone;
        if ($workInfoStatus !== 'no_information' && $workInfoStatus != null) $sendParams['work_info_status'] = $workInfoStatus;
        if ($timetable !== '' && $timetable != null) $sendParams['timetable'] = $timetable;
        if ($isMainAddress !== false && $isMainAddress != null) $sendParams['is_main_address'] = intval($isMainAddress);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.addAddress', $sendParams);
    }

    /**
     * groups.addCallbackServer
     * 
     * @param int $groupId
     * @param string $url
     * @param string $title
     * @param string|null $secretKey
     * @param array|null $custom
     * @return Promise
     */
    function addCallbackServer(int $groupId, string $url, string $title, ?string $secretKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['url'] = $url;
        $sendParams['title'] = $title;
        if ($secretKey !== '' && $secretKey != null) $sendParams['secret_key'] = $secretKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.addCallbackServer', $sendParams);
    }

    /**
     * Allows to add a link to the community.
     * 
     * @param int $groupId Community ID.
     * @param string $link Link URL.
     * @param string|null $text Description text for the link.
     * @param array|null $custom
     * @return Promise
     */
    function addLink(int $groupId, string $link, ?string $text = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['link'] = $link;
        if ($text !== '' && $text != null) $sendParams['text'] = $text;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.addLink', $sendParams);
    }

    /**
     * Allows to approve join request to the community.
     * 
     * @param int $groupId Community ID.
     * @param int $userId User ID.
     * @param array|null $custom
     * @return Promise
     */
    function approveRequest(int $groupId, int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.approveRequest', $sendParams);
    }

    /**
     * groups.ban
     * 
     * @param int $groupId
     * @param int|null $ownerId
     * @param int|null $endDate
     * @param int|null $reason
     * @param string|null $comment
     * @param bool|null $commentVisible
     * @param array|null $custom
     * @return Promise
     */
    function ban(int $groupId, ?int $ownerId = 0, ?int $endDate = 0, ?int $reason = 0, ?string $comment = '', ?bool $commentVisible = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($endDate !== 0 && $endDate != null) $sendParams['end_date'] = $endDate;
        if ($reason !== 0 && $reason != null) $sendParams['reason'] = $reason;
        if ($comment !== '' && $comment != null) $sendParams['comment'] = $comment;
        if ($commentVisible !== false && $commentVisible != null) $sendParams['comment_visible'] = intval($commentVisible);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.ban', $sendParams);
    }

    /**
     * Creates a new community.
     * 
     * @param string $title Community title.
     * @param string|null $description Community description (ignored for 'type' = 'public').
     * @param string|null $type Community type. Possible values: *'group' – group,, *'event' – event,, *'public' – public page
     * @param int|null $publicCategory Category ID (for 'type' = 'public' only).
     * @param int|null $subtype Public page subtype. Possible values: *'1' – place or small business,, *'2' – company, organization or website,, *'3' – famous person or group of people,, *'4' – product or work of art.
     * @param array|null $custom
     * @return Promise
     */
    function create(string $title, ?string $description = '', ?string $type = 'group', ?int $publicCategory = 0, ?int $subtype = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['title'] = $title;
        if ($description !== '' && $description != null) $sendParams['description'] = $description;
        if ($type !== 'group' && $type != null) $sendParams['type'] = $type;
        if ($publicCategory !== 0 && $publicCategory != null) $sendParams['public_category'] = $publicCategory;
        if ($subtype !== 0 && $subtype != null) $sendParams['subtype'] = $subtype;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.create', $sendParams);
    }

    /**
     * groups.deleteCallbackServer
     * 
     * @param int $groupId
     * @param int $serverId
     * @param array|null $custom
     * @return Promise
     */
    function deleteCallbackServer(int $groupId, int $serverId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['server_id'] = $serverId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.deleteCallbackServer', $sendParams);
    }

    /**
     * Allows to delete a link from the community.
     * 
     * @param int $groupId Community ID.
     * @param int $linkId Link ID.
     * @param array|null $custom
     * @return Promise
     */
    function deleteLink(int $groupId, int $linkId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['link_id'] = $linkId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.deleteLink', $sendParams);
    }

    /**
     * groups.disableOnline
     * 
     * @param int $groupId
     * @param array|null $custom
     * @return Promise
     */
    function disableOnline(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.disableOnline', $sendParams);
    }

    /**
     * Edits a community.
     * 
     * @param int $groupId Community ID.
     * @param string|null $title Community title.
     * @param string|null $description Community description.
     * @param string|null $screenName Community screen name.
     * @param int|null $access Community type. Possible values: *'0' – open,, *'1' – closed,, *'2' – private.
     * @param string|null $website Website that will be displayed in the community information field.
     * @param string|null $subject Community subject. Possible values: , *'1' – auto/moto,, *'2' – activity holidays,, *'3' – business,, *'4' – pets,, *'5' – health,, *'6' – dating and communication, , *'7' – games,, *'8' – IT (computers and software),, *'9' – cinema,, *'10' – beauty and fashion,, *'11' – cooking,, *'12' – art and culture,, *'13' – literature,, *'14' – mobile services and internet,, *'15' – music,, *'16' – science and technology,, *'17' – real estate,, *'18' – news and media,, *'19' – security,, *'20' – education,, *'21' – home and renovations,, *'22' – politics,, *'23' – food,, *'24' – industry,, *'25' – travel,, *'26' – work,, *'27' – entertainment,, *'28' – religion,, *'29' – family,, *'30' – sports,, *'31' – insurance,, *'32' – television,, *'33' – goods and services,, *'34' – hobbies,, *'35' – finance,, *'36' – photo,, *'37' – esoterics,, *'38' – electronics and appliances,, *'39' – erotic,, *'40' – humor,, *'41' – society, humanities,, *'42' – design and graphics.
     * @param string|null $email Organizer email (for events).
     * @param string|null $phone Organizer phone number (for events).
     * @param string|null $rss RSS feed address for import (available only to communities with special permission. Contact vk.com/support to get it.
     * @param int|null $eventStartDate Event start date in Unixtime format.
     * @param int|null $eventFinishDate Event finish date in Unixtime format.
     * @param int|null $eventGroupId Organizer community ID (for events only).
     * @param int|null $publicCategory Public page category ID.
     * @param int|null $publicSubcategory Public page subcategory ID.
     * @param string|null $publicDate Founding date of a company or organization owning the community in "dd.mm.YYYY" format.
     * @param int|null $wall Wall settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (groups and events only),, *'3' – closed (groups and events only).
     * @param int|null $topics Board topics settings. Possbile values: , *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * @param int|null $photos Photos settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * @param int|null $video Video settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * @param int|null $audio Audio settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * @param bool|null $links Links settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * @param bool|null $events Events settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * @param bool|null $places Places settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * @param bool|null $contacts Contacts settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
     * @param int|null $docs Documents settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * @param int|null $wiki Wiki pages settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
     * @param bool|null $messages Community messages. Possible values: *'0' — disabled,, *'1' — enabled.
     * @param bool|null $articles
     * @param bool|null $addresses
     * @param int|null $ageLimits Community age limits. Possible values: *'1' — no limits,, *'2' — 16+,, *'3' — 18+.
     * @param bool|null $market Market settings. Possible values: *'0' – disabled,, *'1' – enabled.
     * @param bool|null $marketComments market comments settings. Possible values: *'0' – disabled,, *'1' – enabled.
     * @param array|null $marketCountry Market delivery countries.
     * @param array|null $marketCity Market delivery cities (if only one country is specified).
     * @param int|null $marketCurrency Market currency settings. Possbile values: , *'643' – Russian rubles,, *'980' – Ukrainian hryvnia,, *'398' – Kazakh tenge,, *'978' – Euro,, *'840' – US dollars
     * @param int|null $marketContact Seller contact for market. Set '0' for community messages.
     * @param int|null $marketWiki ID of a wiki page with market description.
     * @param bool|null $obsceneFilter Obscene expressions filter in comments. Possible values: , *'0' – disabled,, *'1' – enabled.
     * @param bool|null $obsceneStopwords Stopwords filter in comments. Possible values: , *'0' – disabled,, *'1' – enabled.
     * @param array|null $obsceneWords Keywords for stopwords filter.
     * @param int|null $mainSection
     * @param int|null $secondarySection
     * @param int|null $country Country of the community.
     * @param int|null $city City of the community.
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $groupId, ?string $title = '', ?string $description = '', ?string $screenName = '', ?int $access = 0, ?string $website = '', ?string $subject = '', ?string $email = '', ?string $phone = '', ?string $rss = '', ?int $eventStartDate = 0, ?int $eventFinishDate = 0, ?int $eventGroupId = 0, ?int $publicCategory = 0, ?int $publicSubcategory = 0, ?string $publicDate = '', ?int $wall = 0, ?int $topics = 0, ?int $photos = 0, ?int $video = 0, ?int $audio = 0, ?bool $links = false, ?bool $events = false, ?bool $places = false, ?bool $contacts = false, ?int $docs = 0, ?int $wiki = 0, ?bool $messages = false, ?bool $articles = false, ?bool $addresses = false, ?int $ageLimits = 1, ?bool $market = false, ?bool $marketComments = false, ?array $marketCountry = [], ?array $marketCity = [], ?int $marketCurrency = 0, ?int $marketContact = 0, ?int $marketWiki = 0, ?bool $obsceneFilter = false, ?bool $obsceneStopwords = false, ?array $obsceneWords = [], ?int $mainSection = 0, ?int $secondarySection = 0, ?int $country = 0, ?int $city = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($description !== '' && $description != null) $sendParams['description'] = $description;
        if ($screenName !== '' && $screenName != null) $sendParams['screen_name'] = $screenName;
        if ($access !== 0 && $access != null) $sendParams['access'] = $access;
        if ($website !== '' && $website != null) $sendParams['website'] = $website;
        if ($subject !== '' && $subject != null) $sendParams['subject'] = $subject;
        if ($email !== '' && $email != null) $sendParams['email'] = $email;
        if ($phone !== '' && $phone != null) $sendParams['phone'] = $phone;
        if ($rss !== '' && $rss != null) $sendParams['rss'] = $rss;
        if ($eventStartDate !== 0 && $eventStartDate != null) $sendParams['event_start_date'] = $eventStartDate;
        if ($eventFinishDate !== 0 && $eventFinishDate != null) $sendParams['event_finish_date'] = $eventFinishDate;
        if ($eventGroupId !== 0 && $eventGroupId != null) $sendParams['event_group_id'] = $eventGroupId;
        if ($publicCategory !== 0 && $publicCategory != null) $sendParams['public_category'] = $publicCategory;
        if ($publicSubcategory !== 0 && $publicSubcategory != null) $sendParams['public_subcategory'] = $publicSubcategory;
        if ($publicDate !== '' && $publicDate != null) $sendParams['public_date'] = $publicDate;
        if ($wall !== 0 && $wall != null) $sendParams['wall'] = $wall;
        if ($topics !== 0 && $topics != null) $sendParams['topics'] = $topics;
        if ($photos !== 0 && $photos != null) $sendParams['photos'] = $photos;
        if ($video !== 0 && $video != null) $sendParams['video'] = $video;
        if ($audio !== 0 && $audio != null) $sendParams['audio'] = $audio;
        if ($links !== false && $links != null) $sendParams['links'] = intval($links);
        if ($events !== false && $events != null) $sendParams['events'] = intval($events);
        if ($places !== false && $places != null) $sendParams['places'] = intval($places);
        if ($contacts !== false && $contacts != null) $sendParams['contacts'] = intval($contacts);
        if ($docs !== 0 && $docs != null) $sendParams['docs'] = $docs;
        if ($wiki !== 0 && $wiki != null) $sendParams['wiki'] = $wiki;
        if ($messages !== false && $messages != null) $sendParams['messages'] = intval($messages);
        if ($articles !== false && $articles != null) $sendParams['articles'] = intval($articles);
        if ($addresses !== false && $addresses != null) $sendParams['addresses'] = intval($addresses);
        if ($ageLimits !== 1 && $ageLimits != null) $sendParams['age_limits'] = $ageLimits;
        if ($market !== false && $market != null) $sendParams['market'] = intval($market);
        if ($marketComments !== false && $marketComments != null) $sendParams['market_comments'] = intval($marketComments);
        if ($marketCountry !== [] && $marketCountry != null) $sendParams['market_country'] = implode(',', $marketCountry);
        if ($marketCity !== [] && $marketCity != null) $sendParams['market_city'] = implode(',', $marketCity);
        if ($marketCurrency !== 0 && $marketCurrency != null) $sendParams['market_currency'] = $marketCurrency;
        if ($marketContact !== 0 && $marketContact != null) $sendParams['market_contact'] = $marketContact;
        if ($marketWiki !== 0 && $marketWiki != null) $sendParams['market_wiki'] = $marketWiki;
        if ($obsceneFilter !== false && $obsceneFilter != null) $sendParams['obscene_filter'] = intval($obsceneFilter);
        if ($obsceneStopwords !== false && $obsceneStopwords != null) $sendParams['obscene_stopwords'] = intval($obsceneStopwords);
        if ($obsceneWords !== [] && $obsceneWords != null) $sendParams['obscene_words'] = implode(',', $obsceneWords);
        if ($mainSection !== 0 && $mainSection != null) $sendParams['main_section'] = $mainSection;
        if ($secondarySection !== 0 && $secondarySection != null) $sendParams['secondary_section'] = $secondarySection;
        if ($country !== 0 && $country != null) $sendParams['country'] = $country;
        if ($city !== 0 && $city != null) $sendParams['city'] = $city;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.edit', $sendParams);
    }

    /**
     * groups.editAddress
     * 
     * @param int $groupId
     * @param int $addressId
     * @param string|null $title
     * @param string|null $address
     * @param string|null $additionalAddress
     * @param int|null $countryId
     * @param int|null $cityId
     * @param int|null $metroId
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string|null $phone
     * @param string|null $workInfoStatus
     * @param string|null $timetable
     * @param bool|null $isMainAddress
     * @param array|null $custom
     * @return Promise
     */
    function editAddress(int $groupId, int $addressId, ?string $title = '', ?string $address = '', ?string $additionalAddress = '', ?int $countryId = 0, ?int $cityId = 0, ?int $metroId = 0, ?float $latitude = 0, ?float $longitude = 0, ?string $phone = '', ?string $workInfoStatus = '', ?string $timetable = '', ?bool $isMainAddress = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['address_id'] = $addressId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($address !== '' && $address != null) $sendParams['address'] = $address;
        if ($additionalAddress !== '' && $additionalAddress != null) $sendParams['additional_address'] = $additionalAddress;
        if ($countryId !== 0 && $countryId != null) $sendParams['country_id'] = $countryId;
        if ($cityId !== 0 && $cityId != null) $sendParams['city_id'] = $cityId;
        if ($metroId !== 0 && $metroId != null) $sendParams['metro_id'] = $metroId;
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($phone !== '' && $phone != null) $sendParams['phone'] = $phone;
        if ($workInfoStatus !== '' && $workInfoStatus != null) $sendParams['work_info_status'] = $workInfoStatus;
        if ($timetable !== '' && $timetable != null) $sendParams['timetable'] = $timetable;
        if ($isMainAddress !== false && $isMainAddress != null) $sendParams['is_main_address'] = intval($isMainAddress);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.editAddress', $sendParams);
    }

    /**
     * groups.editCallbackServer
     * 
     * @param int $groupId
     * @param int $serverId
     * @param string $url
     * @param string $title
     * @param string|null $secretKey
     * @param array|null $custom
     * @return Promise
     */
    function editCallbackServer(int $groupId, int $serverId, string $url, string $title, ?string $secretKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['server_id'] = $serverId;
        $sendParams['url'] = $url;
        $sendParams['title'] = $title;
        if ($secretKey !== '' && $secretKey != null) $sendParams['secret_key'] = $secretKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.editCallbackServer', $sendParams);
    }

    /**
     * Allows to edit a link in the community.
     * 
     * @param int $groupId Community ID.
     * @param int $linkId Link ID.
     * @param string|null $text New description text for the link.
     * @param array|null $custom
     * @return Promise
     */
    function editLink(int $groupId, int $linkId, ?string $text = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['link_id'] = $linkId;
        if ($text !== '' && $text != null) $sendParams['text'] = $text;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.editLink', $sendParams);
    }

    /**
     * Allows to add, remove or edit the community manager.
     * 
     * @param int $groupId Community ID.
     * @param int $userId User ID.
     * @param string|null $role Manager role. Possible values: *'moderator',, *'editor',, *'administrator',, *'advertiser'.
     * @param bool|null $isContact '1' — to show the manager in Contacts block of the community.
     * @param string|null $contactPosition Position to show in Contacts block.
     * @param string|null $contactPhone Contact phone.
     * @param string|null $contactEmail Contact e-mail.
     * @param array|null $custom
     * @return Promise
     */
    function editManager(int $groupId, int $userId, ?string $role = '', ?bool $isContact = false, ?string $contactPosition = '', ?string $contactPhone = '', ?string $contactEmail = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['user_id'] = $userId;
        if ($role !== '' && $role != null) $sendParams['role'] = $role;
        if ($isContact !== false && $isContact != null) $sendParams['is_contact'] = intval($isContact);
        if ($contactPosition !== '' && $contactPosition != null) $sendParams['contact_position'] = $contactPosition;
        if ($contactPhone !== '' && $contactPhone != null) $sendParams['contact_phone'] = $contactPhone;
        if ($contactEmail !== '' && $contactEmail != null) $sendParams['contact_email'] = $contactEmail;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.editManager', $sendParams);
    }

    /**
     * groups.enableOnline
     * 
     * @param int $groupId
     * @param array|null $custom
     * @return Promise
     */
    function enableOnline(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.enableOnline', $sendParams);
    }

    /**
     * Returns a list of the communities to which a user belongs.
     * 
     * @param int|null $userId User ID.
     * @param bool|null $extended '1' — to return complete information about a user's communities, '0' — to return a list of community IDs without any additional fields (default),
     * @param array|null $filter Types of communities to return: 'admin' — to return communities administered by the user , 'editor' — to return communities where the user is an administrator or editor, 'moder' — to return communities where the user is an administrator, editor, or moderator, 'groups' — to return only groups, 'publics' — to return only public pages, 'events' — to return only events
     * @param array|null $fields Profile fields to return.
     * @param int|null $offset Offset needed to return a specific subset of communities.
     * @param int|null $count Number of communities to return.
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $userId = 0, ?bool $extended = false, ?array $filter = [], ?array $fields = [], ?int $offset = 0, ?int $count = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($filter !== [] && $filter != null) $sendParams['filter'] = implode(',', $filter);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.get', $sendParams);
    }

    /**
     * Returns a list of community addresses.
     * 
     * @param int $groupId ID or screen name of the community.
     * @param array|null $addressIds
     * @param float|null $latitude Latitude of  the user geo position.
     * @param float|null $longitude Longitude of the user geo position.
     * @param int|null $offset Offset needed to return a specific subset of community addresses.
     * @param int|null $count Number of community addresses to return.
     * @param array|null $fields Address fields
     * @param array|null $custom
     * @return Promise
     */
    function getAddresses(int $groupId, ?array $addressIds = [], ?float $latitude = 0, ?float $longitude = 0, ?int $offset = 0, ?int $count = 10, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($addressIds !== [] && $addressIds != null) $sendParams['address_ids'] = implode(',', $addressIds);
        if ($latitude !== 0 && $latitude != null) $sendParams['latitude'] = $latitude;
        if ($longitude !== 0 && $longitude != null) $sendParams['longitude'] = $longitude;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 10 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getAddresses', $sendParams);
    }

    /**
     * Returns a list of users on a community blacklist.
     * 
     * @param int $groupId Community ID.
     * @param int|null $offset Offset needed to return a specific subset of users.
     * @param int|null $count Number of users to return.
     * @param array|null $fields
     * @param int|null $ownerId
     * @param array|null $custom
     * @return Promise
     */
    function getBanned(int $groupId, ?int $offset = 0, ?int $count = 20, ?array $fields = [], ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getBanned', $sendParams);
    }

    /**
     * Returns information about communities by their IDs.
     * 
     * @param array|null $groupIds IDs or screen names of communities.
     * @param string|null $groupId ID or screen name of the community.
     * @param array|null $fields Group fields to return.
     * @param array|null $custom
     * @return Promise
     */
    function getById(?array $groupIds = [], ?string $groupId = '', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($groupIds !== [] && $groupIds != null) $sendParams['group_ids'] = implode(',', $groupIds);
        if ($groupId !== '' && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getById', $sendParams);
    }

    /**
     * Returns Callback API confirmation code for the community.
     * 
     * @param int $groupId Community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getCallbackConfirmationCode(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getCallbackConfirmationCode', $sendParams);
    }

    /**
     * groups.getCallbackServers
     * 
     * @param int $groupId
     * @param array|null $serverIds
     * @param array|null $custom
     * @return Promise
     */
    function getCallbackServers(int $groupId, ?array $serverIds = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($serverIds !== [] && $serverIds != null) $sendParams['server_ids'] = implode(',', $serverIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getCallbackServers', $sendParams);
    }

    /**
     * Returns [vk.com/dev/callback_api|Callback API] notifications settings.
     * 
     * @param int $groupId Community ID.
     * @param int|null $serverId Server ID.
     * @param array|null $custom
     * @return Promise
     */
    function getCallbackSettings(int $groupId, ?int $serverId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($serverId !== 0 && $serverId != null) $sendParams['server_id'] = $serverId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getCallbackSettings', $sendParams);
    }

    /**
     * Returns communities list for a catalog category.
     * 
     * @param int|null $categoryId Category id received from [vk.com/dev/groups.getCatalogInfo|groups.getCatalogInfo].
     * @param int|null $subcategoryId Subcategory id received from [vk.com/dev/groups.getCatalogInfo|groups.getCatalogInfo].
     * @param array|null $custom
     * @return Promise
     */
    function getCatalog(?int $categoryId = 0, ?int $subcategoryId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($categoryId !== 0 && $categoryId != null) $sendParams['category_id'] = $categoryId;
        if ($subcategoryId !== 0 && $subcategoryId != null) $sendParams['subcategory_id'] = $subcategoryId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getCatalog', $sendParams);
    }

    /**
     * Returns categories list for communities catalog
     * 
     * @param bool|null $extended 1 – to return communities count and three communities for preview. By default: 0.
     * @param bool|null $subcategories 1 – to return subcategories info. By default: 0.
     * @param array|null $custom
     * @return Promise
     */
    function getCatalogInfo(?bool $extended = false, ?bool $subcategories = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($subcategories !== false && $subcategories != null) $sendParams['subcategories'] = intval($subcategories);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getCatalogInfo', $sendParams);
    }

    /**
     * Returns invited users list of a community
     * 
     * @param int $groupId Group ID to return invited users for.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of results to return.
     * @param array|null $fields List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
     * @param string|null $nameCase Case for declension of user name and surname. Possible values: *'nom' — nominative (default),, *'gen' — genitive,, *'dat' — dative,, *'acc' — accusative, , *'ins' — instrumental,, *'abl' — prepositional.
     * @param array|null $custom
     * @return Promise
     */
    function getInvitedUsers(int $groupId, ?int $offset = 0, ?int $count = 20, ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getInvitedUsers', $sendParams);
    }

    /**
     * Returns a list of invitations to join communities and events.
     * 
     * @param int|null $offset Offset needed to return a specific subset of invitations.
     * @param int|null $count Number of invitations to return.
     * @param bool|null $extended '1' — to return additional [vk.com/dev/fields_groups|fields] for communities..
     * @param array|null $custom
     * @return Promise
     */
    function getInvites(?int $offset = 0, ?int $count = 20, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getInvites', $sendParams);
    }

    /**
     * Returns the data needed to query a Long Poll server for events
     * 
     * @param int $groupId Community ID
     * @param array|null $custom
     * @return Promise
     */
    function getLongPollServer(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getLongPollServer', $sendParams);
    }

    /**
     * Returns Long Poll notification settings
     * 
     * @param int $groupId Community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getLongPollSettings(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getLongPollSettings', $sendParams);
    }

    /**
     * Returns a list of community members.
     * 
     * @param string|null $groupId ID or screen name of the community.
     * @param string|null $sort Sort order. Available values: 'id_asc', 'id_desc', 'time_asc', 'time_desc'. 'time_asc' and 'time_desc' are availavle only if the method is called by the group's 'moderator'.
     * @param int|null $offset Offset needed to return a specific subset of community members.
     * @param int|null $count Number of community members to return.
     * @param array|null $fields List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
     * @param string|null $filter *'friends' – only friends in this community will be returned,, *'unsure' – only those who pressed 'I may attend' will be returned (if it's an event).
     * @param array|null $custom
     * @return Promise
     */
    function getMembers(?string $groupId = '', ?string $sort = 'id_asc', ?int $offset = 0, ?int $count = 1000, ?array $fields = [], ?string $filter = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== '' && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($sort !== 'id_asc' && $sort != null) $sendParams['sort'] = $sort;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 1000 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($filter !== '' && $filter != null) $sendParams['filter'] = $filter;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getMembers', $sendParams);
    }

    /**
     * Returns a list of requests to the community.
     * 
     * @param int $groupId Community ID.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of results to return.
     * @param array|null $fields Profile fields to return.
     * @param array|null $custom
     * @return Promise
     */
    function getRequests(int $groupId, ?int $offset = 0, ?int $count = 20, ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getRequests', $sendParams);
    }

    /**
     * Returns community settings.
     * 
     * @param int $groupId Community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getSettings(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getSettings', $sendParams);
    }

    /**
     * groups.getTokenPermissions
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getTokenPermissions(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.getTokenPermissions', $sendParams);
    }

    /**
     * Allows to invite friends to the community.
     * 
     * @param int $groupId Community ID.
     * @param int $userId User ID.
     * @param array|null $custom
     * @return Promise
     */
    function invite(int $groupId, int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.invite', $sendParams);
    }

    /**
     * Returns information specifying whether a user is a member of a community.
     * 
     * @param string $groupId ID or screen name of the community.
     * @param int|null $userId User ID.
     * @param array|null $userIds User IDs.
     * @param bool|null $extended '1' — to return an extended response with additional fields. By default: '0'.
     * @param array|null $custom
     * @return Promise
     */
    function isMember(string $groupId, ?int $userId = 0, ?array $userIds = [], ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.isMember', $sendParams);
    }

    /**
     * With this method you can join the group or public page, and also confirm your participation in an event.
     * 
     * @param int|null $groupId ID or screen name of the community.
     * @param string|null $notSure Optional parameter which is taken into account when 'gid' belongs to the event: '1' — Perhaps I will attend, '0' — I will be there for sure (default), ,
     * @param array|null $custom
     * @return Promise
     */
    function join(?int $groupId = 0, ?string $notSure = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($notSure !== '' && $notSure != null) $sendParams['not_sure'] = $notSure;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.join', $sendParams);
    }

    /**
     * With this method you can leave a group, public page, or event.
     * 
     * @param int $groupId ID or screen name of the community.
     * @param array|null $custom
     * @return Promise
     */
    function leave(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.leave', $sendParams);
    }

    /**
     * Removes a user from the community.
     * 
     * @param int $groupId Community ID.
     * @param int $userId User ID.
     * @param array|null $custom
     * @return Promise
     */
    function removeUser(int $groupId, int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.removeUser', $sendParams);
    }

    /**
     * Allows to reorder links in the community.
     * 
     * @param int $groupId Community ID.
     * @param int $linkId Link ID.
     * @param int|null $after ID of the link after which to place the link with 'link_id'.
     * @param array|null $custom
     * @return Promise
     */
    function reorderLink(int $groupId, int $linkId, ?int $after = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['link_id'] = $linkId;
        if ($after !== 0 && $after != null) $sendParams['after'] = $after;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.reorderLink', $sendParams);
    }

    /**
     * Returns a list of communities matching the search criteria.
     * 
     * @param string $q Search query string.
     * @param string|null $type Community type. Possible values: 'group, page, event.'
     * @param int|null $countryId Country ID.
     * @param int|null $cityId City ID. If this parameter is transmitted, country_id is ignored.
     * @param bool|null $future '1' — to return only upcoming events. Works with the 'type' = 'event' only.
     * @param bool|null $market '1' — to return communities with enabled market only.
     * @param int|null $sort Sort order. Possible values: *'0' — default sorting (similar the full version of the site),, *'1' — by growth speed,, *'2'— by the "day attendance/members number" ratio,, *'3' — by the "Likes number/members number" ratio,, *'4' — by the "comments number/members number" ratio,, *'5' — by the "boards entries number/members number" ratio.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of communities to return. "Note that you can not receive more than first thousand of results, regardless of 'count' and 'offset' values."
     * @param array|null $custom
     * @return Promise
     */
    function search(string $q, ?string $type = '', ?int $countryId = 0, ?int $cityId = 0, ?bool $future = false, ?bool $market = false, ?int $sort = 0, ?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams[''] = $q;
        if ($type !== '' && $type != null) $sendParams['type'] = $type;
        if ($countryId !== 0 && $countryId != null) $sendParams['country_id'] = $countryId;
        if ($cityId !== 0 && $cityId != null) $sendParams['city_id'] = $cityId;
        if ($future !== false && $future != null) $sendParams['future'] = intval($future);
        if ($market !== false && $market != null) $sendParams['market'] = intval($market);
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.search', $sendParams);
    }

    /**
     * Allow to set notifications settings for group.
     * 
     * @param int $groupId Community ID.
     * @param int|null $serverId Server ID.
     * @param string|null $apiVersion
     * @param bool|null $messageNew A new incoming message has been received ('0' — disabled, '1' — enabled).
     * @param bool|null $messageReply A new outcoming message has been received ('0' — disabled, '1' — enabled).
     * @param bool|null $messageAllow Allowed messages notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $messageEdit
     * @param bool|null $messageDeny Denied messages notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $messageTypingState
     * @param bool|null $photoNew New photos notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $audioNew New audios notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $videoNew New videos notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyNew New wall replies notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyEdit Wall replies edited notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyDelete A wall comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyRestore A wall comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $wallPostNew New wall posts notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallRepost New wall posts notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostNew New board posts notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostEdit Board posts edited notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostRestore Board posts restored notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostDelete Board posts deleted notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentNew New comment to photo notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentEdit A photo comment has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentDelete A photo comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentRestore A photo comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentNew New comment to video notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentEdit A video comment has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentDelete A video comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentRestore A video comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentNew New comment to market item notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentEdit A market comment has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentDelete A market comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentRestore A market comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $pollVoteNew A vote in a public poll has been added ('0' — disabled, '1' — enabled).
     * @param bool|null $groupJoin Joined community notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $groupLeave Left community notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $groupChangeSettings
     * @param bool|null $groupChangePhoto
     * @param bool|null $groupOfficersEdit
     * @param bool|null $userBlock User added to community blacklist
     * @param bool|null $userUnblock User removed from community blacklist
     * @param bool|null $leadFormsNew New form in lead forms
     * @param bool|null $likeAdd
     * @param bool|null $likeRemove
     * @param bool|null $messageEvent
     * @param array|null $custom
     * @return Promise
     */
    function setCallbackSettings(int $groupId, ?int $serverId = 0, ?string $apiVersion = '', ?bool $messageNew = false, ?bool $messageReply = false, ?bool $messageAllow = false, ?bool $messageEdit = false, ?bool $messageDeny = false, ?bool $messageTypingState = false, ?bool $photoNew = false, ?bool $audioNew = false, ?bool $videoNew = false, ?bool $wallReplyNew = false, ?bool $wallReplyEdit = false, ?bool $wallReplyDelete = false, ?bool $wallReplyRestore = false, ?bool $wallPostNew = false, ?bool $wallRepost = false, ?bool $boardPostNew = false, ?bool $boardPostEdit = false, ?bool $boardPostRestore = false, ?bool $boardPostDelete = false, ?bool $photoCommentNew = false, ?bool $photoCommentEdit = false, ?bool $photoCommentDelete = false, ?bool $photoCommentRestore = false, ?bool $videoCommentNew = false, ?bool $videoCommentEdit = false, ?bool $videoCommentDelete = false, ?bool $videoCommentRestore = false, ?bool $marketCommentNew = false, ?bool $marketCommentEdit = false, ?bool $marketCommentDelete = false, ?bool $marketCommentRestore = false, ?bool $pollVoteNew = false, ?bool $groupJoin = false, ?bool $groupLeave = false, ?bool $groupChangeSettings = false, ?bool $groupChangePhoto = false, ?bool $groupOfficersEdit = false, ?bool $userBlock = false, ?bool $userUnblock = false, ?bool $leadFormsNew = false, ?bool $likeAdd = false, ?bool $likeRemove = false, ?bool $messageEvent = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($serverId !== 0 && $serverId != null) $sendParams['server_id'] = $serverId;
        if ($apiVersion !== '' && $apiVersion != null) $sendParams['api_version'] = $apiVersion;
        if ($messageNew !== false && $messageNew != null) $sendParams['message_new'] = intval($messageNew);
        if ($messageReply !== false && $messageReply != null) $sendParams['message_reply'] = intval($messageReply);
        if ($messageAllow !== false && $messageAllow != null) $sendParams['message_allow'] = intval($messageAllow);
        if ($messageEdit !== false && $messageEdit != null) $sendParams['message_edit'] = intval($messageEdit);
        if ($messageDeny !== false && $messageDeny != null) $sendParams['message_deny'] = intval($messageDeny);
        if ($messageTypingState !== false && $messageTypingState != null) $sendParams['message_typing_state'] = intval($messageTypingState);
        if ($photoNew !== false && $photoNew != null) $sendParams['photo_new'] = intval($photoNew);
        if ($audioNew !== false && $audioNew != null) $sendParams['audio_new'] = intval($audioNew);
        if ($videoNew !== false && $videoNew != null) $sendParams['video_new'] = intval($videoNew);
        if ($wallReplyNew !== false && $wallReplyNew != null) $sendParams['wall_reply_new'] = intval($wallReplyNew);
        if ($wallReplyEdit !== false && $wallReplyEdit != null) $sendParams['wall_reply_edit'] = intval($wallReplyEdit);
        if ($wallReplyDelete !== false && $wallReplyDelete != null) $sendParams['wall_reply_delete'] = intval($wallReplyDelete);
        if ($wallReplyRestore !== false && $wallReplyRestore != null) $sendParams['wall_reply_restore'] = intval($wallReplyRestore);
        if ($wallPostNew !== false && $wallPostNew != null) $sendParams['wall_post_new'] = intval($wallPostNew);
        if ($wallRepost !== false && $wallRepost != null) $sendParams['wall_repost'] = intval($wallRepost);
        if ($boardPostNew !== false && $boardPostNew != null) $sendParams['board_post_new'] = intval($boardPostNew);
        if ($boardPostEdit !== false && $boardPostEdit != null) $sendParams['board_post_edit'] = intval($boardPostEdit);
        if ($boardPostRestore !== false && $boardPostRestore != null) $sendParams['board_post_restore'] = intval($boardPostRestore);
        if ($boardPostDelete !== false && $boardPostDelete != null) $sendParams['board_post_delete'] = intval($boardPostDelete);
        if ($photoCommentNew !== false && $photoCommentNew != null) $sendParams['photo_comment_new'] = intval($photoCommentNew);
        if ($photoCommentEdit !== false && $photoCommentEdit != null) $sendParams['photo_comment_edit'] = intval($photoCommentEdit);
        if ($photoCommentDelete !== false && $photoCommentDelete != null) $sendParams['photo_comment_delete'] = intval($photoCommentDelete);
        if ($photoCommentRestore !== false && $photoCommentRestore != null) $sendParams['photo_comment_restore'] = intval($photoCommentRestore);
        if ($videoCommentNew !== false && $videoCommentNew != null) $sendParams['video_comment_new'] = intval($videoCommentNew);
        if ($videoCommentEdit !== false && $videoCommentEdit != null) $sendParams['video_comment_edit'] = intval($videoCommentEdit);
        if ($videoCommentDelete !== false && $videoCommentDelete != null) $sendParams['video_comment_delete'] = intval($videoCommentDelete);
        if ($videoCommentRestore !== false && $videoCommentRestore != null) $sendParams['video_comment_restore'] = intval($videoCommentRestore);
        if ($marketCommentNew !== false && $marketCommentNew != null) $sendParams['market_comment_new'] = intval($marketCommentNew);
        if ($marketCommentEdit !== false && $marketCommentEdit != null) $sendParams['market_comment_edit'] = intval($marketCommentEdit);
        if ($marketCommentDelete !== false && $marketCommentDelete != null) $sendParams['market_comment_delete'] = intval($marketCommentDelete);
        if ($marketCommentRestore !== false && $marketCommentRestore != null) $sendParams['market_comment_restore'] = intval($marketCommentRestore);
        if ($pollVoteNew !== false && $pollVoteNew != null) $sendParams['poll_vote_new'] = intval($pollVoteNew);
        if ($groupJoin !== false && $groupJoin != null) $sendParams['group_join'] = intval($groupJoin);
        if ($groupLeave !== false && $groupLeave != null) $sendParams['group_leave'] = intval($groupLeave);
        if ($groupChangeSettings !== false && $groupChangeSettings != null) $sendParams['group_change_settings'] = intval($groupChangeSettings);
        if ($groupChangePhoto !== false && $groupChangePhoto != null) $sendParams['group_change_photo'] = intval($groupChangePhoto);
        if ($groupOfficersEdit !== false && $groupOfficersEdit != null) $sendParams['group_officers_edit'] = intval($groupOfficersEdit);
        if ($userBlock !== false && $userBlock != null) $sendParams['user_block'] = intval($userBlock);
        if ($userUnblock !== false && $userUnblock != null) $sendParams['user_unblock'] = intval($userUnblock);
        if ($leadFormsNew !== false && $leadFormsNew != null) $sendParams['lead_forms_new'] = intval($leadFormsNew);
        if ($likeAdd !== false && $likeAdd != null) $sendParams['like_add'] = intval($likeAdd);
        if ($likeRemove !== false && $likeRemove != null) $sendParams['like_remove'] = intval($likeRemove);
        if ($messageEvent !== false && $messageEvent != null) $sendParams['message_event'] = intval($messageEvent);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.setCallbackSettings', $sendParams);
    }

    /**
     * Sets Long Poll notification settings
     * 
     * @param int $groupId Community ID.
     * @param bool|null $enabled Sets whether Long Poll is enabled ('0' — disabled, '1' — enabled).
     * @param string|null $apiVersion
     * @param bool|null $messageNew A new incoming message has been received ('0' — disabled, '1' — enabled).
     * @param bool|null $messageReply A new outcoming message has been received ('0' — disabled, '1' — enabled).
     * @param bool|null $messageAllow Allowed messages notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $messageDeny Denied messages notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $messageEdit A message has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $messageTypingState
     * @param bool|null $photoNew New photos notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $audioNew New audios notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $videoNew New videos notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyNew New wall replies notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyEdit Wall replies edited notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyDelete A wall comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $wallReplyRestore A wall comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $wallPostNew New wall posts notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $wallRepost New wall posts notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostNew New board posts notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostEdit Board posts edited notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostRestore Board posts restored notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $boardPostDelete Board posts deleted notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentNew New comment to photo notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentEdit A photo comment has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentDelete A photo comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $photoCommentRestore A photo comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentNew New comment to video notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentEdit A video comment has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentDelete A video comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $videoCommentRestore A video comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentNew New comment to market item notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentEdit A market comment has been edited ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentDelete A market comment has been deleted ('0' — disabled, '1' — enabled).
     * @param bool|null $marketCommentRestore A market comment has been restored ('0' — disabled, '1' — enabled).
     * @param bool|null $pollVoteNew A vote in a public poll has been added ('0' — disabled, '1' — enabled).
     * @param bool|null $groupJoin Joined community notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $groupLeave Left community notifications ('0' — disabled, '1' — enabled).
     * @param bool|null $groupChangeSettings
     * @param bool|null $groupChangePhoto
     * @param bool|null $groupOfficersEdit
     * @param bool|null $userBlock User added to community blacklist
     * @param bool|null $userUnblock User removed from community blacklist
     * @param bool|null $likeAdd
     * @param bool|null $likeRemove
     * @param bool|null $messageEvent
     * @param array|null $custom
     * @return Promise
     */
    function setLongPollSettings(int $groupId, ?bool $enabled = false, ?string $apiVersion = '', ?bool $messageNew = false, ?bool $messageReply = false, ?bool $messageAllow = false, ?bool $messageDeny = false, ?bool $messageEdit = false, ?bool $messageTypingState = false, ?bool $photoNew = false, ?bool $audioNew = false, ?bool $videoNew = false, ?bool $wallReplyNew = false, ?bool $wallReplyEdit = false, ?bool $wallReplyDelete = false, ?bool $wallReplyRestore = false, ?bool $wallPostNew = false, ?bool $wallRepost = false, ?bool $boardPostNew = false, ?bool $boardPostEdit = false, ?bool $boardPostRestore = false, ?bool $boardPostDelete = false, ?bool $photoCommentNew = false, ?bool $photoCommentEdit = false, ?bool $photoCommentDelete = false, ?bool $photoCommentRestore = false, ?bool $videoCommentNew = false, ?bool $videoCommentEdit = false, ?bool $videoCommentDelete = false, ?bool $videoCommentRestore = false, ?bool $marketCommentNew = false, ?bool $marketCommentEdit = false, ?bool $marketCommentDelete = false, ?bool $marketCommentRestore = false, ?bool $pollVoteNew = false, ?bool $groupJoin = false, ?bool $groupLeave = false, ?bool $groupChangeSettings = false, ?bool $groupChangePhoto = false, ?bool $groupOfficersEdit = false, ?bool $userBlock = false, ?bool $userUnblock = false, ?bool $likeAdd = false, ?bool $likeRemove = false, ?bool $messageEvent = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($enabled !== false && $enabled != null) $sendParams['enabled'] = intval($enabled);
        if ($apiVersion !== '' && $apiVersion != null) $sendParams['api_version'] = $apiVersion;
        if ($messageNew !== false && $messageNew != null) $sendParams['message_new'] = intval($messageNew);
        if ($messageReply !== false && $messageReply != null) $sendParams['message_reply'] = intval($messageReply);
        if ($messageAllow !== false && $messageAllow != null) $sendParams['message_allow'] = intval($messageAllow);
        if ($messageDeny !== false && $messageDeny != null) $sendParams['message_deny'] = intval($messageDeny);
        if ($messageEdit !== false && $messageEdit != null) $sendParams['message_edit'] = intval($messageEdit);
        if ($messageTypingState !== false && $messageTypingState != null) $sendParams['message_typing_state'] = intval($messageTypingState);
        if ($photoNew !== false && $photoNew != null) $sendParams['photo_new'] = intval($photoNew);
        if ($audioNew !== false && $audioNew != null) $sendParams['audio_new'] = intval($audioNew);
        if ($videoNew !== false && $videoNew != null) $sendParams['video_new'] = intval($videoNew);
        if ($wallReplyNew !== false && $wallReplyNew != null) $sendParams['wall_reply_new'] = intval($wallReplyNew);
        if ($wallReplyEdit !== false && $wallReplyEdit != null) $sendParams['wall_reply_edit'] = intval($wallReplyEdit);
        if ($wallReplyDelete !== false && $wallReplyDelete != null) $sendParams['wall_reply_delete'] = intval($wallReplyDelete);
        if ($wallReplyRestore !== false && $wallReplyRestore != null) $sendParams['wall_reply_restore'] = intval($wallReplyRestore);
        if ($wallPostNew !== false && $wallPostNew != null) $sendParams['wall_post_new'] = intval($wallPostNew);
        if ($wallRepost !== false && $wallRepost != null) $sendParams['wall_repost'] = intval($wallRepost);
        if ($boardPostNew !== false && $boardPostNew != null) $sendParams['board_post_new'] = intval($boardPostNew);
        if ($boardPostEdit !== false && $boardPostEdit != null) $sendParams['board_post_edit'] = intval($boardPostEdit);
        if ($boardPostRestore !== false && $boardPostRestore != null) $sendParams['board_post_restore'] = intval($boardPostRestore);
        if ($boardPostDelete !== false && $boardPostDelete != null) $sendParams['board_post_delete'] = intval($boardPostDelete);
        if ($photoCommentNew !== false && $photoCommentNew != null) $sendParams['photo_comment_new'] = intval($photoCommentNew);
        if ($photoCommentEdit !== false && $photoCommentEdit != null) $sendParams['photo_comment_edit'] = intval($photoCommentEdit);
        if ($photoCommentDelete !== false && $photoCommentDelete != null) $sendParams['photo_comment_delete'] = intval($photoCommentDelete);
        if ($photoCommentRestore !== false && $photoCommentRestore != null) $sendParams['photo_comment_restore'] = intval($photoCommentRestore);
        if ($videoCommentNew !== false && $videoCommentNew != null) $sendParams['video_comment_new'] = intval($videoCommentNew);
        if ($videoCommentEdit !== false && $videoCommentEdit != null) $sendParams['video_comment_edit'] = intval($videoCommentEdit);
        if ($videoCommentDelete !== false && $videoCommentDelete != null) $sendParams['video_comment_delete'] = intval($videoCommentDelete);
        if ($videoCommentRestore !== false && $videoCommentRestore != null) $sendParams['video_comment_restore'] = intval($videoCommentRestore);
        if ($marketCommentNew !== false && $marketCommentNew != null) $sendParams['market_comment_new'] = intval($marketCommentNew);
        if ($marketCommentEdit !== false && $marketCommentEdit != null) $sendParams['market_comment_edit'] = intval($marketCommentEdit);
        if ($marketCommentDelete !== false && $marketCommentDelete != null) $sendParams['market_comment_delete'] = intval($marketCommentDelete);
        if ($marketCommentRestore !== false && $marketCommentRestore != null) $sendParams['market_comment_restore'] = intval($marketCommentRestore);
        if ($pollVoteNew !== false && $pollVoteNew != null) $sendParams['poll_vote_new'] = intval($pollVoteNew);
        if ($groupJoin !== false && $groupJoin != null) $sendParams['group_join'] = intval($groupJoin);
        if ($groupLeave !== false && $groupLeave != null) $sendParams['group_leave'] = intval($groupLeave);
        if ($groupChangeSettings !== false && $groupChangeSettings != null) $sendParams['group_change_settings'] = intval($groupChangeSettings);
        if ($groupChangePhoto !== false && $groupChangePhoto != null) $sendParams['group_change_photo'] = intval($groupChangePhoto);
        if ($groupOfficersEdit !== false && $groupOfficersEdit != null) $sendParams['group_officers_edit'] = intval($groupOfficersEdit);
        if ($userBlock !== false && $userBlock != null) $sendParams['user_block'] = intval($userBlock);
        if ($userUnblock !== false && $userUnblock != null) $sendParams['user_unblock'] = intval($userUnblock);
        if ($likeAdd !== false && $likeAdd != null) $sendParams['like_add'] = intval($likeAdd);
        if ($likeRemove !== false && $likeRemove != null) $sendParams['like_remove'] = intval($likeRemove);
        if ($messageEvent !== false && $messageEvent != null) $sendParams['message_event'] = intval($messageEvent);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.setLongPollSettings', $sendParams);
    }

    /**
     * groups.unban
     * 
     * @param int $groupId
     * @param int|null $ownerId
     * @param array|null $custom
     * @return Promise
     */
    function unban(int $groupId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('groups.unban', $sendParams);
    }
}