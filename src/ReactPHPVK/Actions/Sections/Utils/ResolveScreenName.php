<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Detects a type of object (e.g., user, community, application) and its ID by screen name.
 */
class ResolveScreenName
{
    private Provider $_provider;
    
    private string $screenName = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ResolveScreenName
     */
    public function _setCustom(array $value): ResolveScreenName
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Screen name of the user, community (e.g., 'apiclub,' 'andrew', or 'rules_of_war'), or application.
     * 
     * @param string $value
     * @return ResolveScreenName
     */
    public function setScreenName(string $value): ResolveScreenName
    {
        $this->screenName = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['screen_name'] = $this->screenName;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->screenName = '';
            $this->_custom = [];
        }

        return $this->_provider->request('utils.resolveScreenName', $params);
    }
}