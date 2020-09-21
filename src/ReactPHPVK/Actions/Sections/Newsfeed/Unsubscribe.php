<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Unsubscribes the current user from specified newsfeeds.
 */
class Unsubscribe
{
    private Provider $_provider;
    
    private string $type = '';
    private int $ownerId = 0;
    private int $itemId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Unsubscribe
     */
    public function _setCustom(array $value): Unsubscribe
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Type of object from which to unsubscribe: 'note' — note, 'photo' — photo, 'post' — post on user wall or community wall, 'topic' — topic, 'video' — video
     * 
     * @param string $value
     * @return Unsubscribe
     */
    public function setType(string $value): Unsubscribe
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Object owner ID.
     * 
     * @param int $value
     * @return Unsubscribe
     */
    public function setOwnerId(int $value): Unsubscribe
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Object ID.
     * 
     * @param int $value
     * @return Unsubscribe
     */
    public function setItemId(int $value): Unsubscribe
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['type'] = $this->type;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = '';
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.unsubscribe', $params);
    }
}