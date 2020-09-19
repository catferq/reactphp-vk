<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns information about documents by their IDs.
 */
class GetById
{
    private Provider $_provider;
    
    private array $docs = [];
    private bool $returnTags = false;
    
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
     * Document IDs. Example: , "66748_91488,66748_91455",
     * 
     * @param array $value
     * @return GetById
     */
    public function setDocs(array $value): GetById
    {
        $this->docs = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return GetById
     */
    public function setReturnTags(bool $value): GetById
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

        $params['docs'] = implode(',', $this->docs);
        if ($this->returnTags !== false) $params['return_tags'] = intval($this->returnTags);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->docs = [];
            $this->returnTags = false;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.getById', $params);
    }
}