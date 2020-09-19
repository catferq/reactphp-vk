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

    private ?Messages\AddChatUser $addChatUser = null;
    private ?Messages\AllowMessagesFromGroup $allowMessagesFromGroup = null;
    private ?Messages\CreateChat $createChat = null;
    private ?Messages\Delete $delete = null;
    private ?Messages\DeleteChatPhoto $deleteChatPhoto = null;
    private ?Messages\DeleteConversation $deleteConversation = null;
    private ?Messages\DenyMessagesFromGroup $denyMessagesFromGroup = null;
    private ?Messages\Edit $edit = null;
    private ?Messages\EditChat $editChat = null;
    private ?Messages\GetByConversationMessageId $getByConversationMessageId = null;
    private ?Messages\GetById $getById = null;
    private ?Messages\GetChatPreview $getChatPreview = null;
    private ?Messages\GetConversationMembers $getConversationMembers = null;
    private ?Messages\GetConversations $getConversations = null;
    private ?Messages\GetConversationsById $getConversationsById = null;
    private ?Messages\GetHistory $getHistory = null;
    private ?Messages\GetHistoryAttachments $getHistoryAttachments = null;
    private ?Messages\GetInviteLink $getInviteLink = null;
    private ?Messages\GetLastActivity $getLastActivity = null;
    private ?Messages\GetLongPollHistory $getLongPollHistory = null;
    private ?Messages\GetLongPollServer $getLongPollServer = null;
    private ?Messages\IsMessagesFromGroupAllowed $isMessagesFromGroupAllowed = null;
    private ?Messages\JoinChatByInviteLink $joinChatByInviteLink = null;
    private ?Messages\MarkAsAnsweredConversation $markAsAnsweredConversation = null;
    private ?Messages\MarkAsImportant $markAsImportant = null;
    private ?Messages\MarkAsImportantConversation $markAsImportantConversation = null;
    private ?Messages\MarkAsRead $markAsRead = null;
    private ?Messages\Pin $pin = null;
    private ?Messages\RemoveChatUser $removeChatUser = null;
    private ?Messages\Restore $restore = null;
    private ?Messages\Search $search = null;
    private ?Messages\SearchConversations $searchConversations = null;
    private ?Messages\Send $send = null;
    private ?Messages\SendMessageEventAnswer $sendMessageEventAnswer = null;
    private ?Messages\SetActivity $setActivity = null;
    private ?Messages\SetChatPhoto $setChatPhoto = null;
    private ?Messages\Unpin $unpin = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Adds a new user to a chat.
     */
    public function addChatUser(): AddChatUser
    {
        if (!$this->addChatUser) {
            $this->addChatUser = new AddChatUser($this->_provider);
        }
        return $this->addChatUser;
    }

    /**
     * Allows sending messages from community to the current user.
     */
    public function allowMessagesFromGroup(): AllowMessagesFromGroup
    {
        if (!$this->allowMessagesFromGroup) {
            $this->allowMessagesFromGroup = new AllowMessagesFromGroup($this->_provider);
        }
        return $this->allowMessagesFromGroup;
    }

    /**
     * Creates a chat with several participants.
     */
    public function createChat(): CreateChat
    {
        if (!$this->createChat) {
            $this->createChat = new CreateChat($this->_provider);
        }
        return $this->createChat;
    }

    /**
     * Deletes one or more messages.
     */
    public function delete(): Delete
    {
        if (!$this->delete) {
            $this->delete = new Delete($this->_provider);
        }
        return $this->delete;
    }

    /**
     * Deletes a chat's cover picture.
     */
    public function deleteChatPhoto(): DeleteChatPhoto
    {
        if (!$this->deleteChatPhoto) {
            $this->deleteChatPhoto = new DeleteChatPhoto($this->_provider);
        }
        return $this->deleteChatPhoto;
    }

    /**
     * Deletes all private messages in a conversation.
     */
    public function deleteConversation(): DeleteConversation
    {
        if (!$this->deleteConversation) {
            $this->deleteConversation = new DeleteConversation($this->_provider);
        }
        return $this->deleteConversation;
    }

    /**
     * Denies sending message from community to the current user.
     */
    public function denyMessagesFromGroup(): DenyMessagesFromGroup
    {
        if (!$this->denyMessagesFromGroup) {
            $this->denyMessagesFromGroup = new DenyMessagesFromGroup($this->_provider);
        }
        return $this->denyMessagesFromGroup;
    }

    /**
     * Edits the message.
     */
    public function edit(): Edit
    {
        if (!$this->edit) {
            $this->edit = new Edit($this->_provider);
        }
        return $this->edit;
    }

    /**
     * Edits the title of a chat.
     */
    public function editChat(): EditChat
    {
        if (!$this->editChat) {
            $this->editChat = new EditChat($this->_provider);
        }
        return $this->editChat;
    }

    /**
     * Returns messages by their IDs within the conversation.
     */
    public function getByConversationMessageId(): GetByConversationMessageId
    {
        if (!$this->getByConversationMessageId) {
            $this->getByConversationMessageId = new GetByConversationMessageId($this->_provider);
        }
        return $this->getByConversationMessageId;
    }

    /**
     * Returns messages by their IDs.
     */
    public function getById(): GetById
    {
        if (!$this->getById) {
            $this->getById = new GetById($this->_provider);
        }
        return $this->getById;
    }

    /**
     * 
     */
    public function getChatPreview(): GetChatPreview
    {
        if (!$this->getChatPreview) {
            $this->getChatPreview = new GetChatPreview($this->_provider);
        }
        return $this->getChatPreview;
    }

    /**
     * Returns a list of IDs of users participating in a chat.
     */
    public function getConversationMembers(): GetConversationMembers
    {
        if (!$this->getConversationMembers) {
            $this->getConversationMembers = new GetConversationMembers($this->_provider);
        }
        return $this->getConversationMembers;
    }

    /**
     * Returns a list of the current user's conversations.
     */
    public function getConversations(): GetConversations
    {
        if (!$this->getConversations) {
            $this->getConversations = new GetConversations($this->_provider);
        }
        return $this->getConversations;
    }

    /**
     * Returns conversations by their IDs
     */
    public function getConversationsById(): GetConversationsById
    {
        if (!$this->getConversationsById) {
            $this->getConversationsById = new GetConversationsById($this->_provider);
        }
        return $this->getConversationsById;
    }

    /**
     * Returns message history for the specified user or group chat.
     */
    public function getHistory(): GetHistory
    {
        if (!$this->getHistory) {
            $this->getHistory = new GetHistory($this->_provider);
        }
        return $this->getHistory;
    }

    /**
     * Returns media files from the dialog or group chat.
     */
    public function getHistoryAttachments(): GetHistoryAttachments
    {
        if (!$this->getHistoryAttachments) {
            $this->getHistoryAttachments = new GetHistoryAttachments($this->_provider);
        }
        return $this->getHistoryAttachments;
    }

    /**
     * 
     */
    public function getInviteLink(): GetInviteLink
    {
        if (!$this->getInviteLink) {
            $this->getInviteLink = new GetInviteLink($this->_provider);
        }
        return $this->getInviteLink;
    }

    /**
     * Returns a user's current status and date of last activity.
     */
    public function getLastActivity(): GetLastActivity
    {
        if (!$this->getLastActivity) {
            $this->getLastActivity = new GetLastActivity($this->_provider);
        }
        return $this->getLastActivity;
    }

    /**
     * Returns updates in user's private messages.
     */
    public function getLongPollHistory(): GetLongPollHistory
    {
        if (!$this->getLongPollHistory) {
            $this->getLongPollHistory = new GetLongPollHistory($this->_provider);
        }
        return $this->getLongPollHistory;
    }

    /**
     * Returns data required for connection to a Long Poll server.
     */
    public function getLongPollServer(): GetLongPollServer
    {
        if (!$this->getLongPollServer) {
            $this->getLongPollServer = new GetLongPollServer($this->_provider);
        }
        return $this->getLongPollServer;
    }

    /**
     * Returns information whether sending messages from the community to current user is allowed.
     */
    public function isMessagesFromGroupAllowed(): IsMessagesFromGroupAllowed
    {
        if (!$this->isMessagesFromGroupAllowed) {
            $this->isMessagesFromGroupAllowed = new IsMessagesFromGroupAllowed($this->_provider);
        }
        return $this->isMessagesFromGroupAllowed;
    }

    /**
     * 
     */
    public function joinChatByInviteLink(): JoinChatByInviteLink
    {
        if (!$this->joinChatByInviteLink) {
            $this->joinChatByInviteLink = new JoinChatByInviteLink($this->_provider);
        }
        return $this->joinChatByInviteLink;
    }

    /**
     * Marks and unmarks conversations as unanswered.
     */
    public function markAsAnsweredConversation(): MarkAsAnsweredConversation
    {
        if (!$this->markAsAnsweredConversation) {
            $this->markAsAnsweredConversation = new MarkAsAnsweredConversation($this->_provider);
        }
        return $this->markAsAnsweredConversation;
    }

    /**
     * Marks and unmarks messages as important (starred).
     */
    public function markAsImportant(): MarkAsImportant
    {
        if (!$this->markAsImportant) {
            $this->markAsImportant = new MarkAsImportant($this->_provider);
        }
        return $this->markAsImportant;
    }

    /**
     * Marks and unmarks conversations as important.
     */
    public function markAsImportantConversation(): MarkAsImportantConversation
    {
        if (!$this->markAsImportantConversation) {
            $this->markAsImportantConversation = new MarkAsImportantConversation($this->_provider);
        }
        return $this->markAsImportantConversation;
    }

    /**
     * Marks messages as read.
     */
    public function markAsRead(): MarkAsRead
    {
        if (!$this->markAsRead) {
            $this->markAsRead = new MarkAsRead($this->_provider);
        }
        return $this->markAsRead;
    }

    /**
     * Pin a message.
     */
    public function pin(): Pin
    {
        if (!$this->pin) {
            $this->pin = new Pin($this->_provider);
        }
        return $this->pin;
    }

    /**
     * Allows the current user to leave a chat or, if the current user started the chat, allows the user to remove another user from the chat.
     */
    public function removeChatUser(): RemoveChatUser
    {
        if (!$this->removeChatUser) {
            $this->removeChatUser = new RemoveChatUser($this->_provider);
        }
        return $this->removeChatUser;
    }

    /**
     * Restores a deleted message.
     */
    public function restore(): Restore
    {
        if (!$this->restore) {
            $this->restore = new Restore($this->_provider);
        }
        return $this->restore;
    }

    /**
     * Returns a list of the current user's private messages that match search criteria.
     */
    public function search(): Search
    {
        if (!$this->search) {
            $this->search = new Search($this->_provider);
        }
        return $this->search;
    }

    /**
     * Returns a list of the current user's conversations that match search criteria.
     */
    public function searchConversations(): SearchConversations
    {
        if (!$this->searchConversations) {
            $this->searchConversations = new SearchConversations($this->_provider);
        }
        return $this->searchConversations;
    }

    /**
     * Sends a message.
     */
    public function send(): Send
    {
        if (!$this->send) {
            $this->send = new Send($this->_provider);
        }
        return $this->send;
    }

    /**
     * 
     */
    public function sendMessageEventAnswer(): SendMessageEventAnswer
    {
        if (!$this->sendMessageEventAnswer) {
            $this->sendMessageEventAnswer = new SendMessageEventAnswer($this->_provider);
        }
        return $this->sendMessageEventAnswer;
    }

    /**
     * Changes the status of a user as typing in a conversation.
     */
    public function setActivity(): SetActivity
    {
        if (!$this->setActivity) {
            $this->setActivity = new SetActivity($this->_provider);
        }
        return $this->setActivity;
    }

    /**
     * Sets a previously-uploaded picture as the cover picture of a chat.
     */
    public function setChatPhoto(): SetChatPhoto
    {
        if (!$this->setChatPhoto) {
            $this->setChatPhoto = new SetChatPhoto($this->_provider);
        }
        return $this->setChatPhoto;
    }

    /**
     * 
     */
    public function unpin(): Unpin
    {
        if (!$this->unpin) {
            $this->unpin = new Unpin($this->_provider);
        }
        return $this->unpin;
    }

}