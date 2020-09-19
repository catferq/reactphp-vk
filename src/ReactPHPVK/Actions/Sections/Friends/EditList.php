<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a friend list of the current user.
 */
class EditList
{
    private Provider $_provider;
    
    private string $name = '';
    private int $listId = 0;
    private array $userIds = [];
    private array $addUserIds = [];
    private array $deleteUserIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return EditList
     */
    public function _setCustom(array $value): EditList
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Name of the friend list.
     * 
     * @param string $value
     * @return EditList
     */
    public function setName(string $value): EditList
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Friend list ID.
     * 
     * @param int $value
     * @return EditList
     */
    public function setListId(int $value): EditList
    {
        $this->listId = $value;
        return $this;
    }

    /**
     * IDs of users in the friend list.
     * 
     * @param array $value
     * @return EditList
     */
    public function setUserIds(array $value): EditList
    {
        $this->userIds = $value;
        return $this;
    }

    /**
     * (Applies if 'user_ids' parameter is not set.), User IDs to add to the friend list.
     * 
     * @param array $value
     * @return EditList
     */
    public function setAddUserIds(array $value): EditList
    {
        $this->addUserIds = $value;
        return $this;
    }

    /**
     * (Applies if 'user_ids' parameter is not set.), User IDs to delete from the friend list.
     * 
     * @param array $value
     * @return EditList
     */
    public function setDeleteUserIds(array $value): EditList
    {
        $this->deleteUserIds = $value;
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
        $params['list_id'] = $this->listId;
        if ($this->userIds !== []) $params['user_ids'] = implode(',', $this->userIds);
        if ($this->addUserIds !== []) $params['add_user_ids'] = implode(',', $this->addUserIds);
        if ($this->deleteUserIds !== []) $params['delete_user_ids'] = implode(',', $this->deleteUserIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->name = '';
            $this->listId = 0;
            $this->userIds = [];
            $this->addUserIds = [];
            $this->deleteUserIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('friends.editList', $params);
    }
}