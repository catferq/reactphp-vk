<?php

namespace ReactPHPVK\Actions\Sections\Wall;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reposts (copies) an object to a user wall or community wall.
 */
class Repost
{
    private Provider $_provider;
    
    private string $object = '';
    private string $message = '';
    private int $groupId = 0;
    private bool $markAsAds = false;
    private bool $muteNotifications = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Repost
     */
    public function _setCustom(array $value): Repost
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the object to be reposted on the wall. Example: "wall66748_3675"
     * 
     * @param string $value
     * @return Repost
     */
    public function setObject(string $value): Repost
    {
        $this->object = $value;
        return $this;
    }

    /**
     * Comment to be added along with the reposted object.
     * 
     * @param string $value
     * @return Repost
     */
    public function setMessage(string $value): Repost
    {
        $this->message = $value;
        return $this;
    }

    /**
     * Target community ID when reposting to a community.
     * 
     * @param int $value
     * @return Repost
     */
    public function setGroupId(int $value): Repost
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Repost
     */
    public function setMarkAsAds(bool $value): Repost
    {
        $this->markAsAds = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Repost
     */
    public function setMuteNotifications(bool $value): Repost
    {
        $this->muteNotifications = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['object'] = $this->object;
        if ($this->message !== '') $params['message'] = $this->message;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->markAsAds !== false) $params['mark_as_ads'] = intval($this->markAsAds);
        if ($this->muteNotifications !== false) $params['mute_notifications'] = intval($this->muteNotifications);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->object = '';
            $this->message = '';
            $this->groupId = 0;
            $this->markAsAds = false;
            $this->muteNotifications = false;
            $this->_custom = [];
        }

        return $this->_provider->request('wall.repost', $params);
    }
}