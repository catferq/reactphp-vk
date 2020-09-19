<?php

namespace ReactPHPVK\Actions\Sections\Widgets;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like widget] is installed.
 */
class GetPages
{
    private Provider $_provider;
    
    private int $widgetApiId = 0;
    private string $order = 'friend_likes';
    private string $period = 'week';
    private int $offset = 0;
    private int $count = 10;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetPages
     */
    public function _setCustom(array $value): GetPages
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPages
     */
    public function setWidgetApiId(int $value): GetPages
    {
        $this->widgetApiId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetPages
     */
    public function setOrder(string $value): GetPages
    {
        $this->order = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetPages
     */
    public function setPeriod(string $value): GetPages
    {
        $this->period = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPages
     */
    public function setOffset(int $value): GetPages
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPages
     */
    public function setCount(int $value): GetPages
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->widgetApiId !== 0) $params['widget_api_id'] = $this->widgetApiId;
        if ($this->order !== 'friend_likes') $params['order'] = $this->order;
        if ($this->period !== 'week') $params['period'] = $this->period;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 10) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->widgetApiId = 0;
            $this->order = 'friend_likes';
            $this->period = 'week';
            $this->offset = 0;
            $this->count = 10;
            $this->_custom = [];
        }

        return $this->_provider->request('widgets.getPages', $params);
    }
}