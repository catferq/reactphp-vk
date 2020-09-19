<?php

namespace ReactPHPVK\Actions\Sections\DownloadedGames;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetPaidStatus
{
    private Provider $_provider;
    
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetPaidStatus
     */
    public function _setCustom(array $value): GetPaidStatus
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPaidStatus
     */
    public function setUserId(int $value): GetPaidStatus
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('downloadedGames.getPaidStatus', $params);
    }
}