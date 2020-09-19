<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class EditTag
{
    private Provider $_provider;
    
    private int $id = 0;
    private string $name = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditTag
     */
    public function _setCustom(array $value): EditTag
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return EditTag
     */
    public function setId(int $value): EditTag
    {
        $this->id = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return EditTag
     */
    public function setName(string $value): EditTag
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['id'] = $this->id;
        $params['name'] = $this->name;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->id = 0;
            $this->name = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.editTag', $params);
    }
}