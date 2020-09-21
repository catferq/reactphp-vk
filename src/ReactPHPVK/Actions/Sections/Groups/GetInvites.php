<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of invitations to join communities and events.
 */
class GetInvites
{
    private Provider $_provider;
    
    private int $offset = 0;
    private int $count = 20;
    private bool $extended = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetInvites
     */
    public function _setCustom(array $value): GetInvites
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of invitations.
     * 
     * @param int $value
     * @return GetInvites
     */
    public function setOffset(int $value): GetInvites
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of invitations to return.
     * 
     * @param int $value
     * @return GetInvites
     */
    public function setCount(int $value): GetInvites
    {
        $this->count = $value;
        return $this;
    }

    /**
     * '1' — to return additional [vk.com/dev/fields_groups|fields] for communities..
     * 
     * @param bool $value
     * @return GetInvites
     */
    public function setExtended(bool $value): GetInvites
    {
        $this->extended = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 20) $params['count'] = $this->count;
        if ($this->extended !== false) $params['extended'] = intval($this->extended);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->offset = 0;
            $this->count = 20;
            $this->extended = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.getInvites', $params);
    }
}