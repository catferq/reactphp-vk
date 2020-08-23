<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Leads
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Checks if the user can start the lead.
     * 
     * @param int $leadId Lead ID.
     * @param int|null $testResult Value to be return in 'result' field when test mode is used.
     * @param bool|null $testMode
     * @param bool|null $autoStart
     * @param int|null $age User age.
     * @param string|null $country User country code.
     * @param array|null $custom
     * @return Promise
     */
    function checkUser(int $leadId, ?int $testResult = 0, ?bool $testMode = false, ?bool $autoStart = false, ?int $age = 0, ?string $country = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['lead_id'] = $leadId;
        if ($testResult !== 0 && $testResult != null) $sendParams['test_result'] = $testResult;
        if ($testMode !== false && $testMode != null) $sendParams['test_mode'] = intval($testMode);
        if ($autoStart !== false && $autoStart != null) $sendParams['auto_start'] = intval($autoStart);
        if ($age !== 0 && $age != null) $sendParams['age'] = $age;
        if ($country !== '' && $country != null) $sendParams['country'] = $country;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('leads.checkUser', $sendParams);
    }

    /**
     * Completes the lead started by user.
     * 
     * @param string $vkSid Session obtained as GET parameter when session started.
     * @param string $secret Secret key from the lead testing interface.
     * @param string|null $comment Comment text.
     * @param array|null $custom
     * @return Promise
     */
    function complete(string $vkSid, string $secret, ?string $comment = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['vk_sid'] = $vkSid;
        $sendParams['secret'] = $secret;
        if ($comment !== '' && $comment != null) $sendParams['comment'] = $comment;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('leads.complete', $sendParams);
    }

    /**
     * Returns lead stats data.
     * 
     * @param int $leadId Lead ID.
     * @param string|null $secret Secret key obtained from the lead testing interface.
     * @param string|null $dateStart Day to start stats from (YYYY_MM_DD, e.g.2011-09-17).
     * @param string|null $dateEnd Day to finish stats (YYYY_MM_DD, e.g.2011-09-17).
     * @param array|null $custom
     * @return Promise
     */
    function getStats(int $leadId, ?string $secret = '', ?string $dateStart = '', ?string $dateEnd = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['lead_id'] = $leadId;
        if ($secret !== '' && $secret != null) $sendParams['secret'] = $secret;
        if ($dateStart !== '' && $dateStart != null) $sendParams['date_start'] = $dateStart;
        if ($dateEnd !== '' && $dateEnd != null) $sendParams['date_end'] = $dateEnd;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('leads.getStats', $sendParams);
    }

    /**
     * Returns a list of last user actions for the offer.
     * 
     * @param int $offerId Offer ID.
     * @param string $secret Secret key obtained in the lead testing interface.
     * @param int|null $offset Offset needed to return a specific subset of results.
     * @param int|null $count Number of results to return.
     * @param int|null $status Action type. Possible values: *'0' — start,, *'1' — finish,, *'2' — blocking users,, *'3' — start in a test mode,, *'4' — finish in a test mode.
     * @param bool|null $reverse Sort order. Possible values: *'1' — chronological,, *'0' — reverse chronological.
     * @param array|null $custom
     * @return Promise
     */
    function getUsers(int $offerId, string $secret, ?int $offset = 0, ?int $count = 100, ?int $status = 0, ?bool $reverse = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['offer_id'] = $offerId;
        $sendParams['secret'] = $secret;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 100 && $count != null) $sendParams['count'] = $count;
        if ($status !== 0 && $status != null) $sendParams['status'] = $status;
        if ($reverse !== false && $reverse != null) $sendParams['reverse'] = intval($reverse);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('leads.getUsers', $sendParams);
    }

    /**
     * Counts the metric event.
     * 
     * @param string $data Metric data obtained in the lead interface.
     * @param array|null $custom
     * @return Promise
     */
    function metricHit(string $data, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['data'] = $data;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('leads.metricHit', $sendParams);
    }

    /**
     * Creates new session for the user passing the offer.
     * 
     * @param int $leadId Lead ID.
     * @param string $secret Secret key from the lead testing interface.
     * @param int|null $uid
     * @param int|null $aid
     * @param bool|null $testMode
     * @param bool|null $force
     * @param array|null $custom
     * @return Promise
     */
    function start(int $leadId, string $secret, ?int $uid = 0, ?int $aid = 0, ?bool $testMode = false, ?bool $force = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['lead_id'] = $leadId;
        $sendParams['secret'] = $secret;
        if ($uid !== 0 && $uid != null) $sendParams['uid'] = $uid;
        if ($aid !== 0 && $aid != null) $sendParams['aid'] = $aid;
        if ($testMode !== false && $testMode != null) $sendParams['test_mode'] = intval($testMode);
        if ($force !== false && $force != null) $sendParams['force'] = intval($force);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('leads.start', $sendParams);
    }
}