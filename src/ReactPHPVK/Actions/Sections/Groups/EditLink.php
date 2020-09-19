<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to edit a link in the community.
 */
class EditLink
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $linkId = 0;
    private string $text = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditLink
     */
    public function _setCustom(array $value): EditLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return EditLink
     */
    public function setGroupId(int $value): EditLink
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Link ID.
     * 
     * @param int $value
     * @return EditLink
     */
    public function setLinkId(int $value): EditLink
    {
        $this->linkId = $value;
        return $this;
    }

    /**
     * New description text for the link.
     * 
     * @param string $value
     * @return EditLink
     */
    public function setText(string $value): EditLink
    {
        $this->text = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        $params['link_id'] = $this->linkId;
        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->linkId = 0;
            $this->text = '';
            $this->_custom = [];
        }

        return $this->_provider->request('groups.editLink', $params);
    }
}