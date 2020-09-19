<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a collection of items.
 */
class DeleteAlbum
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteAlbum
     */
    public function _setCustom(array $value): DeleteAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an collection owner community.
     * 
     * @param int $value
     * @return DeleteAlbum
     */
    public function setOwnerId(int $value): DeleteAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Collection ID.
     * 
     * @param int $value
     * @return DeleteAlbum
     */
    public function setAlbumId(int $value): DeleteAlbum
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['album_id'] = $this->albumId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.deleteAlbum', $params);
    }
}