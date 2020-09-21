<?php

namespace ReactPHPVK\Actions\Sections\Status;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sets a new status for the current user.
 */
class Set
{
    private Provider $_provider;
    
    private string $text = '';
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Set
     */
    public function _setCustom(array $value): Set
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Text of the new status.
     * 
     * @param string $value
     * @return Set
     */
    public function setText(string $value): Set
    {
        $this->text = $value;
        return $this;
    }

    /**
     * Identifier of a community to set a status in. If left blank the status is set to current user.
     * 
     * @param int $value
     * @return Set
     */
    public function setGroupId(int $value): Set
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->text !== '') $params['text'] = $this->text;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->text = '';
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('status.set', $params);
    }
}