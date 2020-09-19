<?php

namespace ReactPHPVK\Actions\Sections\Leads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Completes the lead started by user.
 */
class Complete
{
    private Provider $_provider;
    
    private string $vkSid = '';
    private string $secret = '';
    private string $comment = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Complete
     */
    public function _setCustom(array $value): Complete
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Session obtained as GET parameter when session started.
     * 
     * @param string $value
     * @return Complete
     */
    public function setVkSid(string $value): Complete
    {
        $this->vkSid = $value;
        return $this;
    }

    /**
     * Secret key from the lead testing interface.
     * 
     * @param string $value
     * @return Complete
     */
    public function setSecret(string $value): Complete
    {
        $this->secret = $value;
        return $this;
    }

    /**
     * Comment text.
     * 
     * @param string $value
     * @return Complete
     */
    public function setComment(string $value): Complete
    {
        $this->comment = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['vk_sid'] = $this->vkSid;
        $params['secret'] = $this->secret;
        if ($this->comment !== '') $params['comment'] = $this->comment;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->vkSid = '';
            $this->secret = '';
            $this->comment = '';
            $this->_custom = [];
        }

        return $this->_provider->request('leads.complete', $params);
    }
}