<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns user score in app
 */
class GetScore
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
     * @return GetScore
     */
    public function _setCustom(array $value): GetScore
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetScore
     */
    public function setUserId(int $value): GetScore
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('apps.getScore', $params);
    }
}