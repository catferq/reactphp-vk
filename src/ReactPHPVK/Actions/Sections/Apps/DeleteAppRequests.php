<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes all request notifications from the current app.
 */
class DeleteAppRequests
{
    private Provider $_provider;
    
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteAppRequests
     */
    public function _setCustom(array $value): DeleteAppRequests
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->_custom = [];
        }

        return $this->_provider->request('apps.deleteAppRequests', $params);
    }
}