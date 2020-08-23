<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Messages
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Adds a new user to a chat.
     * 
     * @param int $chatId Chat ID.
     * @param int|null $userId ID of the user to be added to the chat.
     * @param int|null $visibleMessagesCount
     * @param array|null $custom
     * @return Promise
     */
    function addChatUser(int $chatId, ?int $userId = 0, ?int $visibleMessagesCount = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['chat_id'] = $chatId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($visibleMessagesCount !== 0 && $visibleMessagesCount != null) $sendParams['visible_messages_count'] = $visibleMessagesCount;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.addChatUser', $sendParams);
    }

    /**
     * Allows sending messages from community to the current user.
     * 
     * @param int $groupId Group ID.
     * @param string|null $key
     * @param array|null $custom
     * @return Promise
     */
    function allowMessagesFromGroup(int $groupId, ?string $key = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($key !== '' && $key != null) $sendParams['key'] = $key;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.allowMessagesFromGroup', $sendParams);
    }

    /**
     * Creates a chat with several participants.
     * 
     * @param array|null $userIds IDs of the users to be added to the chat.
     * @param string|null $title Chat title.
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function createChat(?array $userIds = [], ?string $title = '', ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.createChat', $sendParams);
    }

    /**
     * Deletes one or more messages.
     * 
     * @param array|null $messageIds Message IDs.
     * @param bool|null $spam '1' — to mark message as spam.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param bool|null $deleteForAll '1' — delete message for for all.
     * @param array|null $custom
     * @return Promise
     */
    function delete(?array $messageIds = [], ?bool $spam = false, ?int $groupId = 0, ?bool $deleteForAll = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($messageIds !== [] && $messageIds != null) $sendParams['message_ids'] = implode(',', $messageIds);
        if ($spam !== false && $spam != null) $sendParams['spam'] = intval($spam);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($deleteForAll !== false && $deleteForAll != null) $sendParams['delete_for_all'] = intval($deleteForAll);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.delete', $sendParams);
    }

    /**
     * Deletes a chat's cover picture.
     * 
     * @param int $chatId Chat ID.
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function deleteChatPhoto(int $chatId, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['chat_id'] = $chatId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.deleteChatPhoto', $sendParams);
    }

    /**
     * Deletes all private messages in a conversation.
     * 
     * @param int|null $userId User ID. To clear a chat history use 'chat_id'
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param array|null $custom
     * @return Promise
     */
    function deleteConversation(?int $userId = 0, ?int $peerId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.deleteConversation', $sendParams);
    }

    /**
     * Denies sending message from community to the current user.
     * 
     * @param int $groupId Group ID.
     * @param array|null $custom
     * @return Promise
     */
    function denyMessagesFromGroup(int $groupId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.denyMessagesFromGroup', $sendParams);
    }

    /**
     * Edits the message.
     * 
     * @param int $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param string|null $message (Required if 'attachments' is not set.) Text of the message.
     * @param float|null $lat Geographical latitude of a check-in, in degrees (from -90 to 90).
     * @param float|null $long Geographical longitude of a check-in, in degrees (from -180 to 180).
     * @param string|null $attachment (Required if 'message' is not set.) List of objects attached to the message, separated by commas, in the following format: "<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'wall' — wall post, '<owner_id>' — ID of the media attachment owner. '<media_id>' — media attachment ID. Example: "photo100172_166443618"
     * @param bool|null $keepForwardMessages '1' — to keep forwarded, messages.
     * @param bool|null $keepSnippets '1' — to keep attached snippets.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param bool|null $dontParseLinks
     * @param int|null $messageId
     * @param int|null $conversationMessageId
     * @param string|null $template
     * @param string|null $keyboard
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $peerId, ?string $message = '', ?float $lat = 0, ?float $long = 0, ?string $attachment = '', ?bool $keepForwardMessages = false, ?bool $keepSnippets = false, ?int $groupId = 0, ?bool $dontParseLinks = false, ?int $messageId = 0, ?int $conversationMessageId = 0, ?string $template = '', ?string $keyboard = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($attachment !== '' && $attachment != null) $sendParams['attachment'] = $attachment;
        if ($keepForwardMessages !== false && $keepForwardMessages != null) $sendParams['keep_forward_messages'] = intval($keepForwardMessages);
        if ($keepSnippets !== false && $keepSnippets != null) $sendParams['keep_snippets'] = intval($keepSnippets);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($dontParseLinks !== false && $dontParseLinks != null) $sendParams['dont_parse_links'] = intval($dontParseLinks);
        if ($messageId !== 0 && $messageId != null) $sendParams['message_id'] = $messageId;
        if ($conversationMessageId !== 0 && $conversationMessageId != null) $sendParams['conversation_message_id'] = $conversationMessageId;
        if ($template !== '' && $template != null) $sendParams['template'] = $template;
        if ($keyboard !== '' && $keyboard != null) $sendParams['keyboard'] = $keyboard;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.edit', $sendParams);
    }

    /**
     * Edits the title of a chat.
     * 
     * @param int $chatId Chat ID.
     * @param string|null $title New title of the chat.
     * @param array|null $custom
     * @return Promise
     */
    function editChat(int $chatId, ?string $title = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['chat_id'] = $chatId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.editChat', $sendParams);
    }

    /**
     * Returns messages by their IDs within the conversation.
     * 
     * @param int $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param array $conversationMessageIds Conversation message IDs.
     * @param bool|null $extended Information whether the response should be extended
     * @param array|null $fields Profile fields to return.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function getByConversationMessageId(int $peerId, array $conversationMessageIds, ?bool $extended = false, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        $sendParams['conversation_message_ids'] = implode(',', $conversationMessageIds);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getByConversationMessageId', $sendParams);
    }

    /**
     * Returns messages by their IDs.
     * 
     * @param array $messageIds Message IDs.
     * @param int|null $previewLength Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
     * @param bool|null $extended Information whether the response should be extended
     * @param array|null $fields Profile fields to return.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function getById(array $messageIds, ?int $previewLength = 0, ?bool $extended = false, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['message_ids'] = implode(',', $messageIds);
        if ($previewLength !== 0 && $previewLength != null) $sendParams['preview_length'] = $previewLength;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getById', $sendParams);
    }

    /**
     * messages.getChatPreview
     * 
     * @param int|null $peerId
     * @param string|null $link Invitation link.
     * @param array|null $fields Profile fields to return.
     * @param array|null $custom
     * @return Promise
     */
    function getChatPreview(?int $peerId = 0, ?string $link = '', ?array $fields = [], ?array $custom = [])
    {
        $sendParams = [];

        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($link !== '' && $link != null) $sendParams['link'] = $link;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getChatPreview', $sendParams);
    }

    /**
     * Returns a list of IDs of users participating in a chat.
     * 
     * @param int $peerId Peer ID.
     * @param array|null $fields Profile fields to return.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function getConversationMembers(int $peerId, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getConversationMembers', $sendParams);
    }

    /**
     * Returns a list of the current user's conversations.
     * 
     * @param int|null $offset Offset needed to return a specific subset of conversations.
     * @param int|null $count Number of conversations to return.
     * @param string|null $filter Filter to apply: 'all' — all conversations, 'unread' — conversations with unread messages, 'important' — conversations, marked as important (only for community messages), 'unanswered' — conversations, marked as unanswered (only for community messages)
     * @param bool|null $extended '1' — return extra information about users and communities
     * @param int|null $startMessageId ID of the message from what to return dialogs.
     * @param array|null $fields Profile and communities fields to return.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function getConversations(?int $offset = 0, ?int $count = 20, ?string $filter = 'all', ?bool $extended = false, ?int $startMessageId = 0, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($filter !== 'all' && $filter != null) $sendParams['filter'] = $filter;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($startMessageId !== 0 && $startMessageId != null) $sendParams['start_message_id'] = $startMessageId;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getConversations', $sendParams);
    }

    /**
     * Returns conversations by their IDs
     * 
     * @param array $peerIds Destination IDs. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param bool|null $extended Return extended properties
     * @param array|null $fields Profile and communities fields to return.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function getConversationsById(array $peerIds, ?bool $extended = false, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_ids'] = implode(',', $peerIds);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getConversationsById', $sendParams);
    }

    /**
     * Returns message history for the specified user or group chat.
     * 
     * @param int|null $offset Offset needed to return a specific subset of messages.
     * @param int|null $count Number of messages to return.
     * @param int|null $userId ID of the user whose message history you want to return.
     * @param int|null $peerId
     * @param int|null $startMessageId Starting message ID from which to return history.
     * @param int|null $rev Sort order: '1' — return messages in chronological order. '0' — return messages in reverse chronological order.
     * @param bool|null $extended Information whether the response should be extended
     * @param array|null $fields Profile fields to return.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function getHistory(?int $offset = 0, ?int $count = 20, ?int $userId = 0, ?int $peerId = 0, ?int $startMessageId = 0, ?int $rev = 0, ?bool $extended = false, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($startMessageId !== 0 && $startMessageId != null) $sendParams['start_message_id'] = $startMessageId;
        if ($rev !== 0 && $rev != null) $sendParams['rev'] = $rev;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getHistory', $sendParams);
    }

    /**
     * Returns media files from the dialog or group chat.
     * 
     * @param int $peerId Peer ID. ", For group chat: '2000000000 + chat ID' , , For community: '-community ID'"
     * @param string|null $mediaType Type of media files to return: *'photo',, *'video',, *'audio',, *'doc',, *'link'.,*'market'.,*'wall'.,*'share'
     * @param string|null $startFrom Message ID to start return results from.
     * @param int|null $count Number of objects to return.
     * @param bool|null $photoSizes '1' — to return photo sizes in a
     * @param array|null $fields Additional profile [vk.com/dev/fields|fields] to return. 
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param bool|null $preserveOrder
     * @param int|null $maxForwardsLevel
     * @param array|null $custom
     * @return Promise
     */
    function getHistoryAttachments(int $peerId, ?string $mediaType = 'photo', ?string $startFrom = '', ?int $count = 30, ?bool $photoSizes = false, ?array $fields = [], ?int $groupId = 0, ?bool $preserveOrder = false, ?int $maxForwardsLevel = 45, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($mediaType !== 'photo' && $mediaType != null) $sendParams['media_type'] = $mediaType;
        if ($startFrom !== '' && $startFrom != null) $sendParams['start_from'] = $startFrom;
        if ($count !== 30 && $count != null) $sendParams['count'] = $count;
        if ($photoSizes !== false && $photoSizes != null) $sendParams['photo_sizes'] = intval($photoSizes);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($preserveOrder !== false && $preserveOrder != null) $sendParams['preserve_order'] = intval($preserveOrder);
        if ($maxForwardsLevel !== 45 && $maxForwardsLevel != null) $sendParams['max_forwards_level'] = $maxForwardsLevel;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getHistoryAttachments', $sendParams);
    }

    /**
     * messages.getInviteLink
     * 
     * @param int $peerId Destination ID.
     * @param bool|null $reset 1 — to generate new link (revoke previous), 0 — to return previous link.
     * @param int|null $groupId Group ID
     * @param array|null $custom
     * @return Promise
     */
    function getInviteLink(int $peerId, ?bool $reset = false, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($reset !== false && $reset != null) $sendParams['reset'] = intval($reset);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getInviteLink', $sendParams);
    }

    /**
     * Returns a user's current status and date of last activity.
     * 
     * @param int $userId User ID.
     * @param array|null $custom
     * @return Promise
     */
    function getLastActivity(int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getLastActivity', $sendParams);
    }

    /**
     * Returns updates in user's private messages.
     * 
     * @param int|null $ts Last value of the 'ts' parameter returned from the Long Poll server or by using [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
     * @param int|null $pts Lsat value of 'pts' parameter returned from the Long Poll server or by using [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
     * @param int|null $previewLength Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
     * @param bool|null $onlines '1' — to return history with online users only.
     * @param array|null $fields Additional profile [vk.com/dev/fields|fields] to return.
     * @param int|null $eventsLimit Maximum number of events to return.
     * @param int|null $msgsLimit Maximum number of messages to return.
     * @param int|null $maxMsgId Maximum ID of the message among existing ones in the local copy. Both messages received with API methods (for example, , ), and data received from a Long Poll server (events with code 4) are taken into account.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param int|null $lpVersion
     * @param int|null $lastN
     * @param bool|null $credentials
     * @param array|null $custom
     * @return Promise
     */
    function getLongPollHistory(?int $ts = 0, ?int $pts = 0, ?int $previewLength = 0, ?bool $onlines = false, ?array $fields = [], ?int $eventsLimit = 1000, ?int $msgsLimit = 200, ?int $maxMsgId = 0, ?int $groupId = 0, ?int $lpVersion = 0, ?int $lastN = 0, ?bool $credentials = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($ts !== 0 && $ts != null) $sendParams['ts'] = $ts;
        if ($pts !== 0 && $pts != null) $sendParams['pts'] = $pts;
        if ($previewLength !== 0 && $previewLength != null) $sendParams['preview_length'] = $previewLength;
        if ($onlines !== false && $onlines != null) $sendParams['onlines'] = intval($onlines);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($eventsLimit !== 1000 && $eventsLimit != null) $sendParams['events_limit'] = $eventsLimit;
        if ($msgsLimit !== 200 && $msgsLimit != null) $sendParams['msgs_limit'] = $msgsLimit;
        if ($maxMsgId !== 0 && $maxMsgId != null) $sendParams['max_msg_id'] = $maxMsgId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($lpVersion !== 0 && $lpVersion != null) $sendParams['lp_version'] = $lpVersion;
        if ($lastN !== 0 && $lastN != null) $sendParams['last_n'] = $lastN;
        if ($credentials !== false && $credentials != null) $sendParams['credentials'] = intval($credentials);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getLongPollHistory', $sendParams);
    }

    /**
     * Returns data required for connection to a Long Poll server.
     * 
     * @param bool|null $needPts '1' — to return the 'pts' field, needed for the [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param int|null $lpVersion Long poll version
     * @param array|null $custom
     * @return Promise
     */
    function getLongPollServer(?bool $needPts = false, ?int $groupId = 0, ?int $lpVersion = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($needPts !== false && $needPts != null) $sendParams['need_pts'] = intval($needPts);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($lpVersion !== 0 && $lpVersion != null) $sendParams['lp_version'] = $lpVersion;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.getLongPollServer', $sendParams);
    }

    /**
     * Returns information whether sending messages from the community to current user is allowed.
     * 
     * @param int $groupId Group ID.
     * @param int $userId User ID.
     * @param array|null $custom
     * @return Promise
     */
    function isMessagesFromGroupAllowed(int $groupId, int $userId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['user_id'] = $userId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.isMessagesFromGroupAllowed', $sendParams);
    }

    /**
     * messages.joinChatByInviteLink
     * 
     * @param string $link Invitation link.
     * @param array|null $custom
     * @return Promise
     */
    function joinChatByInviteLink(string $link, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['link'] = $link;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.joinChatByInviteLink', $sendParams);
    }

    /**
     * Marks and unmarks conversations as unanswered.
     * 
     * @param int $peerId ID of conversation to mark as important.
     * @param bool|null $answered '1' — to mark as answered, '0' — to remove the mark
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function markAsAnsweredConversation(int $peerId, ?bool $answered = true, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($answered !== true && $answered != null) $sendParams['answered'] = intval($answered);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.markAsAnsweredConversation', $sendParams);
    }

    /**
     * Marks and unmarks messages as important (starred).
     * 
     * @param array|null $messageIds IDs of messages to mark as important.
     * @param int|null $important '1' — to add a star (mark as important), '0' — to remove the star
     * @param array|null $custom
     * @return Promise
     */
    function markAsImportant(?array $messageIds = [], ?int $important = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($messageIds !== [] && $messageIds != null) $sendParams['message_ids'] = implode(',', $messageIds);
        if ($important !== 0 && $important != null) $sendParams['important'] = $important;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.markAsImportant', $sendParams);
    }

    /**
     * Marks and unmarks conversations as important.
     * 
     * @param int $peerId ID of conversation to mark as important.
     * @param bool|null $important '1' — to add a star (mark as important), '0' — to remove the star
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function markAsImportantConversation(int $peerId, ?bool $important = true, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($important !== true && $important != null) $sendParams['important'] = intval($important);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.markAsImportantConversation', $sendParams);
    }

    /**
     * Marks messages as read.
     * 
     * @param array|null $messageIds IDs of messages to mark as read.
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param int|null $startMessageId Message ID to start from.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param bool|null $markConversationAsRead
     * @param array|null $custom
     * @return Promise
     */
    function markAsRead(?array $messageIds = [], ?int $peerId = 0, ?int $startMessageId = 0, ?int $groupId = 0, ?bool $markConversationAsRead = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($messageIds !== [] && $messageIds != null) $sendParams['message_ids'] = implode(',', $messageIds);
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($startMessageId !== 0 && $startMessageId != null) $sendParams['start_message_id'] = $startMessageId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($markConversationAsRead !== false && $markConversationAsRead != null) $sendParams['mark_conversation_as_read'] = intval($markConversationAsRead);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.markAsRead', $sendParams);
    }

    /**
     * Pin a message.
     * 
     * @param int $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * @param int|null $messageId
     * @param array|null $custom
     * @return Promise
     */
    function pin(int $peerId, ?int $messageId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($messageId !== 0 && $messageId != null) $sendParams['message_id'] = $messageId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.pin', $sendParams);
    }

    /**
     * Allows the current user to leave a chat or, if the current user started the chat, allows the user to remove another user from the chat.
     * 
     * @param int $chatId Chat ID.
     * @param int|null $userId ID of the user to be removed from the chat.
     * @param int|null $memberId
     * @param array|null $custom
     * @return Promise
     */
    function removeChatUser(int $chatId, ?int $userId = 0, ?int $memberId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['chat_id'] = $chatId;
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($memberId !== 0 && $memberId != null) $sendParams['member_id'] = $memberId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.removeChatUser', $sendParams);
    }

    /**
     * Restores a deleted message.
     * 
     * @param int $messageId ID of a previously-deleted message to restore.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param array|null $custom
     * @return Promise
     */
    function restore(int $messageId, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['message_id'] = $messageId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.restore', $sendParams);
    }

    /**
     * Returns a list of the current user's private messages that match search criteria.
     * 
     * @param string|null $q Search query string.
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param int|null $date Date to search message before in Unixtime.
     * @param int|null $previewLength Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
     * @param int|null $offset Offset needed to return a specific subset of messages.
     * @param int|null $count Number of messages to return.
     * @param bool|null $extended
     * @param array|null $fields
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function search(?string $q = '', ?int $peerId = 0, ?int $date = 0, ?int $previewLength = 0, ?int $offset = 0, ?int $count = 20, ?bool $extended = false, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($date !== 0 && $date != null) $sendParams['date'] = $date;
        if ($previewLength !== 0 && $previewLength != null) $sendParams['preview_length'] = $previewLength;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.search', $sendParams);
    }

    /**
     * Returns a list of the current user's conversations that match search criteria.
     * 
     * @param string|null $q Search query string.
     * @param int|null $count Maximum number of results.
     * @param bool|null $extended '1' — return extra information about users and communities
     * @param array|null $fields Profile fields to return.
     * @param int|null $groupId Group ID (for group messages with user access token)
     * @param array|null $custom
     * @return Promise
     */
    function searchConversations(?string $q = '', ?int $count = 20, ?bool $extended = false, ?array $fields = [], ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($q !== '' && $q != null) $sendParams[''] = $q;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.searchConversations', $sendParams);
    }

    /**
     * Sends a message.
     * 
     * @param int|null $userId User ID (by default — current user).
     * @param int|null $randomId Unique identifier to avoid resending the message.
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param string|null $domain User's short address (for example, 'illarionov').
     * @param int|null $chatId ID of conversation the message will relate to.
     * @param array|null $userIds IDs of message recipients (if new conversation shall be started).
     * @param string|null $message (Required if 'attachments' is not set.) Text of the message.
     * @param float|null $lat Geographical latitude of a check-in, in degrees (from -90 to 90).
     * @param float|null $long Geographical longitude of a check-in, in degrees (from -180 to 180).
     * @param string|null $attachment (Required if 'message' is not set.) List of objects attached to the message, separated by commas, in the following format: "<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'wall' — wall post, '<owner_id>' — ID of the media attachment owner. '<media_id>' — media attachment ID. Example: "photo100172_166443618"
     * @param int|null $replyTo
     * @param array|null $forwardMessages ID of forwarded messages, separated with a comma. Listed messages of the sender will be shown in the message body at the recipient's. Example: "123,431,544"
     * @param int|null $stickerId Sticker id.
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param string|null $keyboard
     * @param string|null $payload
     * @param bool|null $dontParseLinks
     * @param bool|null $disableMentions
     * @param string|null $intent
     * @param int|null $subscribeId
     * @param array|null $custom
     * @return Promise
     */
    function send(?int $userId = 0, ?int $randomId = 0, ?int $peerId = 0, ?string $domain = '', ?int $chatId = 0, ?array $userIds = [], ?string $message = '', ?float $lat = 0, ?float $long = 0, ?string $attachment = '', ?int $replyTo = 0, ?array $forwardMessages = [], ?int $stickerId = 0, ?int $groupId = 0, ?string $keyboard = '', ?string $payload = '', ?bool $dontParseLinks = false, ?bool $disableMentions = false, ?string $intent = 'default', ?int $subscribeId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($randomId !== 0 && $randomId != null) $sendParams['random_id'] = $randomId;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($domain !== '' && $domain != null) $sendParams['domain'] = $domain;
        if ($chatId !== 0 && $chatId != null) $sendParams['chat_id'] = $chatId;
        if ($userIds !== [] && $userIds != null) $sendParams['user_ids'] = implode(',', $userIds);
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($lat !== 0 && $lat != null) $sendParams['lat'] = $lat;
        if ($long !== 0 && $long != null) $sendParams['long'] = $long;
        if ($attachment !== '' && $attachment != null) $sendParams['attachment'] = $attachment;
        if ($replyTo !== 0 && $replyTo != null) $sendParams['reply_to'] = $replyTo;
        if ($forwardMessages !== [] && $forwardMessages != null) $sendParams['forward_messages'] = implode(',', $forwardMessages);
        if ($stickerId !== 0 && $stickerId != null) $sendParams['sticker_id'] = $stickerId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;
        if ($keyboard !== '' && $keyboard != null) $sendParams['keyboard'] = $keyboard;
        if ($payload !== '' && $payload != null) $sendParams['payload'] = $payload;
        if ($dontParseLinks !== false && $dontParseLinks != null) $sendParams['dont_parse_links'] = intval($dontParseLinks);
        if ($disableMentions !== false && $disableMentions != null) $sendParams['disable_mentions'] = intval($disableMentions);
        if ($intent !== 'default' && $intent != null) $sendParams['intent'] = $intent;
        if ($subscribeId !== 0 && $subscribeId != null) $sendParams['subscribe_id'] = $subscribeId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.send', $sendParams);
    }

    /**
     * messages.sendMessageEventAnswer
     * 
     * @param string $eventId
     * @param int $userId
     * @param int $peerId
     * @param string|null $eventData
     * @param array|null $custom
     * @return Promise
     */
    function sendMessageEventAnswer(string $eventId, int $userId, int $peerId, ?string $eventData = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['event_id'] = $eventId;
        $sendParams['user_id'] = $userId;
        $sendParams['peer_id'] = $peerId;
        if ($eventData !== '' && $eventData != null) $sendParams['event_data'] = $eventData;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.sendMessageEventAnswer', $sendParams);
    }

    /**
     * Changes the status of a user as typing in a conversation.
     * 
     * @param int|null $userId User ID.
     * @param string|null $type 'typing' — user has started to type.
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
     * @param int|null $groupId Group ID (for group messages with group access token)
     * @param array|null $custom
     * @return Promise
     */
    function setActivity(?int $userId = 0, ?string $type = '', ?int $peerId = 0, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($type !== '' && $type != null) $sendParams['type'] = $type;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.setActivity', $sendParams);
    }

    /**
     * Sets a previously-uploaded picture as the cover picture of a chat.
     * 
     * @param string $file Upload URL from the 'response' field returned by the [vk.com/dev/photos.getChatUploadServer|photos.getChatUploadServer] method upon successfully uploading an image.
     * @param array|null $custom
     * @return Promise
     */
    function setChatPhoto(string $file, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['file'] = $file;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.setChatPhoto', $sendParams);
    }

    /**
     * messages.unpin
     * 
     * @param int $peerId
     * @param int|null $groupId
     * @param array|null $custom
     * @return Promise
     */
    function unpin(int $peerId, ?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['peer_id'] = $peerId;
        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('messages.unpin', $sendParams);
    }
}