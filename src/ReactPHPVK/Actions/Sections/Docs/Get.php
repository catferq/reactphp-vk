<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns detailed information about user or community documents.
 */
class Get
{
    private Provider $_provider;
    
    private int $count = 0;
    private int $offset = 0;
    private int $type = 0;
    private int $ownerId = 0;
    private bool $returnTags = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Get
     */
    public function _setCustom(array $value): Get
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Number of documents to return. By default, all documents.
     * 
     * @param int $value
     * @return Get
     */
    public function setCount(int $value): Get
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of documents.
     * 
     * @param int $value
     * @return Get
     */
    public function setOffset(int $value): Get
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Get
     */
    public function setType(int $value): Get
    {
        $this->type = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the documents. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setOwnerId(int $value): Get
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Get
     */
    public function setReturnTags(bool $value): Get
    {
        $this->returnTags = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->type !== 0) $params['type'] = $this->type;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->returnTags !== false) $params['return_tags'] = intval($this->returnTags);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->count = 0;
            $this->offset = 0;
            $this->type = 0;
            $this->ownerId = 0;
            $this->returnTags = false;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.get', $params);
    }
}