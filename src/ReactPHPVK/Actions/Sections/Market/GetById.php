<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about market items by their ids.
 */
class GetById
{
    private Provider $_provider;
    
    private array $itemIds = [];
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Comma-separated ids list: {user id}_{item id}. If an item belongs to a community -{community id} is used. " 'Videos' value example: , '-4363_136089719,13245770_137352259'"
     * 
     * @param array $value
     * @return GetById
     */
    public function setItemIds(array $value): GetById
    {
        $this->itemIds = $value;
        return $this;
    }

    /**
     * '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
     * 
     * @param bool $value
     * @return GetById
     */
    public function setExtended(bool $value): GetById
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['item_ids'] = implode(',', $this->itemIds);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->itemIds = [];
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('market.getById', $params);
    }
}