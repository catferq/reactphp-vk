<?php

namespace ReactPHPVK\Actions\Sections\Secure;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Opens the game achievement and gives the user a sticker
 */
class GiveEventSticker
{
    private Provider $_provider;
    
    private array $userIds = [];
    private int $achievementId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GiveEventSticker
     */
    public function _setCustom(array $value): GiveEventSticker
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GiveEventSticker
     */
    public function setUserIds(array $value): GiveEventSticker
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GiveEventSticker
     */
    public function setAchievementId(int $value): GiveEventSticker
    {
        $this->achievementId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['user_ids'] = implode(',', $this->userIds);
        $params['achievement_id'] = $this->achievementId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userIds = [];
            $this->achievementId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('secure.giveEventSticker', $params);
    }
}