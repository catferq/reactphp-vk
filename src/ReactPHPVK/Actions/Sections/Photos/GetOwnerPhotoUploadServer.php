<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns an upload server address for a profile or community photo.
 */
class GetOwnerPhotoUploadServer
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetOwnerPhotoUploadServer
     */
    public function _setCustom(array $value): GetOwnerPhotoUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * identifier of a community or current user. "Note that community id must be negative. 'owner_id=1' – user, 'owner_id=-1' – community, "
     * 
     * @param int $value
     * @return GetOwnerPhotoUploadServer
     */
    public function setOwnerId(int $value): GetOwnerPhotoUploadServer
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getOwnerPhotoUploadServer', $params);
    }
}