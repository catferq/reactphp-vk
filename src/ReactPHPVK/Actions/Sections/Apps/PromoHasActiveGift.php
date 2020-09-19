<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class PromoHasActiveGift
{
    private Provider $_provider;
    
    private int $promoId = 0;
    private int $userId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return PromoHasActiveGift
     */
    public function _setCustom(array $value): PromoHasActiveGift
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Id of game promo action
     * 
     * @param int $value
     * @return PromoHasActiveGift
     */
    public function setPromoId(int $value): PromoHasActiveGift
    {
        $this->promoId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return PromoHasActiveGift
     */
    public function setUserId(int $value): PromoHasActiveGift
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['promo_id'] = $this->promoId;
        if ($this->userId !== 0) $params['user_id'] = $this->userId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->promoId = 0;
            $this->userId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('apps.promoHasActiveGift', $params);
    }
}