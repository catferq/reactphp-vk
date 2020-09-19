<?php

namespace ReactPHPVK\Actions\Sections\Polls;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Edits created polls
 */
class Edit
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $pollId = 0;
    private string $question = '';
    private string $addAnswers = '';
    private string $editAnswers = '';
    private string $deleteAnswers = '';
    private int $endDate = 0;
    private int $photoId = 0;
    private string $backgroundId = '';
    
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
     * poll owner id
     * 
     * @param int $value
     * @return Edit
     */
    public function setOwnerId(int $value): Edit
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * edited poll's id
     * 
     * @param int $value
     * @return Edit
     */
    public function setPollId(int $value): Edit
    {
        $this->pollId = $value;
        return $this;
    }

    /**
     * new question text
     * 
     * @param string $value
     * @return Edit
     */
    public function setQuestion(string $value): Edit
    {
        $this->question = $value;
        return $this;
    }

    /**
     * answers list, for example: , "["yes","no","maybe"]"
     * 
     * @param string $value
     * @return Edit
     */
    public function setAddAnswers(string $value): Edit
    {
        $this->addAnswers = $value;
        return $this;
    }

    /**
     * object containing answers that need to be edited,, key – answer id, value – new answer text. Example: {"382967099":"option1", "382967103":"option2"}"
     * 
     * @param string $value
     * @return Edit
     */
    public function setEditAnswers(string $value): Edit
    {
        $this->editAnswers = $value;
        return $this;
    }

    /**
     * list of answer ids to be deleted. For example: "[382967099, 382967103]"
     * 
     * @param string $value
     * @return Edit
     */
    public function setDeleteAnswers(string $value): Edit
    {
        $this->deleteAnswers = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setEndDate(int $value): Edit
    {
        $this->endDate = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Edit
     */
    public function setPhotoId(int $value): Edit
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Edit
     */
    public function setBackgroundId(string $value): Edit
    {
        $this->backgroundId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        $params['poll_id'] = $this->pollId;
        if ($this->question !== '') $params['question'] = $this->question;
        if ($this->addAnswers !== '') $params['add_answers'] = $this->addAnswers;
        if ($this->editAnswers !== '') $params['edit_answers'] = $this->editAnswers;
        if ($this->deleteAnswers !== '') $params['delete_answers'] = $this->deleteAnswers;
        if ($this->endDate !== 0) $params['end_date'] = $this->endDate;
        if ($this->photoId !== 0) $params['photo_id'] = $this->photoId;
        if ($this->backgroundId !== '') $params['background_id'] = $this->backgroundId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->pollId = 0;
            $this->question = '';
            $this->addAnswers = '';
            $this->editAnswers = '';
            $this->deleteAnswers = '';
            $this->endDate = 0;
            $this->photoId = 0;
            $this->backgroundId = '';
            $this->_custom = [];
        }

        return $this->_provider->request('polls.edit', $params);
    }
}