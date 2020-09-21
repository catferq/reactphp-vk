<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Messages\AddChatUser;
use ReactPHPVK\Actions\Sections\Messages\AllowMessagesFromGroup;
use ReactPHPVK\Actions\Sections\Messages\CreateChat;
use ReactPHPVK\Actions\Sections\Messages\Delete;
use ReactPHPVK\Actions\Sections\Messages\DeleteChatPhoto;
use ReactPHPVK\Actions\Sections\Messages\DeleteConversation;
use ReactPHPVK\Actions\Sections\Messages\DenyMessagesFromGroup;
use ReactPHPVK\Actions\Sections\Messages\Edit;
use ReactPHPVK\Actions\Sections\Messages\EditChat;
use ReactPHPVK\Actions\Sections\Messages\GetByConversationMessageId;
use ReactPHPVK\Actions\Sections\Messages\GetById;
use ReactPHPVK\Actions\Sections\Messages\GetChatPreview;
use ReactPHPVK\Actions\Sections\Messages\GetConversationMembers;
use ReactPHPVK\Actions\Sections\Messages\GetConversations;
use ReactPHPVK\Actions\Sections\Messages\GetConversationsById;
use ReactPHPVK\Actions\Sections\Messages\GetHistory;
use ReactPHPVK\Actions\Sections\Messages\GetHistoryAttachments;
use ReactPHPVK\Actions\Sections\Messages\GetInviteLink;
use ReactPHPVK\Actions\Sections\Messages\GetLastActivity;
use ReactPHPVK\Actions\Sections\Messages\GetLongPollHistory;
use ReactPHPVK\Actions\Sections\Messages\GetLongPollServer;
use ReactPHPVK\Actions\Sections\Messages\IsMessagesFromGroupAllowed;
use ReactPHPVK\Actions\Sections\Messages\JoinChatByInviteLink;
use ReactPHPVK\Actions\Sections\Messages\MarkAsAnsweredConversation;
use ReactPHPVK\Actions\Sections\Messages\MarkAsImportant;
use ReactPHPVK\Actions\Sections\Messages\MarkAsImportantConversation;
use ReactPHPVK\Actions\Sections\Messages\MarkAsRead;
use ReactPHPVK\Actions\Sections\Messages\Pin;
use ReactPHPVK\Actions\Sections\Messages\RemoveChatUser;
use ReactPHPVK\Actions\Sections\Messages\Restore;
use ReactPHPVK\Actions\Sections\Messages\Search;
use ReactPHPVK\Actions\Sections\Messages\SearchConversations;
use ReactPHPVK\Actions\Sections\Messages\Send;
use ReactPHPVK\Actions\Sections\Messages\SendMessageEventAnswer;
use ReactPHPVK\Actions\Sections\Messages\SetActivity;
use ReactPHPVK\Actions\Sections\Messages\SetChatPhoto;
use ReactPHPVK\Actions\Sections\Messages\Unpin;

class Messages
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds a new user to a chat.
     */
    public function addChatUser(): AddChatUser
    {
        return new AddChatUser($this->_provider);
    }

    /**
     * Allows sending messages from community to the current user.
     */
    public function allowMessagesFromGroup(): AllowMessagesFromGroup
    {
        return new AllowMessagesFromGroup($this->_provider);
    }

    /**
     * Creates a chat with several participants.
     */
    public function createChat(): CreateChat
    {
        return new CreateChat($this->_provider);
    }

    /**
     * Deletes one or more messages.
     */
    public function delete(): Delete
    {
        return new Delete($this->_provider);
    }

    /**
     * Deletes a chat's cover picture.
     */
    public function deleteChatPhoto(): DeleteChatPhoto
    {
        return new DeleteChatPhoto($this->_provider);
    }

    /**
     * Deletes all private messages in a conversation.
     */
    public function deleteConversation(): DeleteConversation
    {
        return new DeleteConversation($this->_provider);
    }

    /**
     * Denies sending message from community to the current user.
     */
    public function denyMessagesFromGroup(): DenyMessagesFromGroup
    {
        return new DenyMessagesFromGroup($this->_provider);
    }

    /**
     * Edits the message.
     */
    public function edit(): Edit
    {
        return new Edit($this->_provider);
    }

    /**
     * Edits the title of a chat.
     */
    public function editChat(): EditChat
    {
        return new EditChat($this->_provider);
    }

    /**
     * Returns messages by their IDs within the conversation.
     */
    public function getByConversationMessageId(): GetByConversationMessageId
    {
        return new GetByConversationMessageId($this->_provider);
    }

    /**
     * Returns messages by their IDs.
     */
    public function getById(): GetById
    {
        return new GetById($this->_provider);
    }

    /**
     * 
     */
    public function getChatPreview(): GetChatPreview
    {
        return new GetChatPreview($this->_provider);
    }

    /**
     * Returns a list of IDs of users participating in a chat.
     */
    public function getConversationMembers(): GetConversationMembers
    {
        return new GetConversationMembers($this->_provider);
    }

    /**
     * Returns a list of the current user's conversations.
     */
    public function getConversations(): GetConversations
    {
        return new GetConversations($this->_provider);
    }

    /**
     * Returns conversations by their IDs
     */
    public function getConversationsById(): GetConversationsById
    {
        return new GetConversationsById($this->_provider);
    }

    /**
     * Returns message history for the specified user or group chat.
     */
    public function getHistory(): GetHistory
    {
        return new GetHistory($this->_provider);
    }

    /**
     * Returns media files from the dialog or group chat.
     */
    public function getHistoryAttachments(): GetHistoryAttachments
    {
        return new GetHistoryAttachments($this->_provider);
    }

    /**
     * 
     */
    public function getInviteLink(): GetInviteLink
    {
        return new GetInviteLink($this->_provider);
    }

    /**
     * Returns a user's current status and date of last activity.
     */
    public function getLastActivity(): GetLastActivity
    {
        return new GetLastActivity($this->_provider);
    }

    /**
     * Returns updates in user's private messages.
     */
    public function getLongPollHistory(): GetLongPollHistory
    {
        return new GetLongPollHistory($this->_provider);
    }

    /**
     * Returns data required for connection to a Long Poll server.
     */
    public function getLongPollServer(): GetLongPollServer
    {
        return new GetLongPollServer($this->_provider);
    }

    /**
     * Returns information whether sending messages from the community to current user is allowed.
     */
    public function isMessagesFromGroupAllowed(): IsMessagesFromGroupAllowed
    {
        return new IsMessagesFromGroupAllowed($this->_provider);
    }

    /**
     * 
     */
    public function joinChatByInviteLink(): JoinChatByInviteLink
    {
        return new JoinChatByInviteLink($this->_provider);
    }

    /**
     * Marks and unmarks conversations as unanswered.
     */
    public function markAsAnsweredConversation(): MarkAsAnsweredConversation
    {
        return new MarkAsAnsweredConversation($this->_provider);
    }

    /**
     * Marks and unmarks messages as important (starred).
     */
    public function markAsImportant(): MarkAsImportant
    {
        return new MarkAsImportant($this->_provider);
    }

    /**
     * Marks and unmarks conversations as important.
     */
    public function markAsImportantConversation(): MarkAsImportantConversation
    {
        return new MarkAsImportantConversation($this->_provider);
    }

    /**
     * Marks messages as read.
     */
    public function markAsRead(): MarkAsRead
    {
        return new MarkAsRead($this->_provider);
    }

    /**
     * Pin a message.
     */
    public function pin(): Pin
    {
        return new Pin($this->_provider);
    }

    /**
     * Allows the current user to leave a chat or, if the current user started the chat, allows the user to remove another user from the chat.
     */
    public function removeChatUser(): RemoveChatUser
    {
        return new RemoveChatUser($this->_provider);
    }

    /**
     * Restores a deleted message.
     */
    public function restore(): Restore
    {
        return new Restore($this->_provider);
    }

    /**
     * Returns a list of the current user's private messages that match search criteria.
     */
    public function search(): Search
    {
        return new Search($this->_provider);
    }

    /**
     * Returns a list of the current user's conversations that match search criteria.
     */
    public function searchConversations(): SearchConversations
    {
        return new SearchConversations($this->_provider);
    }

    /**
     * Sends a message.
     */
    public function send(): Send
    {
        return new Send($this->_provider);
    }

    /**
     * 
     */
    public function sendMessageEventAnswer(): SendMessageEventAnswer
    {
        return new SendMessageEventAnswer($this->_provider);
    }

    /**
     * Changes the status of a user as typing in a conversation.
     */
    public function setActivity(): SetActivity
    {
        return new SetActivity($this->_provider);
    }

    /**
     * Sets a previously-uploaded picture as the cover picture of a chat.
     */
    public function setChatPhoto(): SetChatPhoto
    {
        return new SetChatPhoto($this->_provider);
    }

    /**
     * 
     */
    public function unpin(): Unpin
    {
        return new Unpin($this->_provider);
    }

}