<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Get
{
    private Provider $_provider;
    
    private bool $extended = false;
    private string $itemType = '';
    private int $tagId = 0;
    private int $offset = 0;
    private int $count = 50;
    private string $fields = '';
    private bool $isFromSnackbar = false;
    
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
     * '1' — to return additional 'wall', 'profiles', and 'groups' fields. By default: '0'.
     * 
     * @param bool $value
     * @return Get
     */
    public function setExtended(bool $value): Get
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Get
     */
    public function setItemType(string $value): Get
    {
        $this->itemType = $value;
        return $this;
    }

    /**
     * Tag ID.
     * 
     * @param int $value
     * @return Get
     */
    public function setTagId(int $value): Get
    {
        $this->tagId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of users.
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
     * Number of users to return.
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
     * @param string $value
     * @return Get
     */
    public function setFields(string $value): Get
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Get
     */
    public function setIsFromSnackbar(bool $value): Get
    {
        $this->isFromSnackbar = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->itemType !== '') $params['item_type'] = $this->itemType;
        if ($this->tagId !== 0) $params['tag_id'] = $this->tagId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 50) $params['count'] = $this->count;
        if ($this->fields !== '') $params['fields'] = $this->fields;
        if ($this->isFromSnackbar !== false) $params['is_from_snackbar'] = intval($this->isFromSnackbar);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->extended = false;
            $this->itemType = '';
            $this->tagId = 0;
            $this->offset = 0;
            $this->count = 50;
            $this->fields = '';
            $this->isFromSnackbar = false;
            $this->_custom = [];
        }

        return $this->_provider->request('fave.get', $params);
    }
}