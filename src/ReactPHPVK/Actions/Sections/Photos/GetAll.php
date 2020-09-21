<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of photos belonging to a user or community, in reverse chronological order.
 */
class GetAll
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private bool $extended = false;
    private int $offset = 0;
    private int $count = 20;
    private bool $photoSizes = false;
    private bool $noServiceAlbums = false;
    private bool $needHidden = false;
    private bool $skipHidden = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetAll
     */
    public function _setCustom(array $value): GetAll
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of a user or community that owns the photos. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetAll
     */
    public function setOwnerId(int $value): GetAll
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * '1' — to return detailed information about photos
     * 
     * @param bool $value
     * @return GetAll
     */
    public function setExtended(bool $value): GetAll
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of photos. By default, '0'.
     * 
     * @param int $value
     * @return GetAll
     */
    public function setOffset(int $value): GetAll
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of photos to return.
     * 
     * @param int $value
     * @return GetAll
     */
    public function setCount(int $value): GetAll
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' – to return image sizes in [vk.com/dev/photo_sizes|special format].
     * 
     * @param bool $value
     * @return GetAll
     */
    public function setPhotoSizes(bool $value): GetAll
    {
        $this->photoSizes = $value;
        return $this;
    }

    /**
     * '1' – to return photos only from standard albums, '0' – to return all photos including those in service albums, e.g., 'My wall photos' (default)
     * 
     * @param bool $value
     * @return GetAll
     */
    public function setNoServiceAlbums(bool $value): GetAll
    {
        $this->noServiceAlbums = $value;
        return $this;
    }

    /**
     * '1' – to show information about photos being hidden from the block above the wall.
     * 
     * @param bool $value
     * @return GetAll
     */
    public function setNeedHidden(bool $value): GetAll
    {
        $this->needHidden = $value;
        return $this;
    }

    /**
     * '1' – not to return photos being hidden from the block above the wall. Works only with owner_id>0, no_service_albums is ignored.
     * 
     * @param bool $value
     * @return GetAll
     */
    public function setSkipHidden(bool $value): GetAll
    {
        $this->skipHidden = $value;
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
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->photoSizes !== false) $params['photo_sizes'] = intval($this->photoSizes);
        if ($this->noServiceAlbums !== false) $params['no_service_albums'] = intval($this->noServiceAlbums);
        if ($this->needHidden !== false) $params['need_hidden'] = intval($this->needHidden);
        if ($this->skipHidden !== false) $params['skip_hidden'] = intval($this->skipHidden);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->extended = false;
            $this->offset = 0;
            $this->count = 20;
            $this->photoSizes = false;
            $this->noServiceAlbums = false;
            $this->needHidden = false;
            $this->skipHidden = false;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getAll', $params);
    }
}