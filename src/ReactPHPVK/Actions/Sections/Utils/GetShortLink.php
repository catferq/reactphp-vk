<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to receive a link shortened via vk.cc.
 */
class GetShortLink
{
    private Provider $_provider;
    
    private string $url = '';
    private bool $private = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetShortLink
     */
    public function _setCustom(array $value): GetShortLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * URL to be shortened.
     * 
     * @param string $value
     * @return GetShortLink
     */
    public function setUrl(string $value): GetShortLink
    {
        $this->url = $value;
        return $this;
    }

    /**
     * 1 — private stats, 0 — public stats.
     * 
     * @param bool $value
     * @return GetShortLink
     */
    public function setPrivate(bool $value): GetShortLink
    {
        $this->private = $value;
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
        if ($this->private !== false) $params['private'] = intval($this->private);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->url = '';
            $this->private = false;
            $this->_custom = [];
        }

        return $this->_provider->request('utils.getShortLink', $params);
    }
}