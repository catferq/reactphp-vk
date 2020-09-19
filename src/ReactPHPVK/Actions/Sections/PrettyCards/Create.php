<?php

namespace ReactPHPVK\Actions\Sections\PrettyCards;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Create
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private string $photo = '';
    private string $title = '';
    private string $link = '';
    private string $price = '';
    private string $priceOld = '';
    private string $button = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Create
     */
    public function _setCustom(array $value): Create
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Create
     */
    public function setOwnerId(int $value): Create
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setPhoto(string $value): Create
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setTitle(string $value): Create
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setLink(string $value): Create
    {
        $this->link = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setPrice(string $value): Create
    {
        $this->price = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setPriceOld(string $value): Create
    {
        $this->priceOld = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setButton(string $value): Create
    {
        $this->button = $value;
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
        $params['photo'] = $this->photo;
        $params['title'] = $this->title;
        $params['link'] = $this->link;
        if ($this->price !== '') $params['price'] = $this->price;
        if ($this->priceOld !== '') $params['price_old'] = $this->priceOld;
        if ($this->button !== '') $params['button'] = $this->button;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photo = '';
            $this->title = '';
            $this->link = '';
            $this->price = '';
            $this->priceOld = '';
            $this->button = '';
            $this->_custom = [];
        }

        return $this->_provider->request('prettyCards.create', $params);
    }
}