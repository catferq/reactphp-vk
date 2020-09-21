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

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function addAddress(): AddAddress
    {
        return new AddAddress($this->_provider);
    }

    /**
     * 
     */
    public function addCallbackServer(): AddCallbackServer
    {
        return new AddCallbackServer($this->_provider);
    }

    /**
     * Allows to add a link to the community.
     */
    public function addLink(): AddLink
    {
        return new AddLink($this->_provider);
    }

    /**
     * Allows to approve join request to the community.
     */
    public function approveRequest(): ApproveRequest
    {
        return new ApproveRequest($this->_provider);
    }

    /**
     * 
     */
    public function ban(): Ban
    {
        return new Ban($this->_provider);
    }

    /**
     * Creates a new community.
     */
    public function create(): Create
    {
        return new Create($this->_provider);
    }

    /**
     * 
     */
    public function deleteCallbackServer(): DeleteCallbackServer
    {
        return new DeleteCallbackServer($this->_provider);
    }

    /**
     * Allows to delete a link from the community.
     */
    public function deleteLink(): DeleteLink
    {
        return new DeleteLink($this->_provider);
    }

    /**
     * 
     */
    public function disableOnline(): DisableOnline
    {
        return new DisableOnline($this->_provider);
    }

    /**
     * Edits a community.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * 
     */
    public function editAddress(): EditAddress
    {
        return new EditAddress($this->_provider);
    }

    /**
     * 
     */
    public function editCallbackServer(): EditCallbackServer
    {
        return new EditCallbackServer($this->_provider);
    }

    /**
     * Allows to edit a link in the community.
     */
    public function editLink(): EditLink
    {
        return new EditLink($this->_provider);
    }

    /**
     * Allows to add, remove or edit the community manager.
     */
    public function editManager(): EditManager
    {
        return new EditManager($this->_provider);
    }

    /**
     * 
     */
    public function enableOnline(): EnableOnline
    {
        return new EnableOnline($this->_provider);
    }

    /**
     * Returns a list of the communities to which a user belongs.
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * Returns a list of community addresses.
     */
    public function getAddresses(): GetAddresses
    {
        return new GetAddresses($this->_provider);
    }

    /**
     * Returns a list of users on a community blacklist.
     */
    public function getBanned(): GetBanned
    {
        return new GetBanned($this->_provider);
    }

    /**
     * Returns information about communities by their IDs.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * Returns Callback API confirmation code for the community.
     */
    public function getCallbackConfirmationCode(): GetCallbackConfirmationCode
    {
        return new GetCallbackConfirmationCode($this->_provider);
    }

    /**
     * 
     */
    public function getCallbackServers(): GetCallbackServers
    {
        return new GetCallbackServers($this->_provider);
    }

    /**
     * Returns [vk.com/dev/callback_api|Callback API] notifications settings.
     */
    public function getCallbackSettings(): GetCallbackSettings
    {
        return new GetCallbackSettings($this->_provider);
    }

    /**
     * Returns communities list for a catalog category.
     */
    public function getCatalog(): GetCatalog
    {
        return new GetCatalog($this->_provider);
    }

    /**
     * Returns categories list for communities catalog
     */
    public function getCatalogInfo(): GetCatalogInfo
    {
        return new GetCatalogInfo($this->_provider);
    }

    /**
     * Returns invited users list of a community
     */
    public function getInvitedUsers(): GetInvitedUsers
    {
        return new GetInvitedUsers($this->_provider);
    }

    /**
     * Returns a list of invitations to join communities and events.
     */
    public function getInvites(): GetInvites
    {
        return new GetInvites($this->_provider);
    }

    /**
     * Returns the data needed to query a Long Poll server for events
     */
    public function getLongPollServer(): GetLongPollServer
    {
        return new GetLongPollServer($this->_provider);
    }

    /**
     * Returns Long Poll notification settings
     */
    public function getLongPollSettings(): GetLongPollSettings
    {
        return new GetLongPollSettings($this->_provider);
    }

    /**
     * Returns a list of community members.
     */
    public function getMembers(): GetMembers
    {
        return new GetMembers($this->_provider);
    }

    /**
     * Returns a list of requests to the community.
     */
    public function getRequests(): GetRequests
    {
        return new GetRequests($this->_provider);
    }

    /**
     * Returns community settings.
     */
    public function getSettings(): GetSettings
    {
        return new GetSettings($this->_provider);
    }

    /**
     * 
     */
    public function getTokenPermissions(): GetTokenPermissions
    {
        return new GetTokenPermissions($this->_provider);
    }

    /**
     * Allows to invite friends to the community.
     */
    public function invite(): Invite
    {
        return new Invite($this->_provider);
    }

    /**
     * Returns information specifying whether a user is a member of a community.
     */
    public function isMember(): IsMember
    {
        return new IsMember($this->_provider);
    }

    /**
     * With this method you can join the group or public page, and also confirm your participation in an event.
     */
    public function join(): Join
    {
        return new Join($this->_provider);
    }

    /**
     * With this method you can leave a group, public page, or event.
     */
    public function leave(): Leave
    {
        return new Leave($this->_provider);
    }

    /**
     * Removes a user from the community.
     */
    public function removeUser(): RemoveUser
    {
        return new RemoveUser($this->_provider);
    }

    /**
     * Allows to reorder links in the community.
     */
    public function reorderLink(): ReorderLink
    {
        return new ReorderLink($this->_provider);
    }

    /**
     * Returns a list of communities matching the search criteria.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

    /**
     * Allow to set notifications settings for group.
     */
    public function setCallbackSettings(): SetCallbackSettings
    {
        return new SetCallbackSettings($this->_provider);
    }

    /**
     * Sets Long Poll notification settings
     */
    public function setLongPollSettings(): SetLongPollSettings
    {
        return new SetLongPollSettings($this->_provider);
    }

    /**
     * 
     */
    public function unban(): Unban
    {
        return new Unban($this->_provider);
    }

}