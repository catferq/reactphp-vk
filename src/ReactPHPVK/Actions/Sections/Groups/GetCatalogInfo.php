<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns categories list for communities catalog
 */
class GetCatalogInfo
{
    private Provider $_provider;
    
    private bool $extended = false;
    private bool $subcategories = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCatalogInfo
     */
    public function _setCustom(array $value): GetCatalogInfo
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * 1 – to return communities count and three communities for preview. By default: 0.
     * 
     * @param bool $value
     * @return GetCatalogInfo
     */
    public function setExtended(bool $value): GetCatalogInfo
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * 1 – to return subcategories info. By default: 0.
     * 
     * @param bool $value
     * @return GetCatalogInfo
     */
    public function setSubcategories(bool $value): GetCatalogInfo
    {
        $this->subcategories = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->subcategories !== false) $params['subcategories'] = intval($this->subcategories);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->extended = false;
            $this->subcategories = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getCatalogInfo', $params);
    }
}