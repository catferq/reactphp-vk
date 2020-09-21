<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates new collection of items
 */
class AddAlbum
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $title = '';
    private int $photoId = 0;
    private bool $mainAlbum = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddAlbum
     */
    public function _setCustom(array $value): AddAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return AddAlbum
     */
    public function setOwnerId(int $value): AddAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Collection title.
     * 
     * @param string $value
     * @return AddAlbum
     */
    public function setTitle(string $value): AddAlbum
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Cover photo ID.
     * 
     * @param int $value
     * @return AddAlbum
     */
    public function setPhotoId(int $value): AddAlbum
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * Set as main ('1' – set, '0' – no).
     * 
     * @param bool $value
     * @return AddAlbum
     */
    public function setMainAlbum(bool $value): AddAlbum
    {
        $this->mainAlbum = $value;
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
        $params['title'] = $this->title;
        if ($this->photoId !== 0) $params['photo_id'] = $this->photoId;
        if ($this->mainAlbum !== false) $params['main_album'] = intval($this->mainAlbum);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->title = '';
            $this->photoId = 0;
            $this->mainAlbum = false;
            $this->_custom = [];
        }

        return $this->_provider->request('market.addAlbum', $params);
    }
}