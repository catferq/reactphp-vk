<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Docs
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Copies a document to a user's or community's document list.
     * 
     * @param int $ownerId ID of the user or community that owns the document. Use a negative value to designate a community ID.
     * @param int $docId Document ID.
     * @param string|null $accessKey Access key. This parameter is required if 'access_key' was returned with the document's data.
     * @param array|null $custom
     * @return Promise
     */
    function add(int $ownerId, int $docId, ?string $accessKey = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['doc_id'] = $docId;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.add', $sendParams);
    }

    /**
     * Deletes a user or community document.
     * 
     * @param int $ownerId ID of the user or community that owns the document. Use a negative value to designate a community ID.
     * @param int $docId Document ID.
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $ownerId, int $docId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['doc_id'] = $docId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.delete', $sendParams);
    }

    /**
     * Edits a document.
     * 
     * @param int $ownerId User ID or community ID. Use a negative value to designate a community ID.
     * @param int $docId Document ID.
     * @param string|null $title Document title.
     * @param array|null $tags Document tags.
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $ownerId, int $docId, ?string $title = '', ?array $tags = [], ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['doc_id'] = $docId;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($tags !== [] && $tags != null) $sendParams['tags'] = implode(',', $tags);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.edit', $sendParams);
    }

    /**
     * Returns detailed information about user or community documents.
     * 
     * @param int|null $count Number of documents to return. By default, all documents.
     * @param int|null $offset Offset needed to return a specific subset of documents.
     * @param int|null $type
     * @param int|null $ownerId ID of the user or community that owns the documents. Use a negative value to designate a community ID.
     * @param bool|null $returnTags
     * @param array|null $custom
     * @return Promise
     */
    function get(?int $count = 0, ?int $offset = 0, ?int $type = 0, ?int $ownerId = 0, ?bool $returnTags = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($type !== 0 && $type != null) $sendParams['type'] = $type;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($returnTags !== false && $returnTags != null) $sendParams['return_tags'] = intval($returnTags);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.get', $sendParams);
    }

    /**
     * Returns information about documents by their IDs.
     * 
     * @param array $docs Document IDs. Example: , "66748_91488,66748_91455",
     * @param bool|null $returnTags
     * @param array|null $custom
     * @return Promise
     */
    function getById(array $docs, ?bool $returnTags = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['docs'] = implode(',', $docs);
        if ($returnTags !== false && $returnTags != null) $sendParams['return_tags'] = intval($returnTags);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.getById', $sendParams);
    }

    /**
     * Returns the server address for document upload.
     * 
     * @param string|null $type Document type.
     * @param int|null $peerId Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * @param array|null $custom
     * @return Promise
     */
    function getMessagesUploadServer(?string $type = 'doc', ?int $peerId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($type !== 'doc' && $type != null) $sendParams['type'] = $type;
        if ($peerId !== 0 && $peerId != null) $sendParams['peer_id'] = $peerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.getMessagesUploadServer', $sendParams);
    }

    /**
     * Returns documents types available for current user.
     * 
     * @param int $ownerId ID of the user or community that owns the documents. Use a negative value to designate a community ID.
     * @param array|null $custom
     * @return Promise
     */
    function getTypes(int $ownerId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.getTypes', $sendParams);
    }

    /**
     * Returns the server address for document upload.
     * 
     * @param int|null $groupId Community ID (if the document will be uploaded to the community).
     * @param array|null $custom
     * @return Promise
     */
    function getUploadServer(?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.getUploadServer', $sendParams);
    }

    /**
     * Returns the server address for document upload onto a user's or community's wall.
     * 
     * @param int|null $groupId Community ID (if the document will be uploaded to the community).
     * @param array|null $custom
     * @return Promise
     */
    function getWallUploadServer(?int $groupId = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($groupId !== 0 && $groupId != null) $sendParams['group_id'] = $groupId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.getWallUploadServer', $sendParams);
    }

    /**
     * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
     * 
     * @param string $file This parameter is returned when the file is [vk.com/dev/upload_files_2|uploaded to the server].
     * @param string|null $title Document title.
     * @param string|null $tags Document tags.
     * @param bool|null $returnTags
     * @param array|null $custom
     * @return Promise
     */
    function save(string $file, ?string $title = '', ?string $tags = '', ?bool $returnTags = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['file'] = $file;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($tags !== '' && $tags != null) $sendParams['tags'] = $tags;
        if ($returnTags !== false && $returnTags != null) $sendParams['return_tags'] = intval($returnTags);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.save', $sendParams);
    }

    /**
     * Returns a list of documents matching the search criteria.
     * 
     * @param string $q Search query string.
     * @param bool|null $searchOwn
     * @param int|null $count Number of results to return.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param bool|null $returnTags
     * @param array|null $custom
     * @return Promise
     */
    function search(string $q, ?bool $searchOwn = false, ?int $count = 20, ?int $offset = 0, ?bool $returnTags = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams[''] = $q;
        if ($searchOwn !== false && $searchOwn != null) $sendParams['search_own'] = intval($searchOwn);
        if ($count !== 20 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($returnTags !== false && $returnTags != null) $sendParams['return_tags'] = intval($returnTags);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('docs.search', $sendParams);
    }
}