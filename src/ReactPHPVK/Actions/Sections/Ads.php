<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Ads\AddOfficeUsers;
use ReactPHPVK\Actions\Sections\Ads\CheckLink;
use ReactPHPVK\Actions\Sections\Ads\CreateAds;
use ReactPHPVK\Actions\Sections\Ads\CreateCampaigns;
use ReactPHPVK\Actions\Sections\Ads\CreateClients;
use ReactPHPVK\Actions\Sections\Ads\CreateTargetGroup;
use ReactPHPVK\Actions\Sections\Ads\DeleteAds;
use ReactPHPVK\Actions\Sections\Ads\DeleteCampaigns;
use ReactPHPVK\Actions\Sections\Ads\DeleteClients;
use ReactPHPVK\Actions\Sections\Ads\DeleteTargetGroup;
use ReactPHPVK\Actions\Sections\Ads\GetAccounts;
use ReactPHPVK\Actions\Sections\Ads\GetAds;
use ReactPHPVK\Actions\Sections\Ads\GetAdsLayout;
use ReactPHPVK\Actions\Sections\Ads\GetAdsTargeting;
use ReactPHPVK\Actions\Sections\Ads\GetBudget;
use ReactPHPVK\Actions\Sections\Ads\GetCampaigns;
use ReactPHPVK\Actions\Sections\Ads\GetCategories;
use ReactPHPVK\Actions\Sections\Ads\GetClients;
use ReactPHPVK\Actions\Sections\Ads\GetDemographics;
use ReactPHPVK\Actions\Sections\Ads\GetFloodStats;
use ReactPHPVK\Actions\Sections\Ads\GetLookalikeRequests;
use ReactPHPVK\Actions\Sections\Ads\GetMusicians;
use ReactPHPVK\Actions\Sections\Ads\GetOfficeUsers;
use ReactPHPVK\Actions\Sections\Ads\GetPostsReach;
use ReactPHPVK\Actions\Sections\Ads\GetRejectionReason;
use ReactPHPVK\Actions\Sections\Ads\GetStatistics;
use ReactPHPVK\Actions\Sections\Ads\GetSuggestions;
use ReactPHPVK\Actions\Sections\Ads\GetTargetGroups;
use ReactPHPVK\Actions\Sections\Ads\GetTargetingStats;
use ReactPHPVK\Actions\Sections\Ads\GetUploadURL;
use ReactPHPVK\Actions\Sections\Ads\GetVideoUploadURL;
use ReactPHPVK\Actions\Sections\Ads\ImportTargetContacts;
use ReactPHPVK\Actions\Sections\Ads\RemoveOfficeUsers;
use ReactPHPVK\Actions\Sections\Ads\UpdateAds;
use ReactPHPVK\Actions\Sections\Ads\UpdateCampaigns;
use ReactPHPVK\Actions\Sections\Ads\UpdateClients;
use ReactPHPVK\Actions\Sections\Ads\UpdateTargetGroup;

class Ads
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds managers and/or supervisors to advertising account.
     */
    public function addOfficeUsers(): AddOfficeUsers
    {
        return new AddOfficeUsers($this->_provider);
    }

    /**
     * Allows to check the ad link.
     */
    public function checkLink(): CheckLink
    {
        return new CheckLink($this->_provider);
    }

    /**
     * Creates ads.
     */
    public function createAds(): CreateAds
    {
        return new CreateAds($this->_provider);
    }

    /**
     * Creates advertising campaigns.
     */
    public function createCampaigns(): CreateCampaigns
    {
        return new CreateCampaigns($this->_provider);
    }

    /**
     * Creates clients of an advertising agency.
     */
    public function createClients(): CreateClients
    {
        return new CreateClients($this->_provider);
    }

    /**
     * Creates a group to re-target ads for users who visited advertiser's site (viewed information about the product, registered, etc.).
     */
    public function createTargetGroup(): CreateTargetGroup
    {
        return new CreateTargetGroup($this->_provider);
    }

    /**
     * Archives ads.
     */
    public function deleteAds(): DeleteAds
    {
        return new DeleteAds($this->_provider);
    }

    /**
     * Archives advertising campaigns.
     */
    public function deleteCampaigns(): DeleteCampaigns
    {
        return new DeleteCampaigns($this->_provider);
    }

    /**
     * Archives clients of an advertising agency.
     */
    public function deleteClients(): DeleteClients
    {
        return new DeleteClients($this->_provider);
    }

    /**
     * Deletes a retarget group.
     */
    public function deleteTargetGroup(): DeleteTargetGroup
    {
        return new DeleteTargetGroup($this->_provider);
    }

    /**
     * Returns a list of advertising accounts.
     */
    public function getAccounts(): GetAccounts
    {
        return new GetAccounts($this->_provider);
    }

    /**
     * Returns number of ads.
     */
    public function getAds(): GetAds
    {
        return new GetAds($this->_provider);
    }

    /**
     * Returns descriptions of ad layouts.
     */
    public function getAdsLayout(): GetAdsLayout
    {
        return new GetAdsLayout($this->_provider);
    }

    /**
     * Returns ad targeting parameters.
     */
    public function getAdsTargeting(): GetAdsTargeting
    {
        return new GetAdsTargeting($this->_provider);
    }

    /**
     * Returns current budget of the advertising account.
     */
    public function getBudget(): GetBudget
    {
        return new GetBudget($this->_provider);
    }

    /**
     * Returns a list of campaigns in an advertising account.
     */
    public function getCampaigns(): GetCampaigns
    {
        return new GetCampaigns($this->_provider);
    }

    /**
     * Returns a list of possible ad categories.
     */
    public function getCategories(): GetCategories
    {
        return new GetCategories($this->_provider);
    }

    /**
     * Returns a list of advertising agency's clients.
     */
    public function getClients(): GetClients
    {
        return new GetClients($this->_provider);
    }

    /**
     * Returns demographics for ads or campaigns.
     */
    public function getDemographics(): GetDemographics
    {
        return new GetDemographics($this->_provider);
    }

    /**
     * Returns information about current state of a counter — number of remaining runs of methods and time to the next counter nulling in seconds.
     */
    public function getFloodStats(): GetFloodStats
    {
        return new GetFloodStats($this->_provider);
    }

    /**
     * 
     */
    public function getLookalikeRequests(): GetLookalikeRequests
    {
        return new GetLookalikeRequests($this->_provider);
    }

    /**
     * 
     */
    public function getMusicians(): GetMusicians
    {
        return new GetMusicians($this->_provider);
    }

    /**
     * Returns a list of managers and supervisors of advertising account.
     */
    public function getOfficeUsers(): GetOfficeUsers
    {
        return new GetOfficeUsers($this->_provider);
    }

    /**
     * Returns detailed statistics of promoted posts reach from campaigns and ads.
     */
    public function getPostsReach(): GetPostsReach
    {
        return new GetPostsReach($this->_provider);
    }

    /**
     * Returns a reason of ad rejection for pre-moderation.
     */
    public function getRejectionReason(): GetRejectionReason
    {
        return new GetRejectionReason($this->_provider);
    }

    /**
     * Returns statistics of performance indicators for ads, campaigns, clients or the whole account.
     */
    public function getStatistics(): GetStatistics
    {
        return new GetStatistics($this->_provider);
    }

    /**
     * Returns a set of auto-suggestions for various targeting parameters.
     */
    public function getSuggestions(): GetSuggestions
    {
        return new GetSuggestions($this->_provider);
    }

    /**
     * Returns a list of target groups.
     */
    public function getTargetGroups(): GetTargetGroups
    {
        return new GetTargetGroups($this->_provider);
    }

    /**
     * Returns the size of targeting audience, and also recommended values for CPC and CPM.
     */
    public function getTargetingStats(): GetTargetingStats
    {
        return new GetTargetingStats($this->_provider);
    }

    /**
     * Returns URL to upload an ad photo to.
     */
    public function getUploadURL(): GetUploadURL
    {
        return new GetUploadURL($this->_provider);
    }

    /**
     * Returns URL to upload an ad video to.
     */
    public function getVideoUploadURL(): GetVideoUploadURL
    {
        return new GetVideoUploadURL($this->_provider);
    }

    /**
     * Imports a list of advertiser's contacts to count VK registered users against the target group.
     */
    public function importTargetContacts(): ImportTargetContacts
    {
        return new ImportTargetContacts($this->_provider);
    }

    /**
     * Removes managers and/or supervisors from advertising account.
     */
    public function removeOfficeUsers(): RemoveOfficeUsers
    {
        return new RemoveOfficeUsers($this->_provider);
    }

    /**
     * Edits ads.
     */
    public function updateAds(): UpdateAds
    {
        return new UpdateAds($this->_provider);
    }

    /**
     * Edits advertising campaigns.
     */
    public function updateCampaigns(): UpdateCampaigns
    {
        return new UpdateCampaigns($this->_provider);
    }

    /**
     * Edits clients of an advertising agency.
     */
    public function updateClients(): UpdateClients
    {
        return new UpdateClients($this->_provider);
    }

    /**
     * Edits a retarget group.
     */
    public function updateTargetGroup(): UpdateTargetGroup
    {
        return new UpdateTargetGroup($this->_provider);
    }

}