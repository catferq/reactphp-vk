<?php

namespace ReactPHPVK\Actions\Sections\Newsfeed;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class DeleteList
{
    private Provider $_provider;
    
    private int $listId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return DeleteList
     */
    public function _setCustom(array $value): DeleteList
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return DeleteList
     */
    public function setListId(int $value): DeleteList
    {
        $this->listId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['list_id'] = $this->listId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->listId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('newsfeed.deleteList', $params);
    }
}