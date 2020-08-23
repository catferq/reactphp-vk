<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Auth
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Checks a user's phone number for correctness.
     * 
     * @param string $phone Phone number.
     * @param int|null $clientId User ID.
     * @param string|null $clientSecret
     * @param bool|null $authByPhone
     * @param array|null $custom
     * @return Promise
     */
    function checkPhone(string $phone, ?int $clientId = 0, ?string $clientSecret = '', ?bool $authByPhone = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['phone'] = $phone;
        if ($clientId !== 0 && $clientId != null) $sendParams['client_id'] = $clientId;
        if ($clientSecret !== '' && $clientSecret != null) $sendParams['client_secret'] = $clientSecret;
        if ($authByPhone !== false && $authByPhone != null) $sendParams['auth_by_phone'] = intval($authByPhone);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('auth.checkPhone', $sendParams);
    }

    /**
     * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
     * 
     * @param string $phone User phone number.
     * @param string $lastName User last name.
     * @param array|null $custom
     * @return Promise
     */
    function restore(string $phone, string $lastName, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['phone'] = $phone;
        $sendParams['last_name'] = $lastName;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('auth.restore', $sendParams);
    }
}