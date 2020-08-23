<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Utils
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Checks whether a link is blocked in VK.
     * 
     * @param string $url Link to check (e.g., 'http://google.com').
     * @param array|null $custom
     * @return Promise
     */
    function checkLink(string $url, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['url'] = $url;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.checkLink', $sendParams);
    }

    /**
     * Deletes shortened link from user's list.
     * 
     * @param string $key Link key (characters after vk.cc/).
     * @param array|null $custom
     * @return Promise
     */
    function deleteFromLastShortened(string $key, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['key'] = $key;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.deleteFromLastShortened', $sendParams);
    }

    /**
     * Returns a list of user's shortened links.
     * 
     * @param int|null $count Number of links to return.
     * @param int|null $offset Offset needed to return a specific subset of links.
     * @param array|null $custom
     * @return Promise
     */
    function getLastShortenedLinks(?int $count = 10, ?int $offset = 0, ?array $custom = [])
    {
        $sendParams = [];

        if ($count !== 10 && $count != null) $sendParams['count'] = $count;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.getLastShortenedLinks', $sendParams);
    }

    /**
     * Returns stats data for shortened link.
     * 
     * @param string $key Link key (characters after vk.cc/).
     * @param string|null $source Source of scope
     * @param string|null $accessKey Access key for private link stats.
     * @param string|null $interval Interval.
     * @param int|null $intervalsCount Number of intervals to return.
     * @param bool|null $extended 1 — to return extended stats data (sex, age, geo). 0 — to return views number only.
     * @param array|null $custom
     * @return Promise
     */
    function getLinkStats(string $key, ?string $source = 'vk_cc', ?string $accessKey = '', ?string $interval = 'day', ?int $intervalsCount = 1, ?bool $extended = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['key'] = $key;
        if ($source !== 'vk_cc' && $source != null) $sendParams['source'] = $source;
        if ($accessKey !== '' && $accessKey != null) $sendParams['access_key'] = $accessKey;
        if ($interval !== 'day' && $interval != null) $sendParams['interval'] = $interval;
        if ($intervalsCount !== 1 && $intervalsCount != null) $sendParams['intervals_count'] = $intervalsCount;
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.getLinkStats', $sendParams);
    }

    /**
     * Returns the current time of the VK server.
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getServerTime(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.getServerTime', $sendParams);
    }

    /**
     * Allows to receive a link shortened via vk.cc.
     * 
     * @param string $url URL to be shortened.
     * @param bool|null $private 1 — private stats, 0 — public stats.
     * @param array|null $custom
     * @return Promise
     */
    function getShortLink(string $url, ?bool $private = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['url'] = $url;
        if ($private !== false && $private != null) $sendParams['private'] = intval($private);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.getShortLink', $sendParams);
    }

    /**
     * Detects a type of object (e.g., user, community, application) and its ID by screen name.
     * 
     * @param string $screenName Screen name of the user, community (e.g., 'apiclub,' 'andrew', or 'rules_of_war'), or application.
     * @param array|null $custom
     * @return Promise
     */
    function resolveScreenName(string $screenName, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['screen_name'] = $screenName;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('utils.resolveScreenName', $sendParams);
    }
}