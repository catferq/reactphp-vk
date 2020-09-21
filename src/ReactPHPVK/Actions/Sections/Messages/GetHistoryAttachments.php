<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns media files from the dialog or group chat.
 */
class GetHistoryAttachments
{
    private Provider $_provider;
    
    private int $peerId = 0;
    private string $mediaType = 'photo';
    private string $startFrom = '';
    private int $count = 30;
    private bool $photoSizes = false;
    private array $fields = [];
    private int $groupId = 0;
    private bool $preserveOrder = false;
    private int $maxForwardsLevel = 45;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetHistoryAttachments
     */
    public function _setCustom(array $value): GetHistoryAttachments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Peer ID. ", For group chat: '2000000000 + chat ID' , , For community: '-community ID'"
     * 
     * @param int $value
     * @return GetHistoryAttachments
     */
    public function setPeerId(int $value): GetHistoryAttachments
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * Type of media files to return: *'photo',, *'video',, *'audio',, *'doc',, *'link'.,*'market'.,*'wall'.,*'share'
     * 
     * @param string $value
     * @return GetHistoryAttachments
     */
    public function setMediaType(string $value): GetHistoryAttachments
    {
        $this->mediaType = $value;
        return $this;
    }

    /**
     * Message ID to start return results from.
     * 
     * @param string $value
     * @return GetHistoryAttachments
     */
    public function setStartFrom(string $value): GetHistoryAttachments
    {
        $this->startFrom = $value;
        return $this;
    }

    /**
     * Number of objects to return.
     * 
     * @param int $value
     * @return GetHistoryAttachments
     */
    public function setCount(int $value): GetHistoryAttachments
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return photo sizes in a
     * 
     * @param bool $value
     * @return GetHistoryAttachments
     */
    public function setPhotoSizes(bool $value): GetHistoryAttachments
    {
        $this->photoSizes = $value;
        return $this;
    }

    /**
     * Additional profile [vk.com/dev/fields|fields] to return. 
     * 
     * @param array $value
     * @return GetHistoryAttachments
     */
    public function setFields(array $value): GetHistoryAttachments
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * Group ID (for group messages with group access token)
     * 
     * @param int $value
     * @return GetHistoryAttachments
     */
    public function setGroupId(int $value): GetHistoryAttachments
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetHistoryAttachments
     */
    public function setPreserveOrder(bool $value): GetHistoryAttachments
    {
        $this->preserveOrder = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetHistoryAttachments
     */
    public function setMaxForwardsLevel(int $value): GetHistoryAttachments
    {
        $this->maxForwardsLevel = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['peer_id'] = $this->peerId;
        if ($this->mediaType !== 'photo') $params['media_type'] = $this->mediaType;
        if ($this->startFrom !== '') $params['start_from'] = $this->startFrom;
        if ($this->count !== 30) $params['count'] = $this->count;
        if ($this->photoSizes !== false) $params['photo_sizes'] = intval($this->photoSizes);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->preserveOrder !== false) $params['preserve_order'] = intval($this->preserveOrder);
        if ($this->maxForwardsLevel !== 45) $params['max_forwards_level'] = $this->maxForwardsLevel;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->peerId = 0;
            $this->mediaType = 'photo';
            $this->startFrom = '';
            $this->count = 30;
            $this->photoSizes = false;
            $this->fields = [];
            $this->groupId = 0;
            $this->preserveOrder = false;
            $this->maxForwardsLevel = 45;
            $this->_custom = [];
        }

        return $this->_provider->request('messages.getHistoryAttachments', $params);
    }
}