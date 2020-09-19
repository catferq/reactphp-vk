<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns URL to upload an ad photo to.
 */
class GetUploadURL
{
    private Provider $_provider;
    
    private int $adFormat = 0;
    private int $icon = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetUploadURL
     */
    public function _setCustom(array $value): GetUploadURL
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Ad format: *1 — image and text,, *2 — big image,, *3 — exclusive format,, *4 — community, square image,, *7 — special app format.
     * 
     * @param int $value
     * @return GetUploadURL
     */
    public function setAdFormat(int $value): GetUploadURL
    {
        $this->adFormat = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetUploadURL
     */
    public function setIcon(int $value): GetUploadURL
    {
        $this->icon = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['ad_format'] = $this->adFormat;
        if ($this->icon !== 0) $params['icon'] = $this->icon;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->adFormat = 0;
            $this->icon = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getUploadURL', $params);
    }
}