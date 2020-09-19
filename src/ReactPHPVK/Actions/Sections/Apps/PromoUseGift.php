<?php

namespace ReactPHPVK\Actions\Sections\Apps;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class PromoUseGift
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
     * @return PromoUseGift
     */
    public function _setCustom(array $value): PromoUseGift
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Id of game promo action
     * 
     * @param int $value
     * @return PromoUseGift
     */
    public function setPromoId(int $value): PromoUseGift
    {
        $this->promoId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return PromoUseGift
     */
    public function setUserId(int $value): PromoUseGift
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

        return $this->_provider->request('apps.promoUseGift', $params);
    }
}