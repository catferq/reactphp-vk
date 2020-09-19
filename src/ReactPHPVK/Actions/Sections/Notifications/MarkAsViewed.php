<?php

namespace ReactPHPVK\Actions\Sections\Notifications;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
 */
class MarkAsViewed
{
    private Provider $_provider;
    
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return MarkAsViewed
     */
    public function _setCustom(array $value): MarkAsViewed
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->_custom = [];
        }

        return $this->_provider->request('notifications.markAsViewed', $params);
    }
}