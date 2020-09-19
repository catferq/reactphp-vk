<?php

namespace ReactPHPVK\Actions\Sections\Stories;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to hide stories from chosen sources from current user's feed.
 */
class BanOwner
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
     * @return BanOwner
     */
    public function _setCustom(array $value): BanOwner
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * List of sources IDs
     * 
     * @param array $value
     * @return BanOwner
     */
    public function setOwnersIds(array $value): BanOwner
    {
        $this->ownersIds = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owners_ids'] = implode(',', $this->ownersIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownersIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('stories.banOwner', $params);
    }
}