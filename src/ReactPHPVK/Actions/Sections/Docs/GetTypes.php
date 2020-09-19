<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns documents types available for current user.
 */
class GetTypes
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetTypes
     */
    public function _setCustom(array $value): GetTypes
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user or community that owns the documents. Use a negative value to designate a community ID.
     * 
     * @param int $value
     * @return GetTypes
     */
    public function setOwnerId(int $value): GetTypes
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.getTypes', $params);
    }
}