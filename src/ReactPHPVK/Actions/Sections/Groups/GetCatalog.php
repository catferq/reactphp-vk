<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns communities list for a catalog category.
 */
class GetCatalog
{
    private Provider $_provider;
    
    private int $categoryId = 0;
    private int $subcategoryId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetCatalog
     */
    public function _setCustom(array $value): GetCatalog
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Category id received from [vk.com/dev/groups.getCatalogInfo|groups.getCatalogInfo].
     * 
     * @param int $value
     * @return GetCatalog
     */
    public function setCategoryId(int $value): GetCatalog
    {
        $this->categoryId = $value;
        return $this;
    }

    /**
     * Subcategory id received from [vk.com/dev/groups.getCatalogInfo|groups.getCatalogInfo].
     * 
     * @param int $value
     * @return GetCatalog
     */
    public function setSubcategoryId(int $value): GetCatalog
    {
        $this->subcategoryId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->categoryId !== 0) $params['category_id'] = $this->categoryId;
        if ($this->subcategoryId !== 0) $params['subcategory_id'] = $this->subcategoryId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->categoryId = 0;
            $this->subcategoryId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getCatalog', $params);
    }
}