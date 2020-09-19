<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Deletes a user or community document.
 */
class Delete
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $docId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Delete
     */
    public function _setCustom(array $value): Delete
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the document. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Delete
     */
    public function setOwnerId(int $value): Delete
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Document ID.
     * 
     * @param int $value
     * @return Delete
     */
    public function setDocId(int $value): Delete
    {
        $this->docId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['doc_id'] = $this->docId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->docId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.delete', $params);
    }
}