<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits an item.
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $itemId = 0;
    private string $name = '';
    private string $description = '';
    private int $categoryId = 0;
    private float $price = 0;
    private bool $deleted = false;
    private int $mainPhotoId = 0;
    private array $photoIds = [];
    private string $url = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return Edit
     */
    public function setOwnerId(int $value): Edit
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setItemId(int $value): Edit
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Item name.
     * 
     * @param string $value
     * @return Edit
     */
    public function setName(string $value): Edit
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Item description.
     * 
     * @param string $value
     * @return Edit
     */
    public function setDescription(string $value): Edit
    {
        $this->description = $value;
        return $this;
    }

    /**
     * Item category ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setCategoryId(int $value): Edit
    {
        $this->categoryId = $value;
        return $this;
    }

    /**
     * Item price.
     * 
     * @param float $value
     * @return Edit
     */
    public function setPrice(float $value): Edit
    {
        $this->price = $value;
        return $this;
    }

    /**
     * Item status ('1' — deleted, '0' — not deleted).
     * 
     * @param bool $value
     * @return Edit
     */
    public function setDeleted(bool $value): Edit
    {
        $this->deleted = $value;
        return $this;
    }

    /**
     * Cover photo ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setMainPhotoId(int $value): Edit
    {
        $this->mainPhotoId = $value;
        return $this;
    }

    /**
     * IDs of additional photos.
     * 
     * @param array $value
     * @return Edit
     */
    public function setPhotoIds(array $value): Edit
    {
        $this->photoIds = $value;
        return $this;
    }

    /**
     * Url for button in market item.
     * 
     * @param string $value
     * @return Edit
     */
    public function setUrl(string $value): Edit
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

        $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        $params['name'] = $this->name;
        $params['description'] = $this->description;
        $params['category_id'] = $this->categoryId;
        $params['price'] = $this->price;
        if ($this->deleted !== false) $params['deleted'] = intval($this->deleted);
        $params['main_photo_id'] = $this->mainPhotoId;
        if ($this->photoIds !== []) $params['photo_ids'] = implode(',', $this->photoIds);
        if ($this->url !== '') $params['url'] = $this->url;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->name = '';
            $this->description = '';
            $this->categoryId = 0;
            $this->price = 0;
            $this->deleted = false;
            $this->mainPhotoId = 0;
            $this->photoIds = [];
            $this->url = '';
            $this->_custom = [];
        }

        return $this->_provider->request('market.edit', $params);
    }
}