<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits the caption of a photo.
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private string $caption = '';
    private float $latitude = 0;
    private float $longitude = 0;
    private string $placeStr = '';
    private string $foursquareId = '';
    private bool $deletePlace = false;
    
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
     * ID of the user or community that owns the photo.
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
     * Photo ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setPhotoId(int $value): Edit
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * New caption for the photo. If this parameter is not set, it is considered to be equal to an empty string.
     * 
     * @param string $value
     * @return Edit
     */
    public function setCaption(string $value): Edit
    {
        $this->caption = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Edit
     */
    public function setLatitude(float $value): Edit
    {
        $this->latitude = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return Edit
     */
    public function setLongitude(float $value): Edit
    {
        $this->longitude = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setPlaceStr(string $value): Edit
    {
        $this->placeStr = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setFoursquareId(string $value): Edit
    {
        $this->foursquareId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Edit
     */
    public function setDeletePlace(bool $value): Edit
    {
        $this->deletePlace = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['photo_id'] = $this->photoId;
        if ($this->caption !== '') $params['caption'] = $this->caption;
        if ($this->latitude !== 0) $params['latitude'] = $this->latitude;
        if ($this->longitude !== 0) $params['longitude'] = $this->longitude;
        if ($this->placeStr !== '') $params['place_str'] = $this->placeStr;
        if ($this->foursquareId !== '') $params['foursquare_id'] = $this->foursquareId;
        if ($this->deletePlace !== false) $params['delete_place'] = intval($this->deletePlace);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->caption = '';
            $this->latitude = 0;
            $this->longitude = 0;
            $this->placeStr = '';
            $this->foursquareId = '';
            $this->deletePlace = false;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.edit', $params);
    }
}