<?php

namespace ReactPHPVK\Actions\Sections\Notes;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits a note of the current user.
 */
class Edit
{
    private Provider $_provider;
    
    private int $noteId = 0;
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
     * @return Edit
     */
    public function _setCustom(array $value): Edit
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Note ID.
     * 
     * @param int $value
     * @return Edit
     */
    public function setNoteId(int $value): Edit
    {
        $this->noteId = $value;
        return $this;
    }

    /**
     * Note title.
     * 
     * @param string $value
     * @return Edit
     */
    public function setTitle(string $value): Edit
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Note text.
     * 
     * @param string $value
     * @return Edit
     */
    public function setText(string $value): Edit
    {
        $this->text = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Edit
     */
    public function setPrivacyView(array $value): Edit
    {
        $this->privacyView = $value;
        return $this;
    }

    /**
     * @param array $value
     * @return Edit
     */
    public function setPrivacyComment(array $value): Edit
    {
        $this->privacyComment = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['note_id'] = $this->noteId;
        $params['title'] = $this->title;
        $params['text'] = $this->text;
        if ($this->privacyView !== []) $params['privacy_view'] = implode(',', $this->privacyView);
        if ($this->privacyComment !== []) $params['privacy_comment'] = implode(',', $this->privacyComment);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->noteId = 0;
            $this->title = '';
            $this->text = '';
            $this->privacyView = [];
            $this->privacyComment = [];
            $this->_custom = [];
        }

        return $this->_provider->request('notes.edit', $params);
    }
}