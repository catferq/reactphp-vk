<?php

namespace ReactPHPVK\Actions\Sections\PrettyCards;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $cardId = 0;
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
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setOwnerId(int $value): Edit
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setCardId(int $value): Edit
    {
        $this->cardId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setPhoto(string $value): Edit
    {
        $this->photo = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setTitle(string $value): Edit
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setLink(string $value): Edit
    {
        $this->link = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setPrice(string $value): Edit
    {
        $this->price = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setPriceOld(string $value): Edit
    {
        $this->priceOld = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setButton(string $value): Edit
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
        $params['card_id'] = $this->cardId;
        if ($this->photo !== '') $params['photo'] = $this->photo;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->link !== '') $params['link'] = $this->link;
        if ($this->price !== '') $params['price'] = $this->price;
        if ($this->priceOld !== '') $params['price_old'] = $this->priceOld;
        if ($this->button !== '') $params['button'] = $this->button;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->cardId = 0;
            $this->photo = '';
            $this->title = '';
            $this->link = '';
            $this->price = '';
            $this->priceOld = '';
            $this->button = '';
            $this->_custom = [];
        }

        return $this->_provider->request('prettyCards.edit', $params);
    }
}