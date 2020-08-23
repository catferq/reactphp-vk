<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class PrettyCards
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * prettyCards.create
     * 
     * @param int $ownerId
     * @param string $photo
     * @param string $title
     * @param string $link
     * @param string|null $price
     * @param string|null $priceOld
     * @param string|null $button
     * @param array|null $custom
     * @return Promise
     */
    function create(int $ownerId, string $photo, string $title, string $link, ?string $price = '', ?string $priceOld = '', ?string $button = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['photo'] = $photo;
        $sendParams['title'] = $title;
        $sendParams['link'] = $link;
        if ($price !== '' && $price != null) $sendParams['price'] = $price;
        if ($priceOld !== '' && $priceOld != null) $sendParams['price_old'] = $priceOld;
        if ($button !== '' && $button != null) $sendParams['button'] = $button;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('prettyCards.create', $sendParams);
    }

    /**
     * prettyCards.delete
     * 
     * @param int $ownerId
     * @param int $cardId
     * @param array|null $custom
     * @return Promise
     */
    function delete(int $ownerId, int $cardId, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['card_id'] = $cardId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('prettyCards.delete', $sendParams);
    }

    /**
     * prettyCards.edit
     * 
     * @param int $ownerId
     * @param int $cardId
     * @param string|null $photo
     * @param string|null $title
     * @param string|null $link
     * @param string|null $price
     * @param string|null $priceOld
     * @param string|null $button
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $ownerId, int $cardId, ?string $photo = '', ?string $title = '', ?string $link = '', ?string $price = '', ?string $priceOld = '', ?string $button = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['card_id'] = $cardId;
        if ($photo !== '' && $photo != null) $sendParams['photo'] = $photo;
        if ($title !== '' && $title != null) $sendParams['title'] = $title;
        if ($link !== '' && $link != null) $sendParams['link'] = $link;
        if ($price !== '' && $price != null) $sendParams['price'] = $price;
        if ($priceOld !== '' && $priceOld != null) $sendParams['price_old'] = $priceOld;
        if ($button !== '' && $button != null) $sendParams['button'] = $button;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('prettyCards.edit', $sendParams);
    }

    /**
     * prettyCards.get
     * 
     * @param int $ownerId
     * @param int|null $offset
     * @param int|null $count
     * @param array|null $custom
     * @return Promise
     */
    function get(int $ownerId, ?int $offset = 0, ?int $count = 10, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 10 && $count != null) $sendParams['count'] = $count;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('prettyCards.get', $sendParams);
    }

    /**
     * prettyCards.getById
     * 
     * @param int $ownerId
     * @param array $cardIds
     * @param array|null $custom
     * @return Promise
     */
    function getById(int $ownerId, array $cardIds, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['owner_id'] = $ownerId;
        $sendParams['card_ids'] = implode(',', $cardIds);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('prettyCards.getById', $sendParams);
    }

    /**
     * prettyCards.getUploadURL
     * 
     * @param array|null $custom
     * @return Promise
     */
    function getUploadURL(?array $custom = [])
    {
        $sendParams = [];


        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('prettyCards.getUploadURL', $sendParams);
    }
}