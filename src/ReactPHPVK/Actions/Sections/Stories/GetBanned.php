<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns list of sources hidden from current user's feed.
 */
class GetBanned
{
    private Provider $_provider;
    
    private bool $extended = false;
    private array $fields = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetBanned
     */
    public function _setCustom(array $value): GetBanned
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * '1' — to return additional fields for users and communities. Default value is 0.
     * 
     * @param bool $value
     * @return GetBanned
     */
    public function setExtended(bool $value): GetBanned
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Additional fields to return
     * 
     * @param array $value
     * @return GetBanned
     */
    public function setFields(array $value): GetBanned
    {
        $this->fields = $value;
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
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stories.getBanned', $params);
    }
}