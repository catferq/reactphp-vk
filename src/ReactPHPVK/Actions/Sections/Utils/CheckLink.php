<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Checks whether a link is blocked in VK.
 */
class CheckLink
{
    private Provider $_provider;
    
    private string $url = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return CheckLink
     */
    public function _setCustom(array $value): CheckLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Link to check (e.g., 'http://google.com').
     * 
     * @param string $value
     * @return CheckLink
     */
    public function setUrl(string $value): CheckLink
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['url'] = $this->url;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->url = '';
            $this->_custom = [];
        }

        return $this->_provider->request('utils.checkLink', $params);
    }
}