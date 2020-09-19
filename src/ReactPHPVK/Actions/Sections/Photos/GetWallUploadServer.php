<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the server address for photo upload onto a user's wall.
 */
class GetWallUploadServer
{
    private Provider $_provider;
    
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetWallUploadServer
     */
    public function _setCustom(array $value): GetWallUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of community to whose wall the photo will be uploaded.
     * 
     * @param int $value
     * @return GetWallUploadServer
     */
    public function setGroupId(int $value): GetWallUploadServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getWallUploadServer', $params);
    }
}