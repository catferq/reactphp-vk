<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddVideo
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $id = 0;
    private string $accessKey = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddVideo
     */
    public function _setCustom(array $value): AddVideo
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddVideo
     */
    public function setOwnerId(int $value): AddVideo
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddVideo
     */
    public function setId(int $value): AddVideo
    {
        $this->id = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddVideo
     */
    public function setAccessKey(string $value): AddVideo
    {
        $this->accessKey = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['id'] = $this->id;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->id = 0;
            $this->accessKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.addVideo', $params);
    }
}