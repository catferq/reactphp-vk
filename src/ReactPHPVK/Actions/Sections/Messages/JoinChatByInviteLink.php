<?php

namespace ReactPHPVK\Actions\Sections\Messages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class JoinChatByInviteLink
{
    private Provider $_provider;
    
    private string $link = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return JoinChatByInviteLink
     */
    public function _setCustom(array $value): JoinChatByInviteLink
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Invitation link.
     * 
     * @param string $value
     * @return JoinChatByInviteLink
     */
    public function setLink(string $value): JoinChatByInviteLink
    {
        $this->link = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['link'] = $this->link;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->link = '';
            $this->_custom = [];
        }

        return $this->_provider->request('messages.joinChatByInviteLink', $params);
    }
}