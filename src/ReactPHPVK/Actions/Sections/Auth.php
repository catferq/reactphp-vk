<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Auth\CheckPhone;
use ReactPHPVK\Actions\Sections\Auth\Restore;

class Auth
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Checks a user's phone number for correctness.
     */
    public function checkPhone(): CheckPhone
    {
        return new CheckPhone($this->_provider);
    }

    /**
     * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
     */
    public function restore(): Restore
    {
        return new Restore($this->_provider);
    }

}