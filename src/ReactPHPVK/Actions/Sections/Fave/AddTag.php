<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddTag
{
    private Provider $_provider;
    
    private string $name = '';
    private string $position = 'back';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddTag
     */
    public function _setCustom(array $value): AddTag
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddTag
     */
    public function setName(string $value): AddTag
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddTag
     */
    public function setPosition(string $value): AddTag
    {
        $this->position = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->name !== '') $params['name'] = $this->name;
        if ($this->position !== 'back') $params['position'] = $this->position;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->name = '';
            $this->position = 'back';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.addTag', $params);
    }
}