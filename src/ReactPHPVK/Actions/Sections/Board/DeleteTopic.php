<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a topic from a community's discussion board.
 */
class DeleteTopic
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $topicId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteTopic
     */
    public function _setCustom(array $value): DeleteTopic
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return DeleteTopic
     */
    public function setGroupId(int $value): DeleteTopic
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic ID.
     * 
     * @param int $value
     * @return DeleteTopic
     */
    public function setTopicId(int $value): DeleteTopic
    {
        $this->topicId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['topic_id'] = $this->topicId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('board.deleteTopic', $params);
    }
}