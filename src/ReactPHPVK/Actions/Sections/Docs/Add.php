<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Copies a document to a user's or community's document list.
 */
class Add
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $docId = 0;
    private string $accessKey = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Add
     */
    public function _setCustom(array $value): Add
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the document. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setOwnerId(int $value): Add
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Document ID.
     * 
     * @param int $value
     * @return Add
     */
    public function setDocId(int $value): Add
    {
        $this->docId = $value;
        return $this;
    }

    /**
     * Access key. This parameter is required if 'access_key' was returned with the document's data.
     * 
     * @param string $value
     * @return Add
     */
    public function setAccessKey(string $value): Add
    {
        $this->accessKey = $value;
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
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->docId = 0;
            $this->accessKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('docs.add', $params);
    }
}