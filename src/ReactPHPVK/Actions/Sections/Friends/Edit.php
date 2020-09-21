<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits the friend lists of the selected user.
 */
class Edit
{
    private Provider $_provider;
    
    private int $userId = 0;
    private array $listIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user whose friend list is to be edited.
     * 
     * @param int $value
     * @return Edit
     */
    public function setUserId(int $value): Edit
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * IDs of the friend lists to which to add the user.
     * 
     * @param array $value
     * @return Edit
     */
    public function setListIds(array $value): Edit
    {
        $this->listIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['user_id'] = $this->userId;
        if ($this->listIds !== []) $params['list_ids'] = implode(',', $this->listIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->listIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('friends.edit', $params);
    }
}