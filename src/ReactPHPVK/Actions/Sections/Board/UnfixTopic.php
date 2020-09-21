<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Unpins a pinned topic from the top of a community's discussion board.
 */
class UnfixTopic
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
     * @return UnfixTopic
     */
    public function _setCustom(array $value): UnfixTopic
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return UnfixTopic
     */
    public function setGroupId(int $value): UnfixTopic
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Topic ID.
     * 
     * @param int $value
     * @return UnfixTopic
     */
    public function setTopicId(int $value): UnfixTopic
    {
        $this->topicId = $value;
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
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('board.unfixTopic', $params);
    }
}