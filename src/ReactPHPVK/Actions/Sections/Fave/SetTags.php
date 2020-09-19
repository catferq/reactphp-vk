<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class SetTags
{
    private Provider $_provider;
    
    private string $itemType = '';
    private int $itemOwnerId = 0;
    private int $itemId = 0;
    private array $tagIds = [];
    private string $linkId = '';
    private string $linkUrl = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetTags
     */
    public function _setCustom(array $value): SetTags
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SetTags
     */
    public function setItemType(string $value): SetTags
    {
        $this->itemType = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SetTags
     */
    public function setItemOwnerId(int $value): SetTags
    {
        $this->itemOwnerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return SetTags
     */
    public function setItemId(int $value): SetTags
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return SetTags
     */
    public function setTagIds(array $value): SetTags
    {
        $this->tagIds = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SetTags
     */
    public function setLinkId(string $value): SetTags
    {
        $this->linkId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SetTags
     */
    public function setLinkUrl(string $value): SetTags
    {
        $this->linkUrl = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->itemType !== '') $params['item_type'] = $this->itemType;
        if ($this->itemOwnerId !== 0) $params['item_owner_id'] = $this->itemOwnerId;
        if ($this->itemId !== 0) $params['item_id'] = $this->itemId;
        if ($this->tagIds !== []) $params['tag_ids'] = implode(',', $this->tagIds);
        if ($this->linkId !== '') $params['link_id'] = $this->linkId;
        if ($this->linkUrl !== '') $params['link_url'] = $this->linkUrl;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->itemType = '';
            $this->itemOwnerId = 0;
            $this->itemId = 0;
            $this->tagIds = [];
            $this->linkId = '';
            $this->linkUrl = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.setTags', $params);
    }
}