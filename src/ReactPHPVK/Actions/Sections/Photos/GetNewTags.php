<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of photos with tags that have not been viewed.
 */
class GetNewTags
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 20;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetNewTags
     */
    public function _setCustom(array $value): GetNewTags
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of photos.
     * 
     * @param int $value
     * @return GetNewTags
     */
    public function setOffset(int $value): GetNewTags
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of photos to return.
     * 
     * @param int $value
     * @return GetNewTags
     */
    public function setCount(int $value): GetNewTags
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 20;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.getNewTags', $params);
    }
}