<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Auth\CheckPhone;
use ReactPHPVK\Actions\Sections\Auth\Restore;

class Auth
{
    private Provider $_provider;

    private ?Auth\CheckPhone $checkPhone = null;
    private ?Auth\Restore $restore = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Checks a user's phone number for correctness.
     */
    public function checkPhone(): CheckPhone
    {
        if (!$this->checkPhone) {
            $this->checkPhone = new CheckPhone($this->_provider);
        }
        return $this->checkPhone;
    }

    /**
     * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
     */
    public function restore(): Restore
    {
        if (!$this->restore) {
            $this->restore = new Restore($this->_provider);
        }
        return $this->restore;
    }

}