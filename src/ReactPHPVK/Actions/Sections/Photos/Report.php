<?php

namespace ReactPHPVK\Actions\Sections\Photos;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reports (submits a complaint about) a photo.
 */
class Report
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $photoId = 0;
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
     * ID of the user or community that owns the photo.
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
     * Photo ID.
     * 
     * @param int $value
     * @return Report
     */
    public function setPhotoId(int $value): Report
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
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
        $params['photo_id'] = $this->photoId;
        if ($this->reason !== 0) $params['reason'] = $this->reason;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->photoId = 0;
            $this->reason = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('photos.report', $params);
    }
}