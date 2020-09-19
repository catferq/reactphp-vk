<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Groups\AddAddress;
use ReactPHPVK\Actions\Sections\Groups\AddCallbackServer;
use ReactPHPVK\Actions\Sections\Groups\AddLink;
use ReactPHPVK\Actions\Sections\Groups\ApproveRequest;
use ReactPHPVK\Actions\Sections\Groups\Ban;
use ReactPHPVK\Actions\Sections\Groups\Create;
use ReactPHPVK\Actions\Sections\Groups\DeleteCallbackServer;
use ReactPHPVK\Actions\Sections\Groups\DeleteLink;
use ReactPHPVK\Actions\Sections\Groups\DisableOnline;
use ReactPHPVK\Actions\Sections\Groups\Edit;
use ReactPHPVK\Actions\Sections\Groups\EditAddress;
use ReactPHPVK\Actions\Sections\Groups\EditCallbackServer;
use ReactPHPVK\Actions\Sections\Groups\EditLink;
use ReactPHPVK\Actions\Sections\Groups\EditManager;
use ReactPHPVK\Actions\Sections\Groups\EnableOnline;
use ReactPHPVK\Actions\Sections\Groups\Get;
use ReactPHPVK\Actions\Sections\Groups\GetAddresses;
use ReactPHPVK\Actions\Sections\Groups\GetBanned;
use ReactPHPVK\Actions\Sections\Groups\GetById;
use ReactPHPVK\Actions\Sections\Groups\GetCallbackConfirmationCode;
use ReactPHPVK\Actions\Sections\Groups\GetCallbackServers;
use ReactPHPVK\Actions\Sections\Groups\GetCallbackSettings;
use ReactPHPVK\Actions\Sections\Groups\GetCatalog;
use ReactPHPVK\Actions\Sections\Groups\GetCatalogInfo;
use ReactPHPVK\Actions\Sections\Groups\GetInvitedUsers;
use ReactPHPVK\Actions\Sections\Groups\GetInvites;
use ReactPHPVK\Actions\Sections\Groups\GetLongPollServer;
use ReactPHPVK\Actions\Sections\Groups\GetLongPollSettings;
use ReactPHPVK\Actions\Sections\Groups\GetMembers;
use ReactPHPVK\Actions\Sections\Groups\GetRequests;
use ReactPHPVK\Actions\Sections\Groups\GetSettings;
use ReactPHPVK\Actions\Sections\Groups\GetTokenPermissions;
use ReactPHPVK\Actions\Sections\Groups\Invite;
use ReactPHPVK\Actions\Sections\Groups\IsMember;
use ReactPHPVK\Actions\Sections\Groups\Join;
use ReactPHPVK\Actions\Sections\Groups\Leave;
use ReactPHPVK\Actions\Sections\Groups\RemoveUser;
use ReactPHPVK\Actions\Sections\Groups\ReorderLink;
use ReactPHPVK\Actions\Sections\Groups\Search;
use ReactPHPVK\Actions\Sections\Groups\SetCallbackSettings;
use ReactPHPVK\Actions\Sections\Groups\SetLongPollSettings;
use ReactPHPVK\Actions\Sections\Groups\Unban;

class Groups
{
    private Provider $_provider;

    private ?Groups\AddAddress $addAddress = null;
    private ?Groups\AddCallbackServer $addCallbackServer = null;
    private ?Groups\AddLink $addLink = null;
    private ?Groups\ApproveRequest $approveRequest = null;
    private ?Groups\Ban $ban = null;
    private ?Groups\Create $create = null;
    private ?Groups\DeleteCallbackServer $deleteCallbackServer = null;
    private ?Groups\DeleteLink $deleteLink = null;
    private ?Groups\DisableOnline $disableOnline = null;
    private ?Groups\Edit $edit = null;
    private ?Groups\EditAddress $editAddress = null;
    private ?Groups\EditCallbackServer $editCallbackServer = null;
    private ?Groups\EditLink $editLink = null;
    private ?Groups\EditManager $editManager = null;
    private ?Groups\EnableOnline $enableOnline = null;
    private ?Groups\Get $get = null;
    private ?Groups\GetAddresses $getAddresses = null;
    private ?Groups\GetBanned $getBanned = null;
    private ?Groups\GetById $getById = null;
    private ?Groups\GetCallbackConfirmationCode $getCallbackConfirmationCode = null;
    private ?Groups\GetCallbackServers $getCallbackServers = null;
    private ?Groups\GetCallbackSettings $getCallbackSettings = null;
    private ?Groups\GetCatalog $getCatalog = null;
    private ?Groups\GetCatalogInfo $getCatalogInfo = null;
    private ?Groups\GetInvitedUsers $getInvitedUsers = null;
    private ?Groups\GetInvites $getInvites = null;
    private ?Groups\GetLongPollServer $getLongPollServer = null;
    private ?Groups\GetLongPollSettings $getLongPollSettings = null;
    private ?Groups\GetMembers $getMembers = null;
    private ?Groups\GetRequests $getRequests = null;
    private ?Groups\GetSettings $getSettings = null;
    private ?Groups\GetTokenPermissions $getTokenPermissions = null;
    private ?Groups\Invite $invite = null;
    private ?Groups\IsMember $isMember = null;
    private ?Groups\Join $join = null;
    private ?Groups\Leave $leave = null;
    private ?Groups\RemoveUser $removeUser = null;
    private ?Groups\ReorderLink $reorderLink = null;
    private ?Groups\Search $search = null;
    private ?Groups\SetCallbackSettings $setCallbackSettings = null;
    private ?Groups\SetLongPollSettings $setLongPollSettings = null;
    private ?Groups\Unban $unban = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function addAddress(): AddAddress
    {
        if (!$this->addAddress) {
            $this->addAddress = new AddAddress($this->_provider);
        }
        return $this->addAddress;
    }

    /**
     * 
     */
    public function addCallbackServer(): AddCallbackServer
    {
        if (!$this->addCallbackServer) {
            $this->addCallbackServer = new AddCallbackServer($this->_provider);
        }
        return $this->addCallbackServer;
    }

    /**
     * Allows to add a link to the community.
     */
    public function addLink(): AddLink
    {
        if (!$this->addLink) {
            $this->addLink = new AddLink($this->_provider);
        }
        return $this->addLink;
    }

    /**
     * Allows to approve join request to the community.
     */
    public function approveRequest(): ApproveRequest
    {
        if (!$this->approveRequest) {
            $this->approveRequest = new ApproveRequest($this->_provider);
        }
        return $this->approveRequest;
    }

    /**
     * 
     */
    public function ban(): Ban
    {
        if (!$this->ban) {
            $this->ban = new Ban($this->_provider);
        }
        return $this->ban;
    }

    /**
     * Creates a new community.
     */
    public function create(): Create
    {
        if (!$this->create) {
            $this->create = new Create($this->_provider);
        }
        return $this->create;
    }

    /**
     * 
     */
    public function deleteCallbackServer(): DeleteCallbackServer
    {
        if (!$this->deleteCallbackServer) {
            $this->deleteCallbackServer = new DeleteCallbackServer($this->_provider);
        }
        return $this->deleteCallbackServer;
    }

    /**
     * Allows to delete a link from the community.
     */
    public function deleteLink(): DeleteLink
    {
        if (!$this->deleteLink) {
            $this->deleteLink = new DeleteLink($this->_provider);
        }
        return $this->deleteLink;
    }

    /**
     * 
     */
    public function disableOnline(): DisableOnline
    {
        if (!$this->disableOnline) {
            $this->disableOnline = new DisableOnline($this->_provider);
        }
        return $this->disableOnline;
    }

    /**
     * Edits a community.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * 
     */
    public function editAddress(): EditAddress
    {
        if (!$this->editAddress) {
            $this->editAddress = new EditAddress($this->_provider);
        }
        return $this->editAddress;
    }

    /**
     * 
     */
    public function editCallbackServer(): EditCallbackServer
    {
        if (!$this->editCallbackServer) {
            $this->editCallbackServer = new EditCallbackServer($this->_provider);
        }
        return $this->editCallbackServer;
    }

    /**
     * Allows to edit a link in the community.
     */
    public function editLink(): EditLink
    {
        if (!$this->editLink) {
            $this->editLink = new EditLink($this->_provider);
        }
        return $this->editLink;
    }

    /**
     * Allows to add, remove or edit the community manager.
     */
    public function editManager(): EditManager
    {
        if (!$this->editManager) {
            $this->editManager = new EditManager($this->_provider);
        }
        return $this->editManager;
    }

    /**
     * 
     */
    public function enableOnline(): EnableOnline
    {
        if (!$this->enableOnline) {
            $this->enableOnline = new EnableOnline($this->_provider);
        }
        return $this->enableOnline;
    }

    /**
     * Returns a list of the communities to which a user belongs.
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * Returns a list of community addresses.
     */
    public function getAddresses(): GetAddresses
    {
        if (!$this->getAddresses) {
            $this->getAddresses = new GetAddresses($this->_provider);
        }
        return $this->getAddresses;
    }

    /**
     * Returns a list of users on a community blacklist.
     */
    public function getBanned(): GetBanned
    {
        if (!$this->getBanned) {
            $this->getBanned = new GetBanned($this->_provider);
        }
        return $this->getBanned;
    }

    /**
     * Returns information about communities by their IDs.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * Returns Callback API confirmation code for the community.
     */
    public function getCallbackConfirmationCode(): GetCallbackConfirmationCode
    {
        if (!$this->getCallbackConfirmationCode) {
            $this->getCallbackConfirmationCode = new GetCallbackConfirmationCode($this->_provider);
        }
        return $this->getCallbackConfirmationCode;
    }

    /**
     * 
     */
    public function getCallbackServers(): GetCallbackServers
    {
        if (!$this->getCallbackServers) {
            $this->getCallbackServers = new GetCallbackServers($this->_provider);
        }
        return $this->getCallbackServers;
    }

    /**
     * Returns [vk.com/dev/callback_api|Callback API] notifications settings.
     */
    public function getCallbackSettings(): GetCallbackSettings
    {
        if (!$this->getCallbackSettings) {
            $this->getCallbackSettings = new GetCallbackSettings($this->_provider);
        }
        return $this->getCallbackSettings;
    }

    /**
     * Returns communities list for a catalog category.
     */
    public function getCatalog(): GetCatalog
    {
        if (!$this->getCatalog) {
            $this->getCatalog = new GetCatalog($this->_provider);
        }
        return $this->getCatalog;
    }

    /**
     * Returns categories list for communities catalog
     */
    public function getCatalogInfo(): GetCatalogInfo
    {
        if (!$this->getCatalogInfo) {
            $this->getCatalogInfo = new GetCatalogInfo($this->_provider);
        }
        return $this->getCatalogInfo;
    }

    /**
     * Returns invited users list of a community
     */
    public function getInvitedUsers(): GetInvitedUsers
    {
        if (!$this->getInvitedUsers) {
            $this->getInvitedUsers = new GetInvitedUsers($this->_provider);
        }
        return $this->getInvitedUsers;
    }

    /**
     * Returns a list of invitations to join communities and events.
     */
    public function getInvites(): GetInvites
    {
        if (!$this->getInvites) {
            $this->getInvites = new GetInvites($this->_provider);
        }
        return $this->getInvites;
    }

    /**
     * Returns the data needed to query a Long Poll server for events
     */
    public function getLongPollServer(): GetLongPollServer
    {
        if (!$this->getLongPollServer) {
            $this->getLongPollServer = new GetLongPollServer($this->_provider);
        }
        return $this->getLongPollServer;
    }

    /**
     * Returns Long Poll notification settings
     */
    public function getLongPollSettings(): GetLongPollSettings
    {
        if (!$this->getLongPollSettings) {
            $this->getLongPollSettings = new GetLongPollSettings($this->_provider);
        }
        return $this->getLongPollSettings;
    }

    /**
     * Returns a list of community members.
     */
    public function getMembers(): GetMembers
    {
        if (!$this->getMembers) {
            $this->getMembers = new GetMembers($this->_provider);
        }
        return $this->getMembers;
    }

    /**
     * Returns a list of requests to the community.
     */
    public function getRequests(): GetRequests
    {
        if (!$this->getRequests) {
            $this->getRequests = new GetRequests($this->_provider);
        }
        return $this->getRequests;
    }

    /**
     * Returns community settings.
     */
    public function getSettings(): GetSettings
    {
        if (!$this->getSettings) {
            $this->getSettings = new GetSettings($this->_provider);
        }
        return $this->getSettings;
    }

    /**
     * 
     */
    public function getTokenPermissions(): GetTokenPermissions
    {
        if (!$this->getTokenPermissions) {
            $this->getTokenPermissions = new GetTokenPermissions($this->_provider);
        }
        return $this->getTokenPermissions;
    }

    /**
     * Allows to invite friends to the community.
     */
    public function invite(): Invite
    {
        if (!$this->invite) {
            $this->invite = new Invite($this->_provider);
        }
        return $this->invite;
    }

    /**
     * Returns information specifying whether a user is a member of a community.
     */
    public function isMember(): IsMember
    {
        if (!$this->isMember) {
            $this->isMember = new IsMember($this->_provider);
        }
        return $this->isMember;
    }

    /**
     * With this method you can join the group or public page, and also confirm your participation in an event.
     */
    public function join(): Join
    {
        if (!$this->join) {
            $this->join = new Join($this->_provider);
        }
        return $this->join;
    }

    /**
     * With this method you can leave a group, public page, or event.
     */
    public function leave(): Leave
    {
        if (!$this->leave) {
            $this->leave = new Leave($this->_provider);
        }
        return $this->leave;
    }

    /**
     * Removes a user from the community.
     */
    public function removeUser(): RemoveUser
    {
        if (!$this->removeUser) {
            $this->removeUser = new RemoveUser($this->_provider);
        }
        return $this->removeUser;
    }

    /**
     * Allows to reorder links in the community.
     */
    public function reorderLink(): ReorderLink
    {
        if (!$this->reorderLink) {
            $this->reorderLink = new ReorderLink($this->_provider);
        }
        return $this->reorderLink;
    }

    /**
     * Returns a list of communities matching the search criteria.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

    /**
     * Allow to set notifications settings for group.
     */
    public function setCallbackSettings(): SetCallbackSettings
    {
        if (!$this->setCallbackSettings) {
            $this->setCallbackSettings = new SetCallbackSettings($this->_provider);
        }
        return $this->setCallbackSettings;
    }

    /**
     * Sets Long Poll notification settings
     */
    public function setLongPollSettings(): SetLongPollSettings
    {
        if (!$this->setLongPollSettings) {
            $this->setLongPollSettings = new SetLongPollSettings($this->_provider);
        }
        return $this->setLongPollSettings;
    }

    /**
     * 
     */
    public function unban(): Unban
    {
        if (!$this->unban) {
            $this->unban = new Unban($this->_provider);
        }
        return $this->unban;
    }

}