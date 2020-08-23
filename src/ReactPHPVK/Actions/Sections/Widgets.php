<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Widgets
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Gets a list of comments for the page added through the [vk.com/dev/Comments|Comments widget].
     * 
     * @param int|null $widgetApiId
     * @param string|null $url
     * @param string|null $pageId
     * @param string|null $order
     * @param array|null $fields
     * @param int|null $offset
     * @param int|null $count
     * @param array|null $custom
     * @return Promise
     */
    function getComments(?int $widgetApiId = 0, ?string $url = '', ?string $pageId = '', ?string $order = 'date', ?array $fields = [], ?int $offset = 0, ?int $count = 10, ?array $custom = [])
    {
        $sendParams = [];

        if ($widgetApiId !== 0 && $widgetApiId != null) $sendParams['widget_api_id'] = $widgetApiId;
        if ($url !== '' && $url != null) $sendParams['url'] = $url;
        if ($pageId !== '' && $pageId != null) $sendParams['page_id'] = $pageId;
        if ($order !== 'date' && $order != null) $sendParams['order'] = $order;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 10 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('widgets.getComments', $sendParams);
    }

    /**
     * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like widget] is installed.
     * 
     * @param int|null $widgetApiId
     * @param string|null $order
     * @param string|null $period
     * @param int|null $offset
     * @param int|null $count
     * @param array|null $custom
     * @return Promise
     */
    function getPages(?int $widgetApiId = 0, ?string $order = 'friend_likes', ?string $period = 'week', ?int $offset = 0, ?int $count = 10, ?array $custom = [])
    {
        $sendParams = [];

        if ($widgetApiId !== 0 && $widgetApiId != null) $sendParams['widget_api_id'] = $widgetApiId;
        if ($order !== 'friend_likes' && $order != null) $sendParams['order'] = $order;
        if ($period !== 'week' && $period != null) $sendParams['period'] = $period;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 10 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('widgets.getPages', $sendParams);
    }
}