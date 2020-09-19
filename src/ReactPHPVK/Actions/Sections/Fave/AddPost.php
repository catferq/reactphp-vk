<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddPost
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
     * @return AddPost
     */
    public function _setCustom(array $value): AddPost
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddPost
     */
    public function setOwnerId(int $value): AddPost
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return AddPost
     */
    public function setId(int $value): AddPost
    {
        $this->id = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddPost
     */
    public function setAccessKey(string $value): AddPost
    {
        $this->accessKey = $value;
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
        $params['id'] = $this->id;
        if ($this->accessKey !== '') $params['access_key'] = $this->accessKey;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->id = 0;
            $this->accessKey = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.addPost', $params);
    }
}