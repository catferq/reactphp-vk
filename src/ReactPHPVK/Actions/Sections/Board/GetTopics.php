<?php

namespace ReactPHPVK\Actions\Sections\Board;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of topics on a community's discussion board.
 */
class GetTopics
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private array $topicIds = [];
    private int $order = 0;
    private int $offset = 0;
    private int $count = 40;
    private bool $extended = false;
    private int $preview = 0;
    private int $previewLength = 90;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTopics
     */
    public function _setCustom(array $value): GetTopics
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the community that owns the discussion board.
     * 
     * @param int $value
     * @return GetTopics
     */
    public function setGroupId(int $value): GetTopics
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * IDs of topics to be returned (100 maximum). By default, all topics are returned. If this parameter is set, the 'order', 'offset', and 'count' parameters are ignored.
     * 
     * @param array $value
     * @return GetTopics
     */
    public function setTopicIds(array $value): GetTopics
    {
        $this->topicIds = $value;
        return $this;
    }

    /**
     * Sort order: '1' — by date updated in reverse chronological order. '2' — by date created in reverse chronological order. '-1' — by date updated in chronological order. '-2' — by date created in chronological order. If no sort order is specified, topics are returned in the order specified by the group administrator. Pinned topics are returned first, regardless of the sorting.
     * 
     * @param int $value
     * @return GetTopics
     */
    public function setOrder(int $value): GetTopics
    {
        $this->order = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of topics.
     * 
     * @param int $value
     * @return GetTopics
     */
    public function setOffset(int $value): GetTopics
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of topics to return.
     * 
     * @param int $value
     * @return GetTopics
     */
    public function setCount(int $value): GetTopics
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return information about users who created topics or who posted there last, '0' — to return no additional fields (default)
     * 
     * @param bool $value
     * @return GetTopics
     */
    public function setExtended(bool $value): GetTopics
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * '1' — to return the first comment in each topic,, '2' — to return the last comment in each topic,, '0' — to return no comments. By default: '0'.
     * 
     * @param int $value
     * @return GetTopics
     */
    public function setPreview(int $value): GetTopics
    {
        $this->preview = $value;
        return $this;
    }

    /**
     * Number of characters after which to truncate the previewed comment. To preview the full comment, specify '0'.
     * 
     * @param int $value
     * @return GetTopics
     */
    public function setPreviewLength(int $value): GetTopics
    {
        $this->previewLength = $value;
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
        if ($this->topicIds !== []) $params['topic_ids'] = implode(',', $this->topicIds);
        if ($this->order !== 0) $params['order'] = $this->order;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 40) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->preview !== 0) $params['preview'] = $this->preview;
        if ($this->previewLength !== 90) $params['preview_length'] = $this->previewLength;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->topicIds = [];
            $this->order = 0;
            $this->offset = 0;
            $this->count = 40;
            $this->extended = false;
            $this->preview = 0;
            $this->previewLength = 90;
            $this->_custom = [];
        }

        return $this->_provider->request('board.getTopics', $params);
    }
}