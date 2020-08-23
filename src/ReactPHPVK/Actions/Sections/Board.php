<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Board
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Creates a new topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param string $title Topic title.
     * @param string|null $text Text of the topic.
     * @param bool|null $fromGroup For a community: '1' — to post the topic as by the community, '0' — to post the topic as by the user (default)
     * @param array|null $attachments List of media objects attached to the topic, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media object: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. Example: "photo100172_166443618,photo66748_265827614", , "NOTE: If you try to attach more than one reference, an error will be thrown.",
     * @param array|null $custom
     * @return Promise
     */
    function addTopic(int $groupId, string $title, ?string $text = '', ?bool $fromGroup = false, ?array $attachments = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['title'] = $title;
        if ($text !== '' && $text != null) $sendParams['text'] = $text;
        if ($fromGroup !== false && $fromGroup != null) $sendParams['from_group'] = intval($fromGroup);
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.addTopic', $sendParams);
    }

    /**
     * Closes a topic on a community's discussion board so that comments cannot be posted.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param array|null $custom
     * @return Promise
     */
    function closeTopic(int $groupId, int $topicId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.closeTopic', $sendParams);
    }

    /**
     * Adds a comment on a topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId ID of the topic to be commented on.
     * @param string|null $message (Required if 'attachments' is not set.) Text of the comment.
     * @param array|null $attachments (Required if 'text' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media object: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID.
     * @param bool|null $fromGroup '1' — to post the comment as by the community, '0' — to post the comment as by the user (default)
     * @param int|null $stickerId Sticker ID.
     * @param string|null $guid Unique identifier to avoid repeated comments.
     * @param array|null $custom
     * @return Promise
     */
    function createComment(int $groupId, int $topicId, ?string $message = '', ?array $attachments = [], ?bool $fromGroup = false, ?int $stickerId = 0, ?string $guid = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);
        if ($fromGroup !== false && $fromGroup != null) $sendParams['from_group'] = intval($fromGroup);
        if ($stickerId !== 0 && $stickerId != null) $sendParams['sticker_id'] = $stickerId;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.createComment', $sendParams);
    }

    /**
     * Deletes a comment on a topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param int $commentId Comment ID.
     * @param array|null $custom
     * @return Promise
     */
    function deleteComment(int $groupId, int $topicId, int $commentId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;
        $sendParams['comment_id'] = $commentId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.deleteComment', $sendParams);
    }

    /**
     * Deletes a topic from a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param array|null $custom
     * @return Promise
     */
    function deleteTopic(int $groupId, int $topicId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.deleteTopic', $sendParams);
    }

    /**
     * Edits a comment on a topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param int $commentId ID of the comment on the topic.
     * @param string|null $message (Required if 'attachments' is not set). New comment text.
     * @param array|null $attachments (Required if 'message' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media object: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. Example: "photo100172_166443618,photo66748_265827614"
     * @param array|null $custom
     * @return Promise
     */
    function editComment(int $groupId, int $topicId, int $commentId, ?string $message = '', ?array $attachments = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;
        $sendParams['comment_id'] = $commentId;
        if ($message !== '' && $message != null) $sendParams['message'] = $message;
        if ($attachments !== [] && $attachments != null) $sendParams['attachments'] = implode(',', $attachments);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.editComment', $sendParams);
    }

    /**
     * Edits the title of a topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param string $title New title of the topic.
     * @param array|null $custom
     * @return Promise
     */
    function editTopic(int $groupId, int $topicId, string $title, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;
        $sendParams['title'] = $title;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.editTopic', $sendParams);
    }

    /**
     * Pins a topic (fixes its place) to the top of a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param array|null $custom
     * @return Promise
     */
    function fixTopic(int $groupId, int $topicId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.fixTopic', $sendParams);
    }

    /**
     * Returns a list of comments on a topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param bool|null $needLikes '1' — to return the 'likes' field, '0' — not to return the 'likes' field (default)
     * @param int|null $startCommentId
     * @param int|null $offset Offset needed to return a specific subset of comments.
     * @param int|null $count Number of comments to return.
     * @param bool|null $extended '1' — to return information about users who posted comments, '0' — to return no additional fields (default)
     * @param string|null $sort Sort order: 'asc' — by creation date in chronological order, 'desc' — by creation date in reverse chronological order,
     * @param array|null $custom
     * @return Promise
     */
    function getComments(int $groupId, int $topicId, ?bool $needLikes = false, ?int $startCommentId = 0, ?int $offset = 0, ?int $count = 20, ?bool $extended = false, ?string $sort = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;
        if ($needLikes !== false && $needLikes != null) $sendParams['need_likes'] = intval($needLikes);
        if ($startCommentId !== 0 && $startCommentId != null) $sendParams['start_comment_id'] = $startCommentId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($sort !== '' && $sort != null) $sendParams['sort'] = $sort;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.getComments', $sendParams);
    }

    /**
     * Returns a list of topics on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param array|null $topicIds IDs of topics to be returned (100 maximum). By default, all topics are returned. If this parameter is set, the 'order', 'offset', and 'count' parameters are ignored.
     * @param int|null $order Sort order: '1' — by date updated in reverse chronological order. '2' — by date created in reverse chronological order. '-1' — by date updated in chronological order. '-2' — by date created in chronological order. If no sort order is specified, topics are returned in the order specified by the group administrator. Pinned topics are returned first, regardless of the sorting.
     * @param int|null $offset Offset needed to return a specific subset of topics.
     * @param int|null $count Number of topics to return.
     * @param bool|null $extended '1' — to return information about users who created topics or who posted there last, '0' — to return no additional fields (default)
     * @param int|null $preview '1' — to return the first comment in each topic,, '2' — to return the last comment in each topic,, '0' — to return no comments. By default: '0'.
     * @param int|null $previewLength Number of characters after which to truncate the previewed comment. To preview the full comment, specify '0'.
     * @param array|null $custom
     * @return Promise
     */
    function getTopics(int $groupId, ?array $topicIds = [], ?int $order = 0, ?int $offset = 0, ?int $count = 40, ?bool $extended = false, ?int $preview = 0, ?int $previewLength = 90, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        if ($topicIds !== [] && $topicIds != null) $sendParams['topic_ids'] = implode(',', $topicIds);
        if ($order !== 0 && $order != null) $sendParams['order'] = $order;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 40 && $count != null) $sendParams['count'] = $count;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($preview !== 0 && $preview != null) $sendParams['preview'] = $preview;
        if ($previewLength !== 90 && $previewLength != null) $sendParams['preview_length'] = $previewLength;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.getTopics', $sendParams);
    }

    /**
     * Re-opens a previously closed topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param array|null $custom
     * @return Promise
     */
    function openTopic(int $groupId, int $topicId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.openTopic', $sendParams);
    }

    /**
     * Restores a comment deleted from a topic on a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param int $commentId Comment ID.
     * @param array|null $custom
     * @return Promise
     */
    function restoreComment(int $groupId, int $topicId, int $commentId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;
        $sendParams['comment_id'] = $commentId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.restoreComment', $sendParams);
    }

    /**
     * Unpins a pinned topic from the top of a community's discussion board.
     * 
     * @param int $groupId ID of the community that owns the discussion board.
     * @param int $topicId Topic ID.
     * @param array|null $custom
     * @return Promise
     */
    function unfixTopic(int $groupId, int $topicId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['group_id'] = $groupId;
        $sendParams['topic_id'] = $topicId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('board.unfixTopic', $sendParams);
    }
}