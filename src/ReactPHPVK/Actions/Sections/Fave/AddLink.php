<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Adds a link to user faves.
 */
class AddLink
{
    private Provider $_provider;
    
    private string $link = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddLink
     */
    public function _setCustom(array $value): AddLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Link URL.
     * 
     * @param string $value
     * @return AddLink
     */
    public function setLink(string $value): AddLink
    {
        $this->link = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['link'] = $this->link;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->link = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.addLink', $params);
    }
}