<?php

namespace ReactPHPVK\Actions\Sections\Friends;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of user IDs of the mutual friends of two users.
 */
class GetMutual
{
    private Provider $_provider;
    
    private int $sourceUid = 0;
    private int $targetUid = 0;
    private array $targetUids = [];
    private string $order = '';
    private int $count = 0;
    private int $offset = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMutual
     */
    public function _setCustom(array $value): GetMutual
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user whose friends will be checked against the friends of the user specified in 'target_uid'.
     * 
     * @param int $value
     * @return GetMutual
     */
    public function setSourceUid(int $value): GetMutual
    {
        $this->sourceUid = $value;
        return $this;
    }

    /**
     * ID of the user whose friends will be checked against the friends of the user specified in 'source_uid'.
     * 
     * @param int $value
     * @return GetMutual
     */
    public function setTargetUid(int $value): GetMutual
    {
        $this->targetUid = $value;
        return $this;
    }

    /**
     * IDs of the users whose friends will be checked against the friends of the user specified in 'source_uid'.
     * 
     * @param array $value
     * @return GetMutual
     */
    public function setTargetUids(array $value): GetMutual
    {
        $this->targetUids = $value;
        return $this;
    }

    /**
     * Sort order: 'random' — random order
     * 
     * @param string $value
     * @return GetMutual
     */
    public function setOrder(string $value): GetMutual
    {
        $this->order = $value;
        return $this;
    }

    /**
     * Number of mutual friends to return.
     * 
     * @param int $value
     * @return GetMutual
     */
    public function setCount(int $value): GetMutual
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of mutual friends.
     * 
     * @param int $value
     * @return GetMutual
     */
    public function setOffset(int $value): GetMutual
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->sourceUid !== 0) $params['source_uid'] = $this->sourceUid;
        if ($this->targetUid !== 0) $params['target_uid'] = $this->targetUid;
        if ($this->targetUids !== []) $params['target_uids'] = implode(',', $this->targetUids);
        if ($this->order !== '') $params['order'] = $this->order;
        if ($this->count !== 0) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->sourceUid = 0;
            $this->targetUid = 0;
            $this->targetUids = [];
            $this->order = '';
            $this->count = 0;
            $this->offset = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('friends.getMutual', $params);
    }
}