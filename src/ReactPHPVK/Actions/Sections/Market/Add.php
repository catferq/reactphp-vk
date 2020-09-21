<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Ads a new item to the market.
 */
class Add
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $name = '';
    private string $description = '';
    private int $categoryId = 0;
    private float $price = 0;
    private float $oldPrice = 0;
    private bool $deleted = false;
    private int $mainPhotoId = 0;
    private array $photoIds = [];
    private string $url = '';
    private int $dimensionWidth = 0;
    private int $dimensionHeight = 0;
    private int $dimensionLength = 0;
    private int $weight = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Add
     */
    public function _setCustom(array $value): Add
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return Add
     */
    public function setOwnerId(int $value): Add
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item name.
     * 
     * @param string $value
     * @return Add
     */
    public function setName(string $value): Add
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Item description.
     * 
     * @param string $value
     * @return Add
     */
    public function setDescription(string $value): Add
    {
        $this->description = $value;
        return $this;
    }

    /**
     * Item category ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setCategoryId(int $value): Add
    {
        $this->categoryId = $value;
        return $this;
    }

    /**
     * Item price.
     * 
     * @param float $value
     * @return Add
     */
    public function setPrice(float $value): Add
    {
        $this->price = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Add
     */
    public function setOldPrice(float $value): Add
    {
        $this->oldPrice = $value;
        return $this;
    }

    /**
     * Item status ('1' — deleted, '0' — not deleted).
     * 
     * @param bool $value
     * @return Add
     */
    public function setDeleted(bool $value): Add
    {
        $this->deleted = $value;
        return $this;
    }

    /**
     * Cover photo ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setMainPhotoId(int $value): Add
    {
        $this->mainPhotoId = $value;
        return $this;
    }

    /**
     * IDs of additional photos.
     * 
     * @param array $value
     * @return Add
     */
    public function setPhotoIds(array $value): Add
    {
        $this->photoIds = $value;
        return $this;
    }

    /**
     * Url for button in market item.
     * 
     * @param string $value
     * @return Add
     */
    public function setUrl(string $value): Add
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Add
     */
    public function setDimensionWidth(int $value): Add
    {
        $this->dimensionWidth = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Add
     */
    public function setDimensionHeight(int $value): Add
    {
        $this->dimensionHeight = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Add
     */
    public function setDimensionLength(int $value): Add
    {
        $this->dimensionLength = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Add
     */
    public function setWeight(int $value): Add
    {
        $this->weight = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['name'] = $this->name;
        $params['description'] = $this->description;
        $params['category_id'] = $this->categoryId;
        if ($this->price !== 0) $params['price'] = $this->price;
        if ($this->oldPrice !== 0) $params['old_price'] = $this->oldPrice;
        if ($this->deleted !== false) $params['deleted'] = intval($this->deleted);
        $params['main_photo_id'] = $this->mainPhotoId;
        if ($this->photoIds !== []) $params['photo_ids'] = implode(',', $this->photoIds);
        if ($this->url !== '') $params['url'] = $this->url;
        if ($this->dimensionWidth !== 0) $params['dimension_width'] = $this->dimensionWidth;
        if ($this->dimensionHeight !== 0) $params['dimension_height'] = $this->dimensionHeight;
        if ($this->dimensionLength !== 0) $params['dimension_length'] = $this->dimensionLength;
        if ($this->weight !== 0) $params['weight'] = $this->weight;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->name = '';
            $this->description = '';
            $this->categoryId = 0;
            $this->price = 0;
            $this->oldPrice = 0;
            $this->deleted = false;
            $this->mainPhotoId = 0;
            $this->photoIds = [];
            $this->url = '';
            $this->dimensionWidth = 0;
            $this->dimensionHeight = 0;
            $this->dimensionLength = 0;
            $this->weight = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.add', $params);
    }
}