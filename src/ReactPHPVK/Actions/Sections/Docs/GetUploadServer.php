<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the server address for document upload.
 */
class GetUploadServer
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
     * @return GetUploadServer
     */
    public function _setCustom(array $value): GetUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID (if the document will be uploaded to the community).
     * 
     * @param int $value
     * @return GetUploadServer
     */
    public function setGroupId(int $value): GetUploadServer
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.getUploadServer', $params);
    }
}