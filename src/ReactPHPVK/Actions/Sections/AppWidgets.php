<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\AppWidgets\Update;

class AppWidgets
{
    private Provider $_provider;

    private ?AppWidgets\Update $update = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Allows to update community app widget
     */
    public function update(): Update
    {
        if (!$this->update) {
            $this->update = new Update($this->_provider);
        }
        return $this->update;
    }

}