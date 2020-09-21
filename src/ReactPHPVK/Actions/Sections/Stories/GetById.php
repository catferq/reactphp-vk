<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns story by its ID.
 */
class GetById
{
    private Provider $_provider;
    
    private array $stories = [];
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
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Stories IDs separated by commas. Use format {owner_id}+'_'+{story_id}, for example, 12345_54331.
     * 
     * @param array $value
     * @return GetById
     */
    public function setStories(array $value): GetById
    {
        $this->stories = $value;
        return $this;
    }

    /**
     * '1' — to return additional fields for users and communities. Default value is 0.
     * 
     * @param bool $value
     * @return GetById
     */
    public function setExtended(bool $value): GetById
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * Additional fields to return
     * 
     * @param array $value
     * @return GetById
     */
    public function setFields(array $value): GetById
    {
        $this->fields = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['stories'] = implode(',', $this->stories);
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->fields !== []) $params['fields'] = implode(',', $this->fields);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->stories = [];
            $this->extended = false;
            $this->fields = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stories.getById', $params);
    }
}