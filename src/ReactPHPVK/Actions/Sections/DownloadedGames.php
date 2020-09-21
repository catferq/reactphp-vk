<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\DownloadedGames\GetPaidStatus;

class DownloadedGames
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function getPaidStatus(): GetPaidStatus
    {
        return new GetPaidStatus($this->_provider);
    }

}