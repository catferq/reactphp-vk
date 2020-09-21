<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns scopes for auth
 */
class GetScopes
{
    private Provider $_provider;
    
    private string $type = 'user';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetScopes
     */
    public function _setCustom(array $value): GetScopes
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetScopes
     */
    public function setType(string $value): GetScopes
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->type !== 'user') $params['type'] = $this->type;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = 'user';
            $this->_custom = [];
        }

        return $this->_provider->request('apps.getScopes', $params);
    }
}