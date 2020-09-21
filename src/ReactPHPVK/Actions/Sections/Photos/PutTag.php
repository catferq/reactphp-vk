<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a tag on the photo.
 */
class PutTag
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
    private int $userId = 0;
    private float $x = 0;
    private float $y = 0;
    private float $x2 = 0;
    private float $y2 = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return PutTag
     */
    public function _setCustom(array $value): PutTag
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the photo.
     * 
     * @param int $value
     * @return PutTag
     */
    public function setOwnerId(int $value): PutTag
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Photo ID.
     * 
     * @param int $value
     * @return PutTag
     */
    public function setPhotoId(int $value): PutTag
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * ID of the user to be tagged.
     * 
     * @param int $value
     * @return PutTag
     */
    public function setUserId(int $value): PutTag
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Upper left-corner coordinate of the tagged area (as a percentage of the photo's width).
     * 
     * @param float $value
     * @return PutTag
     */
    public function setX(float $value): PutTag
    {
        $this->x = $value;
        return $this;
    }

    /**
     * Upper left-corner coordinate of the tagged area (as a percentage of the photo's height).
     * 
     * @param float $value
     * @return PutTag
     */
    public function setY(float $value): PutTag
    {
        $this->y = $value;
        return $this;
    }

    /**
     * Lower right-corner coordinate of the tagged area (as a percentage of the photo's width).
     * 
     * @param float $value
     * @return PutTag
     */
    public function setX2(float $value): PutTag
    {
        $this->x2 = $value;
        return $this;
    }

    /**
     * Lower right-corner coordinate of the tagged area (as a percentage of the photo's height).
     * 
     * @param float $value
     * @return PutTag
     */
    public function setY2(float $value): PutTag
    {
        $this->y2 = $value;
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
        $params['user_id'] = $this->userId;
        if ($this->x !== 0) $params['x'] = $this->x;
        if ($this->y !== 0) $params['y'] = $this->y;
        if ($this->x2 !== 0) $params['x2'] = $this->x2;
        if ($this->y2 !== 0) $params['y2'] = $this->y2;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->userId = 0;
            $this->x = 0;
            $this->y = 0;
            $this->x2 = 0;
            $this->y2 = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.putTag', $params);
    }
}