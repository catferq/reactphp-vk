<?php

namespace ReactPHPVK\Actions\Sections\Market;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Sends a complaint to the item.
 */
class Report
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $itemId = 0;
    private int $reason = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Report
     */
    public function _setCustom(array $value): Report
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of an item owner community.
     * 
     * @param int $value
     * @return Report
     */
    public function setOwnerId(int $value): Report
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * Item ID.
     * 
     * @param int $value
     * @return Report
     */
    public function setItemId(int $value): Report
    {
        $this->itemId = $value;
        return $this;
    }

    /**
     * Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' — insult.
     * 
     * @param int $value
     * @return Report
     */
    public function setReason(int $value): Report
    {
        $this->reason = $value;
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
        $params['item_id'] = $this->itemId;
        if ($this->reason !== 0) $params['reason'] = $this->reason;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->itemId = 0;
            $this->reason = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('market.report', $params);
    }
}