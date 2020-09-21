<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a hidden item to the newsfeed.
 */
class UnignoreItem
{
    private Provider $_provider;
    
    private string $type = '';
    private int $ownerId = 0;
    private int $itemId = 0;
    private string $trackCode = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return UnignoreItem
     */
    public function _setCustom(array $value): UnignoreItem
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Item type. Possible values: *'wall' – post on the wall,, *'tag' – tag on a photo,, *'profilephoto' – profile photo,, *'video' – video,, *'audio' – audio.
     * 
     * @param string $value
     * @return UnignoreItem
     */
    public function setType(string $value): UnignoreItem
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' – user , 'owner_id=-1' – community "
     * 
     * @param int $value
     * @return UnignoreItem
     */
    public function setOwnerId(int $value): UnignoreItem
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item identifier
     * 
     * @param int $value
     * @return UnignoreItem
     */
    public function setItemId(int $value): UnignoreItem
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Track code of unignored item
     * 
     * @param string $value
     * @return UnignoreItem
     */
    public function setTrackCode(string $value): UnignoreItem
    {
        $this->trackCode = $value;
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
        $params['owner_id'] = $this->ownerId;
        $params['item_id'] = $this->itemId;
        if ($this->trackCode !== '') $params['track_code'] = $this->trackCode;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = '';
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->trackCode = '';
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.unignoreItem', $params);
    }
}