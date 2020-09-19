<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of possible ad categories.
 */
class GetCategories
{
    private Provider $_provider;
    
    private string $lang = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCategories
     */
    public function _setCustom(array $value): GetCategories
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Language. The full list of supported languages is [vk.com/dev/api_requests|here].
     * 
     * @param string $value
     * @return GetCategories
     */
    public function setLang(string $value): GetCategories
    {
        $this->lang = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->lang !== '') $params['lang'] = $this->lang;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->lang = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getCategories', $params);
    }
}