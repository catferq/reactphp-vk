<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetMusicians
{
    private Provider $_provider;
    
    private string $artistName = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMusicians
     */
    public function _setCustom(array $value): GetMusicians
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetMusicians
     */
    public function setArtistName(string $value): GetMusicians
    {
        $this->artistName = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['artist_name'] = $this->artistName;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->artistName = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getMusicians', $params);
    }
}