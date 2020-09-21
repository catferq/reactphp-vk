<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a collection of items
 */
class EditAlbum
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $albumId = 0;
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
     * @return EditAlbum
     */
    public function _setCustom(array $value): EditAlbum
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an collection owner community.
     * 
     * @param int $value
     * @return EditAlbum
     */
    public function setOwnerId(int $value): EditAlbum
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Collection ID.
     * 
     * @param int $value
     * @return EditAlbum
     */
    public function setAlbumId(int $value): EditAlbum
    {
        $this->albumId = $value;
        return $this;
    }

    /**
     * Collection title.
     * 
     * @param string $value
     * @return EditAlbum
     */
    public function setTitle(string $value): EditAlbum
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Cover photo id
     * 
     * @param int $value
     * @return EditAlbum
     */
    public function setPhotoId(int $value): EditAlbum
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * Set as main ('1' – set, '0' – no).
     * 
     * @param bool $value
     * @return EditAlbum
     */
    public function setMainAlbum(bool $value): EditAlbum
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
        $params['album_id'] = $this->albumId;
        $params['title'] = $this->title;
        if ($this->photoId !== 0) $params['photo_id'] = $this->photoId;
        if ($this->mainAlbum !== false) $params['main_album'] = intval($this->mainAlbum);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->albumId = 0;
            $this->title = '';
            $this->photoId = 0;
            $this->mainAlbum = false;
            $this->_custom = [];
        }

        return $this->_provider->request('market.editAlbum', $params);
    }
}