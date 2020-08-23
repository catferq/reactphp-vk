<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Ads
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Adds managers and/or supervisors to advertising account.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe added managers. Description of 'user_specification' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function addOfficeUsers(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.addOfficeUsers', $sendParams);
    }

    /**
     * Allows to check the ad link.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $linkType Object type: *'community' — community,, *'post' — community post,, *'application' — VK application,, *'video' — video,, *'site' — external site.
     * @param string $linkUrl Object URL.
     * @param int|null $campaignId Campaign ID
     * @param array|null $custom
     * @return Promise
     */
    function checkLink(int $accountId, string $linkType, string $linkUrl, ?int $campaignId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['link_type'] = $linkType;
        $sendParams['link_url'] = $linkUrl;
        if ($campaignId !== 0 && $campaignId != null) $sendParams['campaign_id'] = $campaignId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.checkLink', $sendParams);
    }

    /**
     * Creates ads.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe created ads. Description of 'ad_specification' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function createAds(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.createAds', $sendParams);
    }

    /**
     * Creates advertising campaigns.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe created campaigns. Description of 'campaign_specification' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function createCampaigns(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.createCampaigns', $sendParams);
    }

    /**
     * Creates clients of an advertising agency.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe created campaigns. Description of 'client_specification' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function createClients(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.createClients', $sendParams);
    }

    /**
     * Creates a group to re-target ads for users who visited advertiser's site (viewed information about the product, registered, etc.).
     * 
     * @param int $accountId Advertising account ID.
     * @param string $name Name of the target group — a string up to 64 characters long.
     * @param int $lifetime 'For groups with auditory created with pixel code only.', , Number of days after that users will be automatically removed from the group.
     * @param int|null $clientId 'Only for advertising agencies.', ID of the client with the advertising account where the group will be created.
     * @param int|null $targetPixelId
     * @param string|null $targetPixelRules
     * @param array|null $custom
     * @return Promise
     */
    function createTargetGroup(int $accountId, string $name, int $lifetime, ?int $clientId = 0, ?int $targetPixelId = 0, ?string $targetPixelRules = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['name'] = $name;
        $sendParams['lifetime'] = $lifetime;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($targetPixelId !== 0 && $targetPixelId != null) $sendParams['target_pixel_id'] = $targetPixelId;
        if ($targetPixelRules !== '' && $targetPixelRules != null) $sendParams['target_pixel_rules'] = $targetPixelRules;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.createTargetGroup', $sendParams);
    }

    /**
     * Archives ads.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $ids Serialized JSON array with ad IDs.
     * @param array|null $custom
     * @return Promise
     */
    function deleteAds(int $accountId, string $ids, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids'] = $ids;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.deleteAds', $sendParams);
    }

    /**
     * Archives advertising campaigns.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $ids Serialized JSON array with IDs of deleted campaigns.
     * @param array|null $custom
     * @return Promise
     */
    function deleteCampaigns(int $accountId, string $ids, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids'] = $ids;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.deleteCampaigns', $sendParams);
    }

    /**
     * Archives clients of an advertising agency.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $ids Serialized JSON array with IDs of deleted clients.
     * @param array|null $custom
     * @return Promise
     */
    function deleteClients(int $accountId, string $ids, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids'] = $ids;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.deleteClients', $sendParams);
    }

    /**
     * Deletes a retarget group.
     * 
     * @param int $accountId Advertising account ID.
     * @param int $targetGroupId Group ID.
     * @param int|null $clientId 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
     * @param array|null $custom
     * @return Promise
     */
    function deleteTargetGroup(int $accountId, int $targetGroupId, ?int $clientId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['target_group_id'] = $targetGroupId;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.deleteTargetGroup', $sendParams);
    }

    /**
     * Returns a list of advertising accounts.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getAccounts(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getAccounts', $sendParams);
    }

    /**
     * Returns number of ads.
     * 
     * @param int $accountId Advertising account ID.
     * @param string|null $adIds Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
     * @param string|null $campaignIds Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
     * @param int|null $clientId 'Available and required for advertising agencies.' ID of the client ads are retrieved from.
     * @param bool|null $includeDeleted Flag that specifies whether archived ads shall be shown: *0 — show only active ads,, *1 — show all ads.
     * @param bool|null $onlyDeleted Flag that specifies whether to show only archived ads: *0 — show all ads,, *1 — show only archived ads. Available when include_deleted flag is *1
     * @param int|null $limit Limit of number of returned ads. Used only if ad_ids parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
     * @param int|null $offset Offset. Used in the same cases as 'limit' parameter.
     * @param array|null $custom
     * @return Promise
     */
    function getAds(int $accountId, ?string $adIds = '', ?string $campaignIds = '', ?int $clientId = 0, ?bool $includeDeleted = false, ?bool $onlyDeleted = false, ?int $limit = 0, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        if ($adIds !== '' && $adIds != null) $sendParams['ad_ids'] = $adIds;
        if ($campaignIds !== '' && $campaignIds != null) $sendParams['campaign_ids'] = $campaignIds;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($includeDeleted !== false && $includeDeleted != null) $sendParams['include_deleted'] = intval($includeDeleted);
        if ($onlyDeleted !== false && $onlyDeleted != null) $sendParams['only_deleted'] = intval($onlyDeleted);
        if ($limit !== 0 && $limit != null) $sendParams['limit'] = $limit;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getAds', $sendParams);
    }

    /**
     * Returns descriptions of ad layouts.
     * 
     * @param int $accountId Advertising account ID.
     * @param string|null $adIds Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
     * @param string|null $campaignIds Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
     * @param int|null $clientId 'For advertising agencies.' ID of the client ads are retrieved from.
     * @param bool|null $includeDeleted Flag that specifies whether archived ads shall be shown. *0 — show only active ads,, *1 — show all ads.
     * @param int|null $limit Limit of number of returned ads. Used only if 'ad_ids' parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
     * @param int|null $offset Offset. Used in the same cases as 'limit' parameter.
     * @param array|null $custom
     * @return Promise
     */
    function getAdsLayout(int $accountId, ?string $adIds = '', ?string $campaignIds = '', ?int $clientId = 0, ?bool $includeDeleted = false, ?int $limit = 0, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        if ($adIds !== '' && $adIds != null) $sendParams['ad_ids'] = $adIds;
        if ($campaignIds !== '' && $campaignIds != null) $sendParams['campaign_ids'] = $campaignIds;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($includeDeleted !== false && $includeDeleted != null) $sendParams['include_deleted'] = intval($includeDeleted);
        if ($limit !== 0 && $limit != null) $sendParams['limit'] = $limit;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getAdsLayout', $sendParams);
    }

    /**
     * Returns ad targeting parameters.
     * 
     * @param int $accountId Advertising account ID.
     * @param string|null $adIds Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
     * @param string|null $campaignIds Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
     * @param int|null $clientId 'For advertising agencies.' ID of the client ads are retrieved from.
     * @param bool|null $includeDeleted flag that specifies whether archived ads shall be shown: *0 — show only active ads,, *1 — show all ads.
     * @param int|null $limit Limit of number of returned ads. Used only if 'ad_ids' parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param array|null $custom
     * @return Promise
     */
    function getAdsTargeting(int $accountId, ?string $adIds = '', ?string $campaignIds = '', ?int $clientId = 0, ?bool $includeDeleted = false, ?int $limit = 0, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        if ($adIds !== '' && $adIds != null) $sendParams['ad_ids'] = $adIds;
        if ($campaignIds !== '' && $campaignIds != null) $sendParams['campaign_ids'] = $campaignIds;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($includeDeleted !== false && $includeDeleted != null) $sendParams['include_deleted'] = intval($includeDeleted);
        if ($limit !== 0 && $limit != null) $sendParams['limit'] = $limit;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getAdsTargeting', $sendParams);
    }

    /**
     * Returns current budget of the advertising account.
     * 
     * @param int $accountId Advertising account ID.
     * @param array|null $custom
     * @return Promise
     */
    function getBudget(int $accountId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getBudget', $sendParams);
    }

    /**
     * Returns a list of campaigns in an advertising account.
     * 
     * @param int $accountId Advertising account ID.
     * @param int|null $clientId 'For advertising agencies'. ID of the client advertising campaigns are retrieved from.
     * @param bool|null $includeDeleted Flag that specifies whether archived ads shall be shown. *0 — show only active campaigns,, *1 — show all campaigns.
     * @param string|null $campaignIds Filter of advertising campaigns to show. Serialized JSON array with campaign IDs. Only campaigns that exist in 'campaign_ids' and belong to the specified advertising account will be shown. If the parameter is null, all campaigns will be shown.
     * @param array|null $fields
     * @param array|null $custom
     * @return Promise
     */
    function getCampaigns(int $accountId, ?int $clientId = 0, ?bool $includeDeleted = false, ?string $campaignIds = '', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($includeDeleted !== false && $includeDeleted != null) $sendParams['include_deleted'] = intval($includeDeleted);
        if ($campaignIds !== '' && $campaignIds != null) $sendParams['campaign_ids'] = $campaignIds;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getCampaigns', $sendParams);
    }

    /**
     * Returns a list of possible ad categories.
     * 
     * @param string|null $lang Language. The full list of supported languages is [vk.com/dev/api_requests|here].
     * @param array|null $custom
     * @return Promise
     */
    function getCategories(?string $lang = '', ?array $custom = [])
    {
        $sendParams = [];

        if ($lang !== '' && $lang != null) $sendParams['lang'] = $lang;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getCategories', $sendParams);
    }

    /**
     * Returns a list of advertising agency's clients.
     * 
     * @param int $accountId Advertising account ID.
     * @param array|null $custom
     * @return Promise
     */
    function getClients(int $accountId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getClients', $sendParams);
    }

    /**
     * Returns demographics for ads or campaigns.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $idsType Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns.
     * @param string $ids IDs requested ads or campaigns, separated with a comma, depending on the value set in 'ids_type'. Maximum 2000 objects.
     * @param string $period Data grouping by dates: *day — statistics by days,, *month — statistics by months,, *overall — overall statistics. 'date_from' and 'date_to' parameters set temporary limits.
     * @param string $dateFrom Date to show statistics from. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — day it was created on,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — month it was created in,, *overall: 0.
     * @param string $dateTo Date to show statistics to. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — current day,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — current month,, *overall: 0.
     * @param array|null $custom
     * @return Promise
     */
    function getDemographics(int $accountId, string $idsType, string $ids, string $period, string $dateFrom, string $dateTo, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids_type'] = $idsType;
        $sendParams['ids'] = $ids;
        $sendParams['period'] = $period;
        $sendParams['date_from'] = $dateFrom;
        $sendParams['date_to'] = $dateTo;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getDemographics', $sendParams);
    }

    /**
     * Returns information about current state of a counter — number of remaining runs of methods and time to the next counter nulling in seconds.
     * 
     * @param int $accountId Advertising account ID.
     * @param array|null $custom
     * @return Promise
     */
    function getFloodStats(int $accountId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getFloodStats', $sendParams);
    }

    /**
     * ads.getLookalikeRequests
     * 
     * @param int $accountId
     * @param int|null $clientId
     * @param string|null $requestsIds
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $sortBy
     * @param array|null $custom
     * @return Promise
     */
    function getLookalikeRequests(int $accountId, ?int $clientId = 0, ?string $requestsIds = '', ?int $offset = 0, ?int $limit = 10, ?string $sortBy = 'id', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($requestsIds !== '' && $requestsIds != null) $sendParams['requests_ids'] = $requestsIds;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($limit !== 10 && $limit != null) $sendParams['limit'] = $limit;
        if ($sortBy !== 'id' && $sortBy != null) $sendParams['sort_by'] = $sortBy;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getLookalikeRequests', $sendParams);
    }

    /**
     * ads.getMusicians
     * 
     * @param string $artistName
     * @param array|null $custom
     * @return Promise
     */
    function getMusicians(string $artistName, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['artist_name'] = $artistName;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getMusicians', $sendParams);
    }

    /**
     * Returns a list of managers and supervisors of advertising account.
     * 
     * @param int $accountId Advertising account ID.
     * @param array|null $custom
     * @return Promise
     */
    function getOfficeUsers(int $accountId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getOfficeUsers', $sendParams);
    }

    /**
     * Returns detailed statistics of promoted posts reach from campaigns and ads.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $idsType Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns.
     * @param string $ids IDs requested ads or campaigns, separated with a comma, depending on the value set in 'ids_type'. Maximum 100 objects.
     * @param array|null $custom
     * @return Promise
     */
    function getPostsReach(int $accountId, string $idsType, string $ids, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids_type'] = $idsType;
        $sendParams['ids'] = $ids;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getPostsReach', $sendParams);
    }

    /**
     * Returns a reason of ad rejection for pre-moderation.
     * 
     * @param int $accountId Advertising account ID.
     * @param int $adId Ad ID.
     * @param array|null $custom
     * @return Promise
     */
    function getRejectionReason(int $accountId, int $adId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ad_id'] = $adId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getRejectionReason', $sendParams);
    }

    /**
     * Returns statistics of performance indicators for ads, campaigns, clients or the whole account.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $idsType Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns,, *client — clients,, *office — account.
     * @param string $ids IDs requested ads, campaigns, clients or account, separated with a comma, depending on the value set in 'ids_type'. Maximum 2000 objects.
     * @param string $period Data grouping by dates: *day — statistics by days,, *month — statistics by months,, *overall — overall statistics. 'date_from' and 'date_to' parameters set temporary limits.
     * @param string $dateFrom Date to show statistics from. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — day it was created on,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — month it was created in,, *overall: 0.
     * @param string $dateTo Date to show statistics to. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — current day,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — current month,, *overall: 0.
     * @param array|null $statsFields Additional fields to add to statistics
     * @param array|null $custom
     * @return Promise
     */
    function getStatistics(int $accountId, string $idsType, string $ids, string $period, string $dateFrom, string $dateTo, ?array $statsFields = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids_type'] = $idsType;
        $sendParams['ids'] = $ids;
        $sendParams['period'] = $period;
        $sendParams['date_from'] = $dateFrom;
        $sendParams['date_to'] = $dateTo;
        if ($statsFields !== [] && $statsFields != null) $sendParams['stats_fields'] = implode(',', $statsFields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getStatistics', $sendParams);
    }

    /**
     * Returns a set of auto-suggestions for various targeting parameters.
     * 
     * @param string $section Section, suggestions are retrieved in. Available values: *countries — request of a list of countries. If q is not set or blank, a short list of countries is shown. Otherwise, a full list of countries is shown. *regions — requested list of regions. 'country' parameter is required. *cities — requested list of cities. 'country' parameter is required. *districts — requested list of districts. 'cities' parameter is required. *stations — requested list of subway stations. 'cities' parameter is required. *streets — requested list of streets. 'cities' parameter is required. *schools — requested list of educational organizations. 'cities' parameter is required. *interests — requested list of interests. *positions — requested list of positions (professions). *group_types — requested list of group types. *religions — requested list of religious commitments. *browsers — requested list of browsers and mobile devices.
     * @param string|null $ids Objects IDs separated by commas. If the parameter is passed, 'q, country, cities' should not be passed.
     * @param string|null $q Filter-line of the request (for countries, regions, cities, streets, schools, interests, positions).
     * @param int|null $country ID of the country objects are searched in.
     * @param string|null $cities IDs of cities where objects are searched in, separated with a comma.
     * @param string|null $lang Language of the returned string values. Supported languages: *ru — Russian,, *ua — Ukrainian,, *en — English.
     * @param array|null $custom
     * @return Promise
     */
    function getSuggestions(string $section, ?string $ids = '', ?string $q = '', ?int $country = 0, ?string $cities = '', ?string $lang = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['section'] = $section;
        if ($ids !== '' && $ids != null) $sendParams['ids'] = $ids;
        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($country !== 0 && $country != null) $sendParams['country'] = $country;
        if ($cities !== '' && $cities != null) $sendParams['cities'] = $cities;
        if ($lang !== '' && $lang != null) $sendParams['lang'] = $lang;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getSuggestions', $sendParams);
    }

    /**
     * Returns a list of target groups.
     * 
     * @param int $accountId Advertising account ID.
     * @param int|null $clientId 'Only for advertising agencies.', ID of the client with the advertising account where the group will be created.
     * @param bool|null $extended '1' — to return pixel code.
     * @param array|null $custom
     * @return Promise
     */
    function getTargetGroups(int $accountId, ?int $clientId = 0, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getTargetGroups', $sendParams);
    }

    /**
     * Returns the size of targeting audience, and also recommended values for CPC and CPM.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $linkUrl URL for the advertised object.
     * @param int|null $clientId
     * @param string|null $criteria Serialized JSON object that describes targeting parameters. Description of 'criteria' object see below.
     * @param int|null $adId ID of an ad which targeting parameters shall be analyzed.
     * @param int|null $adFormat Ad format. Possible values: *'1' — image and text,, *'2' — big image,, *'3' — exclusive format,, *'4' — community, square image,, *'7' — special app format,, *'8' — special community format,, *'9' — post in community,, *'10' — app board.
     * @param string|null $adPlatform Platforms to use for ad showing. Possible values: (for 'ad_format' = '1'), *'0' — VK and partner sites,, *'1' — VK only. (for 'ad_format' = '9'), *'all' — all platforms,, *'desktop' — desktop version,, *'mobile' — mobile version and apps.
     * @param string|null $adPlatformNoWall
     * @param string|null $adPlatformNoAdNetwork
     * @param string|null $linkDomain Domain of the advertised object.
     * @param bool|null $needPrecise Additionally return recommended cpc and cpm to reach 5,10..95 percents of audience.
     * @param array|null $custom
     * @return Promise
     */
    function getTargetingStats(int $accountId, string $linkUrl, ?int $clientId = 0, ?string $criteria = '', ?int $adId = 0, ?int $adFormat = 0, ?string $adPlatform = '', ?string $adPlatformNoWall = '', ?string $adPlatformNoAdNetwork = '', ?string $linkDomain = '', ?bool $needPrecise = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['link_url'] = $linkUrl;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($criteria !== '' && $criteria != null) $sendParams['criteria'] = $criteria;
        if ($adId !== 0 && $adId != null) $sendParams['ad_id'] = $adId;
        if ($adFormat !== 0 && $adFormat != null) $sendParams['ad_format'] = $adFormat;
        if ($adPlatform !== '' && $adPlatform != null) $sendParams['ad_platform'] = $adPlatform;
        if ($adPlatformNoWall !== '' && $adPlatformNoWall != null) $sendParams['ad_platform_no_wall'] = $adPlatformNoWall;
        if ($adPlatformNoAdNetwork !== '' && $adPlatformNoAdNetwork != null) $sendParams['ad_platform_no_ad_network'] = $adPlatformNoAdNetwork;
        if ($linkDomain !== '' && $linkDomain != null) $sendParams['link_domain'] = $linkDomain;
        if ($needPrecise !== false && $needPrecise != null) $sendParams['need_precise'] = intval($needPrecise);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getTargetingStats', $sendParams);
    }

    /**
     * Returns URL to upload an ad photo to.
     * 
     * @param int $adFormat Ad format: *1 — image and text,, *2 — big image,, *3 — exclusive format,, *4 — community, square image,, *7 — special app format.
     * @param int|null $icon
     * @param array|null $custom
     * @return Promise
     */
    function getUploadURL(int $adFormat, ?int $icon = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['ad_format'] = $adFormat;
        if ($icon !== 0 && $icon != null) $sendParams['icon'] = $icon;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getUploadURL', $sendParams);
    }

    /**
     * Returns URL to upload an ad video to.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getVideoUploadURL(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.getVideoUploadURL', $sendParams);
    }

    /**
     * Imports a list of advertiser's contacts to count VK registered users against the target group.
     * 
     * @param int $accountId Advertising account ID.
     * @param int $targetGroupId Target group ID.
     * @param string $contacts List of phone numbers, emails or user IDs separated with a comma.
     * @param int|null $clientId 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
     * @param array|null $custom
     * @return Promise
     */
    function importTargetContacts(int $accountId, int $targetGroupId, string $contacts, ?int $clientId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['target_group_id'] = $targetGroupId;
        $sendParams['contacts'] = $contacts;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.importTargetContacts', $sendParams);
    }

    /**
     * Removes managers and/or supervisors from advertising account.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $ids Serialized JSON array with IDs of deleted managers.
     * @param array|null $custom
     * @return Promise
     */
    function removeOfficeUsers(int $accountId, string $ids, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['ids'] = $ids;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.removeOfficeUsers', $sendParams);
    }

    /**
     * Edits ads.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe changes in ads. Description of 'ad_edit_specification' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function updateAds(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.updateAds', $sendParams);
    }

    /**
     * Edits advertising campaigns.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe changes in campaigns. Description of 'campaign_mod' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function updateCampaigns(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.updateCampaigns', $sendParams);
    }

    /**
     * Edits clients of an advertising agency.
     * 
     * @param int $accountId Advertising account ID.
     * @param string $data Serialized JSON array of objects that describe changes in clients. Description of 'client_mod' objects see below.
     * @param array|null $custom
     * @return Promise
     */
    function updateClients(int $accountId, string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.updateClients', $sendParams);
    }

    /**
     * Edits a retarget group.
     * 
     * @param int $accountId Advertising account ID.
     * @param int $targetGroupId Group ID.
     * @param string $name New name of the target group — a string up to 64 characters long.
     * @param int $lifetime 'Only for the groups that get audience from sites with user accounting code.', Time in days when users added to a retarget group will be automatically excluded from it. '0' - automatic exclusion is off.
     * @param int|null $clientId 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
     * @param string|null $domain Domain of the site where user accounting code will be placed.
     * @param int|null $targetPixelId
     * @param string|null $targetPixelRules
     * @param array|null $custom
     * @return Promise
     */
    function updateTargetGroup(int $accountId, int $targetGroupId, string $name, int $lifetime, ?int $clientId = 0, ?string $domain = '', ?int $targetPixelId = 0, ?string $targetPixelRules = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['account_id'] = $accountId;
        $sendParams['target_group_id'] = $targetGroupId;
        $sendParams['name'] = $name;
        $sendParams['lifetime'] = $lifetime;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($domain !== '' && $domain != null) $sendParams['domain'] = $domain;
        if ($targetPixelId !== 0 && $targetPixelId != null) $sendParams['target_pixel_id'] = $targetPixelId;
        if ($targetPixelRules !== '' && $targetPixelRules != null) $sendParams['target_pixel_rules'] = $targetPixelRules;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('ads.updateTargetGroup', $sendParams);
    }
}