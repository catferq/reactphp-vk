<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class AppWidgets
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Allows to update community app widget
     * 
     * @param string $code
     * @param string $type
     * @param array|null $custom
     * @return Promise
     */
    function update(string $code, string $type, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['code'] = $code;
        $sendParams['type'] = $type;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('appWidgets.update', $sendParams);
    }
}