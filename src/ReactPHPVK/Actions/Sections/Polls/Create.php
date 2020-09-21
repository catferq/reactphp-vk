<?php

namespace ReactPHPVK\Actions\Sections\Polls;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates polls that can be attached to the users' or communities' posts.
 */
class Create
{
    private Provider $_provider;
    
    private string $question = '';
    private bool $isAnonymous = false;
    private bool $isMultiple = false;
    private int $endDate = 0;
    private int $ownerId = 0;
    private string $addAnswers = '';
    private int $photoId = 0;
    private string $backgroundId = '';
    private bool $disableUnvote = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Create
     */
    public function _setCustom(array $value): Create
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * question text
     * 
     * @param string $value
     * @return Create
     */
    public function setQuestion(string $value): Create
    {
        $this->question = $value;
        return $this;
    }

    /**
     * '1' – anonymous poll, participants list is hidden,, '0' – public poll, participants list is available,, Default value is '0'.
     * 
     * @param bool $value
     * @return Create
     */
    public function setIsAnonymous(bool $value): Create
    {
        $this->isAnonymous = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Create
     */
    public function setIsMultiple(bool $value): Create
    {
        $this->isMultiple = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Create
     */
    public function setEndDate(int $value): Create
    {
        $this->endDate = $value;
        return $this;
    }

    /**
     * If a poll will be added to a communty it is required to send a negative group identifier. Current user by default.
     * 
     * @param int $value
     * @return Create
     */
    public function setOwnerId(int $value): Create
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * available answers list, for example: " ["yes","no","maybe"]", There can be from 1 to 10 answers.
     * 
     * @param string $value
     * @return Create
     */
    public function setAddAnswers(string $value): Create
    {
        $this->addAnswers = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return Create
     */
    public function setPhotoId(int $value): Create
    {
        $this->photoId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Create
     */
    public function setBackgroundId(string $value): Create
    {
        $this->backgroundId = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Create
     */
    public function setDisableUnvote(bool $value): Create
    {
        $this->disableUnvote = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->question !== '') $params['question'] = $this->question;
        if ($this->isAnonymous !== false) $params['is_anonymous'] = intval($this->isAnonymous);
        if ($this->isMultiple !== false) $params['is_multiple'] = intval($this->isMultiple);
        if ($this->endDate !== 0) $params['end_date'] = $this->endDate;
        if ($this->ownerId !== 0) $params['owner_id'] = $this->ownerId;
        if ($this->addAnswers !== '') $params['add_answers'] = $this->addAnswers;
        if ($this->photoId !== 0) $params['photo_id'] = $this->photoId;
        if ($this->backgroundId !== '') $params['background_id'] = $this->backgroundId;
        if ($this->disableUnvote !== false) $params['disable_unvote'] = intval($this->disableUnvote);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->question = '';
            $this->isAnonymous = false;
            $this->isMultiple = false;
            $this->endDate = 0;
            $this->ownerId = 0;
            $this->addAnswers = '';
            $this->photoId = 0;
            $this->backgroundId = '';
            $this->disableUnvote = false;
            $this->_custom = [];
        }

        return $this->_provider->request('polls.create', $params);
    }
}