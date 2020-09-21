<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns players rating in the game.
 */
class GetLeaderboard
{
    private Provider $_provider;
    
    private string $type = '';
    private bool $global = true;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLeaderboard
     */
    public function _setCustom(array $value): GetLeaderboard
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Leaderboard type. Possible values: *'level' — by level,, *'points' — by mission points,, *'score' — by score ().
     * 
     * @param string $value
     * @return GetLeaderboard
     */
    public function setType(string $value): GetLeaderboard
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Rating type. Possible values: *'1' — global rating among all players,, *'0' — rating among user friends.
     * 
     * @param bool $value
     * @return GetLeaderboard
     */
    public function setGlobal(bool $value): GetLeaderboard
    {
        $this->global = $value;
        return $this;
    }

    /**
     * 1 — to return additional info about users
     * 
     * @param bool $value
     * @return GetLeaderboard
     */
    public function setExtended(bool $value): GetLeaderboard
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['type'] = $this->type;
        if ($this->global !== true) $params['global'] = intval($this->global);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = '';
            $this->global = true;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('apps.getLeaderboard', $params);
    }
}