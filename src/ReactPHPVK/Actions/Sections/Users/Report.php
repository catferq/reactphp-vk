<?php

namespace ReactPHPVK\Actions\Sections\Users;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Reports (submits a complain about) a user.
 */
class Report
{
    private Provider $_provider;
    
    private int $userId = 0;
    private string $type = '';
    private string $comment = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Report
     */
    public function _setCustom(array $value): Report
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * ID of the user about whom a complaint is being made.
     * 
     * @param int $value
     * @return Report
     */
    public function setUserId(int $value): Report
    {
        $this->userId = $value;
        return $this;
    }

    /**
     * Type of complaint: 'porn' – pornography, 'spam' – spamming, 'insult' – abusive behavior, 'advertisement' – disruptive advertisements
     * 
     * @param string $value
     * @return Report
     */
    public function setType(string $value): Report
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Comment describing the complaint.
     * 
     * @param string $value
     * @return Report
     */
    public function setComment(string $value): Report
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

        $params['user_id'] = $this->userId;
        $params['type'] = $this->type;
        if ($this->comment !== '') $params['comment'] = $this->comment;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->userId = 0;
            $this->type = '';
            $this->comment = '';
            $this->_custom = [];
        }

        return $this->_provider->request('users.report', $params);
    }
}