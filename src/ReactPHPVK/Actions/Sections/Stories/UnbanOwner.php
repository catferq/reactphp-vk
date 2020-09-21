<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to show stories from hidden sources in current user's feed.
 */
class UnbanOwner
{
    private Provider $_provider;
    
    private array $ownersIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return UnbanOwner
     */
    public function _setCustom(array $value): UnbanOwner
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * List of hidden sources to show stories from.
     * 
     * @param array $value
     * @return UnbanOwner
     */
    public function setOwnersIds(array $value): UnbanOwner
    {
        $this->ownersIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owners_ids'] = implode(',', $this->ownersIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownersIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stories.unbanOwner', $params);
    }
}