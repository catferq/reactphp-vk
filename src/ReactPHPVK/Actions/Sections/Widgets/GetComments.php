<?php

namespace ReactPHPVK\Actions\Sections\Widgets;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Gets a list of comments for the page added through the [vk.com/dev/Comments|Comments widget].
 */
class GetComments
{
    private Provider $_provider;
    
    private int $widgetApiId = 0;
    private string $url = '';
    private string $pageId = '';
    private string $order = 'date';
    private array $fields = [];
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
     * @return GetComments
     */
    public function _setCustom(array $value): GetComments
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setWidgetApiId(int $value): GetComments
    {
        $this->widgetApiId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetComments
     */
    public function setUrl(string $value): GetComments
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetComments
     */
    public function setPageId(string $value): GetComments
    {
        $this->pageId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetComments
     */
    public function setOrder(string $value): GetComments
    {
        $this->order = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetComments
     */
    public function setFields(array $value): GetComments
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setOffset(int $value): GetComments
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetComments
     */
    public function setCount(int $value): GetComments
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
        if ($this->url !== '') $params['url'] = $this->url;
        if ($this->pageId !== '') $params['page_id'] = $this->pageId;
        if ($this->order !== 'date') $params['order'] = $this->order;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 10) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->widgetApiId = 0;
            $this->url = '';
            $this->pageId = '';
            $this->order = 'date';
            $this->fields = [];
            $this->offset = 0;
            $this->count = 10;
            $this->_custom = [];
        }

        return $this->_provider->request('widgets.getComments', $params);
    }
}