<?php

namespace ReactPHPVK\Actions\Sections\PrettyCards;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class GetById
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private array $cardIds = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetById
     */
    public function _setCustom(array $value): GetById
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return GetById
     */
    public function setOwnerId(int $value): GetById
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return GetById
     */
    public function setCardIds(array $value): GetById
    {
        $this->cardIds = $value;
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
        $params['card_ids'] = implode(',', $this->cardIds);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->cardIds = [];
            $this->_custom = [];
        }

        return $this->_provider->request('prettyCards.getById', $params);
    }
}