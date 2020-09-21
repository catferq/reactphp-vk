<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a new note for the current user.
 */
class Add
{
    private Provider $_provider;
    
    private string $title = '';
    private string $text = '';
    private array $privacyView = [];
    private array $privacyComment = [];
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Add
     */
    public function _setCustom(array $value): Add
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Note title.
     * 
     * @param string $value
     * @return Add
     */
    public function setTitle(string $value): Add
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Note text.
     * 
     * @param string $value
     * @return Add
     */
    public function setText(string $value): Add
    {
        $this->text = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Add
     */
    public function setPrivacyView(array $value): Add
    {
        $this->privacyView = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Add
     */
    public function setPrivacyComment(array $value): Add
    {
        $this->privacyComment = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['title'] = $this->title;
        $params['text'] = $this->text;
        if ($this->privacyView !== []) $params['privacy_view'] = implode(',', $this->privacyView);
        if ($this->privacyComment !== []) $params['privacy_comment'] = implode(',', $this->privacyComment);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->title = '';
            $this->text = '';
            $this->privacyView = [];
            $this->privacyComment = [];
            $this->_custom = [];
        }

        return $this->_provider->request('notes.add', $params);
    }
}