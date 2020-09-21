<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about photos by their IDs.
 */
class GetById
{
    private Provider $_provider;
    
    private array $photos = [];
    private bool $extended = false;
    private bool $photoSizes = false;
    
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
     * IDs separated with a comma, that are IDs of users who posted photos and IDs of photos themselves with an underscore character between such IDs. To get information about a photo in the group album, you shall specify group ID instead of user ID. Example: "1_129207899,6492_135055734, , -20629724_271945303"
     * 
     * @param array $value
     * @return GetById
     */
    public function setPhotos(array $value): GetById
    {
        $this->photos = $value;
        return $this;
    }

    /**
     * '1' — to return additional fields, '0' — (default)
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
     * '1' — to return photo sizes in a
     * 
     * @param bool $value
     * @return GetById
     */
    public function setPhotoSizes(bool $value): GetById
    {
        $this->photoSizes = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['photos'] = implode(',', $this->photos);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->photoSizes !== false) $params['photo_sizes'] = intval($this->photoSizes);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->photos = [];
            $this->extended = false;
            $this->photoSizes = false;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getById', $params);
    }
}