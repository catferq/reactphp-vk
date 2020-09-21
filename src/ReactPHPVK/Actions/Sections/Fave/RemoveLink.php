<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Removes link from the user's faves.
 */
class RemoveLink
{
    private Provider $_provider;
    
    private string $linkId = '';
    private string $link = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveLink
     */
    public function _setCustom(array $value): RemoveLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Link ID (can be obtained by [vk.com/dev/faves.getLinks|faves.getLinks] method).
     * 
     * @param string $value
     * @return RemoveLink
     */
    public function setLinkId(string $value): RemoveLink
    {
        $this->linkId = $value;
        return $this;
    }

    /**
     * Link URL
     * 
     * @param string $value
     * @return RemoveLink
     */
    public function setLink(string $value): RemoveLink
    {
        $this->link = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->linkId !== '') $params['link_id'] = $this->linkId;
        if ($this->link !== '') $params['link'] = $this->link;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->linkId = '';
            $this->link = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.removeLink', $params);
    }
}