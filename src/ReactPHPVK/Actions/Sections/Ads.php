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

    private ?Ads\AddOfficeUsers $addOfficeUsers = null;
    private ?Ads\CheckLink $checkLink = null;
    private ?Ads\CreateAds $createAds = null;
    private ?Ads\CreateCampaigns $createCampaigns = null;
    private ?Ads\CreateClients $createClients = null;
    private ?Ads\CreateTargetGroup $createTargetGroup = null;
    private ?Ads\DeleteAds $deleteAds = null;
    private ?Ads\DeleteCampaigns $deleteCampaigns = null;
    private ?Ads\DeleteClients $deleteClients = null;
    private ?Ads\DeleteTargetGroup $deleteTargetGroup = null;
    private ?Ads\GetAccounts $getAccounts = null;
    private ?Ads\GetAds $getAds = null;
    private ?Ads\GetAdsLayout $getAdsLayout = null;
    private ?Ads\GetAdsTargeting $getAdsTargeting = null;
    private ?Ads\GetBudget $getBudget = null;
    private ?Ads\GetCampaigns $getCampaigns = null;
    private ?Ads\GetCategories $getCategories = null;
    private ?Ads\GetClients $getClients = null;
    private ?Ads\GetDemographics $getDemographics = null;
    private ?Ads\GetFloodStats $getFloodStats = null;
    private ?Ads\GetLookalikeRequests $getLookalikeRequests = null;
    private ?Ads\GetMusicians $getMusicians = null;
    private ?Ads\GetOfficeUsers $getOfficeUsers = null;
    private ?Ads\GetPostsReach $getPostsReach = null;
    private ?Ads\GetRejectionReason $getRejectionReason = null;
    private ?Ads\GetStatistics $getStatistics = null;
    private ?Ads\GetSuggestions $getSuggestions = null;
    private ?Ads\GetTargetGroups $getTargetGroups = null;
    private ?Ads\GetTargetingStats $getTargetingStats = null;
    private ?Ads\GetUploadURL $getUploadURL = null;
    private ?Ads\GetVideoUploadURL $getVideoUploadURL = null;
    private ?Ads\ImportTargetContacts $importTargetContacts = null;
    private ?Ads\RemoveOfficeUsers $removeOfficeUsers = null;
    private ?Ads\UpdateAds $updateAds = null;
    private ?Ads\UpdateCampaigns $updateCampaigns = null;
    private ?Ads\UpdateClients $updateClients = null;
    private ?Ads\UpdateTargetGroup $updateTargetGroup = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds managers and/or supervisors to advertising account.
     */
    public function addOfficeUsers(): AddOfficeUsers
    {
        if (!$this->addOfficeUsers) {
            $this->addOfficeUsers = new AddOfficeUsers($this->_provider);
        }
        return $this->addOfficeUsers;
    }

    /**
     * Allows to check the ad link.
     */
    public function checkLink(): CheckLink
    {
        if (!$this->checkLink) {
            $this->checkLink = new CheckLink($this->_provider);
        }
        return $this->checkLink;
    }

    /**
     * Creates ads.
     */
    public function createAds(): CreateAds
    {
        if (!$this->createAds) {
            $this->createAds = new CreateAds($this->_provider);
        }
        return $this->createAds;
    }

    /**
     * Creates advertising campaigns.
     */
    public function createCampaigns(): CreateCampaigns
    {
        if (!$this->createCampaigns) {
            $this->createCampaigns = new CreateCampaigns($this->_provider);
        }
        return $this->createCampaigns;
    }

    /**
     * Creates clients of an advertising agency.
     */
    public function createClients(): CreateClients
    {
        if (!$this->createClients) {
            $this->createClients = new CreateClients($this->_provider);
        }
        return $this->createClients;
    }

    /**
     * Creates a group to re-target ads for users who visited advertiser's site (viewed information about the product, registered, etc.).
     */
    public function createTargetGroup(): CreateTargetGroup
    {
        if (!$this->createTargetGroup) {
            $this->createTargetGroup = new CreateTargetGroup($this->_provider);
        }
        return $this->createTargetGroup;
    }

    /**
     * Archives ads.
     */
    public function deleteAds(): DeleteAds
    {
        if (!$this->deleteAds) {
            $this->deleteAds = new DeleteAds($this->_provider);
        }
        return $this->deleteAds;
    }

    /**
     * Archives advertising campaigns.
     */
    public function deleteCampaigns(): DeleteCampaigns
    {
        if (!$this->deleteCampaigns) {
            $this->deleteCampaigns = new DeleteCampaigns($this->_provider);
        }
        return $this->deleteCampaigns;
    }

    /**
     * Archives clients of an advertising agency.
     */
    public function deleteClients(): DeleteClients
    {
        if (!$this->deleteClients) {
            $this->deleteClients = new DeleteClients($this->_provider);
        }
        return $this->deleteClients;
    }

    /**
     * Deletes a retarget group.
     */
    public function deleteTargetGroup(): DeleteTargetGroup
    {
        if (!$this->deleteTargetGroup) {
            $this->deleteTargetGroup = new DeleteTargetGroup($this->_provider);
        }
        return $this->deleteTargetGroup;
    }

    /**
     * Returns a list of advertising accounts.
     */
    public function getAccounts(): GetAccounts
    {
        if (!$this->getAccounts) {
            $this->getAccounts = new GetAccounts($this->_provider);
        }
        return $this->getAccounts;
    }

    /**
     * Returns number of ads.
     */
    public function getAds(): GetAds
    {
        if (!$this->getAds) {
            $this->getAds = new GetAds($this->_provider);
        }
        return $this->getAds;
    }

    /**
     * Returns descriptions of ad layouts.
     */
    public function getAdsLayout(): GetAdsLayout
    {
        if (!$this->getAdsLayout) {
            $this->getAdsLayout = new GetAdsLayout($this->_provider);
        }
        return $this->getAdsLayout;
    }

    /**
     * Returns ad targeting parameters.
     */
    public function getAdsTargeting(): GetAdsTargeting
    {
        if (!$this->getAdsTargeting) {
            $this->getAdsTargeting = new GetAdsTargeting($this->_provider);
        }
        return $this->getAdsTargeting;
    }

    /**
     * Returns current budget of the advertising account.
     */
    public function getBudget(): GetBudget
    {
        if (!$this->getBudget) {
            $this->getBudget = new GetBudget($this->_provider);
        }
        return $this->getBudget;
    }

    /**
     * Returns a list of campaigns in an advertising account.
     */
    public function getCampaigns(): GetCampaigns
    {
        if (!$this->getCampaigns) {
            $this->getCampaigns = new GetCampaigns($this->_provider);
        }
        return $this->getCampaigns;
    }

    /**
     * Returns a list of possible ad categories.
     */
    public function getCategories(): GetCategories
    {
        if (!$this->getCategories) {
            $this->getCategories = new GetCategories($this->_provider);
        }
        return $this->getCategories;
    }

    /**
     * Returns a list of advertising agency's clients.
     */
    public function getClients(): GetClients
    {
        if (!$this->getClients) {
            $this->getClients = new GetClients($this->_provider);
        }
        return $this->getClients;
    }

    /**
     * Returns demographics for ads or campaigns.
     */
    public function getDemographics(): GetDemographics
    {
        if (!$this->getDemographics) {
            $this->getDemographics = new GetDemographics($this->_provider);
        }
        return $this->getDemographics;
    }

    /**
     * Returns information about current state of a counter — number of remaining runs of methods and time to the next counter nulling in seconds.
     */
    public function getFloodStats(): GetFloodStats
    {
        if (!$this->getFloodStats) {
            $this->getFloodStats = new GetFloodStats($this->_provider);
        }
        return $this->getFloodStats;
    }

    /**
     * 
     */
    public function getLookalikeRequests(): GetLookalikeRequests
    {
        if (!$this->getLookalikeRequests) {
            $this->getLookalikeRequests = new GetLookalikeRequests($this->_provider);
        }
        return $this->getLookalikeRequests;
    }

    /**
     * 
     */
    public function getMusicians(): GetMusicians
    {
        if (!$this->getMusicians) {
            $this->getMusicians = new GetMusicians($this->_provider);
        }
        return $this->getMusicians;
    }

    /**
     * Returns a list of managers and supervisors of advertising account.
     */
    public function getOfficeUsers(): GetOfficeUsers
    {
        if (!$this->getOfficeUsers) {
            $this->getOfficeUsers = new GetOfficeUsers($this->_provider);
        }
        return $this->getOfficeUsers;
    }

    /**
     * Returns detailed statistics of promoted posts reach from campaigns and ads.
     */
    public function getPostsReach(): GetPostsReach
    {
        if (!$this->getPostsReach) {
            $this->getPostsReach = new GetPostsReach($this->_provider);
        }
        return $this->getPostsReach;
    }

    /**
     * Returns a reason of ad rejection for pre-moderation.
     */
    public function getRejectionReason(): GetRejectionReason
    {
        if (!$this->getRejectionReason) {
            $this->getRejectionReason = new GetRejectionReason($this->_provider);
        }
        return $this->getRejectionReason;
    }

    /**
     * Returns statistics of performance indicators for ads, campaigns, clients or the whole account.
     */
    public function getStatistics(): GetStatistics
    {
        if (!$this->getStatistics) {
            $this->getStatistics = new GetStatistics($this->_provider);
        }
        return $this->getStatistics;
    }

    /**
     * Returns a set of auto-suggestions for various targeting parameters.
     */
    public function getSuggestions(): GetSuggestions
    {
        if (!$this->getSuggestions) {
            $this->getSuggestions = new GetSuggestions($this->_provider);
        }
        return $this->getSuggestions;
    }

    /**
     * Returns a list of target groups.
     */
    public function getTargetGroups(): GetTargetGroups
    {
        if (!$this->getTargetGroups) {
            $this->getTargetGroups = new GetTargetGroups($this->_provider);
        }
        return $this->getTargetGroups;
    }

    /**
     * Returns the size of targeting audience, and also recommended values for CPC and CPM.
     */
    public function getTargetingStats(): GetTargetingStats
    {
        if (!$this->getTargetingStats) {
            $this->getTargetingStats = new GetTargetingStats($this->_provider);
        }
        return $this->getTargetingStats;
    }

    /**
     * Returns URL to upload an ad photo to.
     */
    public function getUploadURL(): GetUploadURL
    {
        if (!$this->getUploadURL) {
            $this->getUploadURL = new GetUploadURL($this->_provider);
        }
        return $this->getUploadURL;
    }

    /**
     * Returns URL to upload an ad video to.
     */
    public function getVideoUploadURL(): GetVideoUploadURL
    {
        if (!$this->getVideoUploadURL) {
            $this->getVideoUploadURL = new GetVideoUploadURL($this->_provider);
        }
        return $this->getVideoUploadURL;
    }

    /**
     * Imports a list of advertiser's contacts to count VK registered users against the target group.
     */
    public function importTargetContacts(): ImportTargetContacts
    {
        if (!$this->importTargetContacts) {
            $this->importTargetContacts = new ImportTargetContacts($this->_provider);
        }
        return $this->importTargetContacts;
    }

    /**
     * Removes managers and/or supervisors from advertising account.
     */
    public function removeOfficeUsers(): RemoveOfficeUsers
    {
        if (!$this->removeOfficeUsers) {
            $this->removeOfficeUsers = new RemoveOfficeUsers($this->_provider);
        }
        return $this->removeOfficeUsers;
    }

    /**
     * Edits ads.
     */
    public function updateAds(): UpdateAds
    {
        if (!$this->updateAds) {
            $this->updateAds = new UpdateAds($this->_provider);
        }
        return $this->updateAds;
    }

    /**
     * Edits advertising campaigns.
     */
    public function updateCampaigns(): UpdateCampaigns
    {
        if (!$this->updateCampaigns) {
            $this->updateCampaigns = new UpdateCampaigns($this->_provider);
        }
        return $this->updateCampaigns;
    }

    /**
     * Edits clients of an advertising agency.
     */
    public function updateClients(): UpdateClients
    {
        if (!$this->updateClients) {
            $this->updateClients = new UpdateClients($this->_provider);
        }
        return $this->updateClients;
    }

    /**
     * Edits a retarget group.
     */
    public function updateTargetGroup(): UpdateTargetGroup
    {
        if (!$this->updateTargetGroup) {
            $this->updateTargetGroup = new UpdateTargetGroup($this->_provider);
        }
        return $this->updateTargetGroup;
    }

}