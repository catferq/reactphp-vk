<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits the title of a topic on a community's discussion board.
 */
class EditTopic
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $topicId = 0;
    private string $title = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditTopic
     */
    public function _setCustom(array $value): EditTopic
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return EditTopic
     */
    public function setGroupId(int $value): EditTopic
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic ID.
     * 
     * @param int $value
     * @return EditTopic
     */
    public function setTopicId(int $value): EditTopic
    {
        $this->topicId = $value;
        return $this;
    }

    /**
     * New title of the topic.
     * 
     * @param string $value
     * @return EditTopic
     */
    public function setTitle(string $value): EditTopic
    {
        $this->title = $value;
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
        $params['topic_id'] = $this->topicId;
        $params['title'] = $this->title;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->title = '';
            $this->_custom = [];
        }

        return $this->_provider->request('board.editTopic', $params);
    }
}