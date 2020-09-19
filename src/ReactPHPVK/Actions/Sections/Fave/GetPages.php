<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetPages
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 50;
    private string $type = '';
    private array $fields = [];
    private int $tagId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetPages
     */
    public function _setCustom(array $value): GetPages
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPages
     */
    public function setOffset(int $value): GetPages
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPages
     */
    public function setCount(int $value): GetPages
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return GetPages
     */
    public function setType(string $value): GetPages
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetPages
     */
    public function setFields(array $value): GetPages
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetPages
     */
    public function setTagId(int $value): GetPages
    {
        $this->tagId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 50) $params['count'] = $this->count;
        if ($this->type !== '') $params['type'] = $this->type;
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->tagId !== 0) $params['tag_id'] = $this->tagId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 50;
            $this->type = '';
            $this->fields = [];
            $this->tagId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('fave.getPages', $params);
    }
}