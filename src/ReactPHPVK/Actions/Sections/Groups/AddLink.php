<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to add a link to the community.
 */
class AddLink
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private string $link = '';
    private string $text = '';
    
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
     * Community ID.
     * 
     * @param int $value
     * @return AddLink
     */
    public function setGroupId(int $value): AddLink
    {
        $this->groupId = $value;
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
     * Description text for the link.
     * 
     * @param string $value
     * @return AddLink
     */
    public function setText(string $value): AddLink
    {
        $this->text = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['link'] = $this->link;
        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->link = '';
            $this->text = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.addLink', $params);
    }
}