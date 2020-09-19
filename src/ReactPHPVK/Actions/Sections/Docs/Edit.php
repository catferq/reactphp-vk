<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a document.
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $docId = 0;
    private string $title = '';
    private array $tags = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * User ID or community ID. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setOwnerId(int $value): Edit
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Document ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setDocId(int $value): Edit
    {
        $this->docId = $value;
        return $this;
    }

    /**
     * Document title.
     * 
     * @param string $value
     * @return Edit
     */
    public function setTitle(string $value): Edit
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Document tags.
     * 
     * @param array $value
     * @return Edit
     */
    public function setTags(array $value): Edit
    {
        $this->tags = $value;
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
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->tags !== []) $params['tags'] = implode(',', $this->tags);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->docId = 0;
            $this->title = '';
            $this->tags = [];
            $this->_custom = [];
        }

        return $this->_provider->request('docs.edit', $params);
    }
}