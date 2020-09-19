<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\DownloadedGames\GetPaidStatus;

class DownloadedGames
{
    private Provider $_provider;

    private ?DownloadedGames\GetPaidStatus $getPaidStatus = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function getPaidStatus(): GetPaidStatus
    {
        if (!$this->getPaidStatus) {
            $this->getPaidStatus = new GetPaidStatus($this->_provider);
        }
        return $this->getPaidStatus;
    }

}