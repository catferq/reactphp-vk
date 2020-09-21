<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to clear the cache of particular 'external' pages which may be attached to VK posts.
 */
class ClearCache
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
     * @return ClearCache
     */
    public function _setCustom(array $value): ClearCache
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Address of the page where you need to refesh the cached version
     * 
     * @param string $value
     * @return ClearCache
     */
    public function setUrl(string $value): ClearCache
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['url'] = $this->url;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->url = '';
            $this->_custom = [];
        }

        return $this->_provider->request('pages.clearCache', $params);
    }
}