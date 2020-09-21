<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a new topic on a community's discussion board.
 */
class AddTopic
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $title = '';
    private string $text = '';
    private bool $fromGroup = false;
    private array $attachments = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddTopic
     */
    public function _setCustom(array $value): AddTopic
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return AddTopic
     */
    public function setGroupId(int $value): AddTopic
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic title.
     * 
     * @param string $value
     * @return AddTopic
     */
    public function setTitle(string $value): AddTopic
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Text of the topic.
     * 
     * @param string $value
     * @return AddTopic
     */
    public function setText(string $value): AddTopic
    {
        $this->text = $value;
        return $this;
    }

    /**
     * For a community: '1' — to post the topic as by the community, '0' — to post the topic as by the user (default)
     * 
     * @param bool $value
     * @return AddTopic
     */
    public function setFromGroup(bool $value): AddTopic
    {
        $this->fromGroup = $value;
        return $this;
    }

    /**
     * List of media objects attached to the topic, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media object: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. Example: "photo100172_166443618,photo66748_265827614", , "NOTE: If you try to attach more than one reference, an error will be thrown.",
     * 
     * @param array $value
     * @return AddTopic
     */
    public function setAttachments(array $value): AddTopic
    {
        $this->attachments = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['title'] = $this->title;
        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->fromGroup !== false) $params['from_group'] = intval($this->fromGroup);
        if ($this->attachments !== []) $params['attachments'] = implode(',', $this->attachments);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->title = '';
            $this->text = '';
            $this->fromGroup = false;
            $this->attachments = [];
            $this->_custom = [];
        }

        return $this->_provider->request('board.addTopic', $params);
    }
}