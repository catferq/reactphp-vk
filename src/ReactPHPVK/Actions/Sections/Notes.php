<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Notes
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Creates a new note for the current user.
     * 
     * @param string $title Note title.
     * @param string $text Note text.
     * @param array|null $privacyView
     * @param array|null $privacyComment
     * @param array|null $custom
     * @return Promise
     */
    function add(string $title, string $text, ?array $privacyView = [], ?array $privacyComment = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['title'] = $title;
        $sendParams['text'] = $text;
        if ($privacyView !== [] && $privacyView != null) $sendParams['privacy_view'] = implode(',', $privacyView);
        if ($privacyComment !== [] && $privacyComment != null) $sendParams['privacy_comment'] = implode(',', $privacyComment);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.add', $sendParams);
    }

    /**
     * Adds a new comment on a note.
     * 
     * @param int $noteId Note ID.
     * @param string $message Comment text.
     * @param int|null $ownerId Note owner ID.
     * @param int|null $replyTo ID of the user to whom the reply is addressed (if the comment is a reply to another comment).
     * @param string|null $guid
     * @param array|null $custom
     * @return Promise
     */
    function createComment(int $noteId, string $message, ?int $ownerId = 0, ?int $replyTo = 0, ?string $guid = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['note_id'] = $noteId;
        $sendParams['message'] = $message;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($replyTo !== 0 && $replyTo != null) $sendParams['reply_to'] = $replyTo;
        if ($guid !== '' && $guid != null) $sendParams['guid'] = $guid;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.createComment', $sendParams);
    }

    /**
     * Deletes a note of the current user.
     * 
     * @param int $noteId Note ID.
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $noteId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['note_id'] = $noteId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.delete', $sendParams);
    }

    /**
     * Deletes a comment on a note.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId Note owner ID.
     * @param array|null $custom
     * @return Promise
     */
    function deleteComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.deleteComment', $sendParams);
    }

    /**
     * Edits a note of the current user.
     * 
     * @param int $noteId Note ID.
     * @param string $title Note title.
     * @param string $text Note text.
     * @param array|null $privacyView
     * @param array|null $privacyComment
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $noteId, string $title, string $text, ?array $privacyView = [], ?array $privacyComment = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['note_id'] = $noteId;
        $sendParams['title'] = $title;
        $sendParams['text'] = $text;
        if ($privacyView !== [] && $privacyView != null) $sendParams['privacy_view'] = implode(',', $privacyView);
        if ($privacyComment !== [] && $privacyComment != null) $sendParams['privacy_comment'] = implode(',', $privacyComment);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.edit', $sendParams);
    }

    /**
     * Edits a comment on a note.
     * 
     * @param int $commentId Comment ID.
     * @param string $message New comment text.
     * @param int|null $ownerId Note owner ID.
     * @param array|null $custom
     * @return Promise
     */
    function editComment(int $commentId, string $message, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        $sendParams['message'] = $message;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.editComment', $sendParams);
    }

    /**
     * Returns a list of notes created by a user.
     * 
     * @param array|null $noteIds Note IDs.
     * @param int|null $userId Note owner ID.
     * @param int|null $offset
     * @param int|null $count Number of notes to return.
     * @param int|null $sort
     * @param array|null $custom
     * @return Promise
     */
    function get(?array $noteIds = [], ?int $userId = 0, ?int $offset = 0, ?int $count = 20, ?int $sort = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($noteIds !== [] && $noteIds != null) $sendParams['note_ids'] = implode(',', $noteIds);
        if ($userId !== 0 && $userId != null) $sendParams['user_id'] = $userId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.get', $sendParams);
    }

    /**
     * Returns a note by its ID.
     * 
     * @param int $noteId Note ID.
     * @param int|null $ownerId Note owner ID.
     * @param bool|null $needWiki
     * @param array|null $custom
     * @return Promise
     */
    function getById(int $noteId, ?int $ownerId = 0, ?bool $needWiki = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['note_id'] = $noteId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($needWiki !== false && $needWiki != null) $sendParams['need_wiki'] = intval($needWiki);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.getById', $sendParams);
    }

    /**
     * Returns a list of comments on a note.
     * 
     * @param int $noteId Note ID.
     * @param int|null $ownerId Note owner ID.
     * @param int|null $sort
     * @param int|null $offset
     * @param int|null $count Number of comments to return.
     * @param array|null $custom
     * @return Promise
     */
    function getComments(int $noteId, ?int $ownerId = 0, ?int $sort = 0, ?int $offset = 0, ?int $count = 20, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['note_id'] = $noteId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($sort !== 0 && $sort != null) $sendParams['sort'] = $sort;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.getComments', $sendParams);
    }

    /**
     * Restores a deleted comment on a note.
     * 
     * @param int $commentId Comment ID.
     * @param int|null $ownerId Note owner ID.
     * @param array|null $custom
     * @return Promise
     */
    function restoreComment(int $commentId, ?int $ownerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['comment_id'] = $commentId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('notes.restoreComment', $sendParams);
    }
}