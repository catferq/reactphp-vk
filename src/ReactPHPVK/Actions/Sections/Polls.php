<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;
use React\Promise\Promise;

class Polls
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Adds the current user's vote to the selected answer in the poll.
     * 
     * @param int $pollId Poll ID.
     * @param array $answerIds
     * @param int|null $ownerId ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * @param bool|null $isBoard
     * @param array|null $custom
     * @return Promise
     */
    function addVote(int $pollId, array $answerIds, ?int $ownerId = 0, ?bool $isBoard = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['poll_id'] = $pollId;
        $sendParams['answer_ids'] = implode(',', $answerIds);
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($isBoard !== false && $isBoard != null) $sendParams['is_board'] = intval($isBoard);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('polls.addVote', $sendParams);
    }

    /**
     * Creates polls that can be attached to the users' or communities' posts.
     * 
     * @param string|null $question question text
     * @param bool|null $isAnonymous '1' – anonymous poll, participants list is hidden,, '0' – public poll, participants list is available,, Default value is '0'.
     * @param bool|null $isMultiple
     * @param int|null $endDate
     * @param int|null $ownerId If a poll will be added to a communty it is required to send a negative group identifier. Current user by default.
     * @param string|null $addAnswers available answers list, for example: " ["yes","no","maybe"]", There can be from 1 to 10 answers.
     * @param int|null $photoId
     * @param string|null $backgroundId
     * @param bool|null $disableUnvote
     * @param array|null $custom
     * @return Promise
     */
    function create(?string $question = '', ?bool $isAnonymous = false, ?bool $isMultiple = false, ?int $endDate = 0, ?int $ownerId = 0, ?string $addAnswers = '', ?int $photoId = 0, ?string $backgroundId = '', ?bool $disableUnvote = false, ?array $custom = [])
    {
        $sendParams = [];

        if ($question !== '' && $question != null) $sendParams['question'] = $question;
        if ($isAnonymous !== false && $isAnonymous != null) $sendParams['is_anonymous'] = intval($isAnonymous);
        if ($isMultiple !== false && $isMultiple != null) $sendParams['is_multiple'] = intval($isMultiple);
        if ($endDate !== 0 && $endDate != null) $sendParams['end_date'] = $endDate;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($addAnswers !== '' && $addAnswers != null) $sendParams['add_answers'] = $addAnswers;
        if ($photoId !== 0 && $photoId != null) $sendParams['photo_id'] = $photoId;
        if ($backgroundId !== '' && $backgroundId != null) $sendParams['background_id'] = $backgroundId;
        if ($disableUnvote !== false && $disableUnvote != null) $sendParams['disable_unvote'] = intval($disableUnvote);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('polls.create', $sendParams);
    }

    /**
     * Deletes the current user's vote from the selected answer in the poll.
     * 
     * @param int $pollId Poll ID.
     * @param int $answerId Answer ID.
     * @param int|null $ownerId ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * @param bool|null $isBoard
     * @param array|null $custom
     * @return Promise
     */
    function deleteVote(int $pollId, int $answerId, ?int $ownerId = 0, ?bool $isBoard = false, ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['poll_id'] = $pollId;
        $sendParams['answer_id'] = $answerId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($isBoard !== false && $isBoard != null) $sendParams['is_board'] = intval($isBoard);

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('polls.deleteVote', $sendParams);
    }

    /**
     * Edits created polls
     * 
     * @param int $pollId edited poll's id
     * @param int|null $ownerId poll owner id
     * @param string|null $question new question text
     * @param string|null $addAnswers answers list, for example: , "["yes","no","maybe"]"
     * @param string|null $editAnswers object containing answers that need to be edited,, key – answer id, value – new answer text. Example: {"382967099":"option1", "382967103":"option2"}"
     * @param string|null $deleteAnswers list of answer ids to be deleted. For example: "[382967099, 382967103]"
     * @param int|null $endDate
     * @param int|null $photoId
     * @param string|null $backgroundId
     * @param array|null $custom
     * @return Promise
     */
    function edit(int $pollId, ?int $ownerId = 0, ?string $question = '', ?string $addAnswers = '', ?string $editAnswers = '', ?string $deleteAnswers = '', ?int $endDate = 0, ?int $photoId = 0, ?string $backgroundId = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['poll_id'] = $pollId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($question !== '' && $question != null) $sendParams['question'] = $question;
        if ($addAnswers !== '' && $addAnswers != null) $sendParams['add_answers'] = $addAnswers;
        if ($editAnswers !== '' && $editAnswers != null) $sendParams['edit_answers'] = $editAnswers;
        if ($deleteAnswers !== '' && $deleteAnswers != null) $sendParams['delete_answers'] = $deleteAnswers;
        if ($endDate !== 0 && $endDate != null) $sendParams['end_date'] = $endDate;
        if ($photoId !== 0 && $photoId != null) $sendParams['photo_id'] = $photoId;
        if ($backgroundId !== '' && $backgroundId != null) $sendParams['background_id'] = $backgroundId;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('polls.edit', $sendParams);
    }

    /**
     * Returns detailed information about a poll by its ID.
     * 
     * @param int $pollId Poll ID.
     * @param int|null $ownerId ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * @param bool|null $isBoard '1' – poll is in a board, '0' – poll is on a wall. '0' by default.
     * @param bool|null $extended
     * @param int|null $friendsCount
     * @param array|null $fields
     * @param string|null $nameCase
     * @param array|null $custom
     * @return Promise
     */
    function getById(int $pollId, ?int $ownerId = 0, ?bool $isBoard = false, ?bool $extended = false, ?int $friendsCount = 3, ?array $fields = [], ?string $nameCase = 'nom', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['poll_id'] = $pollId;
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($isBoard !== false && $isBoard != null) $sendParams['is_board'] = intval($isBoard);
        if ($extended !== false && $extended != null) $sendParams['extended'] = intval($extended);
        if ($friendsCount !== 3 && $friendsCount != null) $sendParams['friends_count'] = $friendsCount;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== 'nom' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('polls.getById', $sendParams);
    }

    /**
     * Returns a list of IDs of users who selected specific answers in the poll.
     * 
     * @param int $pollId Poll ID.
     * @param array $answerIds Answer IDs.
     * @param int|null $ownerId ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * @param bool|null $isBoard
     * @param bool|null $friendsOnly '1' — to return only current user's friends, '0' — to return all users (default),
     * @param int|null $offset Offset needed to return a specific subset of voters. '0' — (default)
     * @param int|null $count Number of user IDs to return (if the 'friends_only' parameter is not set, maximum '1000', otherwise '10'). '100' — (default)
     * @param array|null $fields Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate (birthdate)', 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online', 'counters'.
     * @param string|null $nameCase Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
     * @param array|null $custom
     * @return Promise
     */
    function getVoters(int $pollId, array $answerIds, ?int $ownerId = 0, ?bool $isBoard = false, ?bool $friendsOnly = false, ?int $offset = 0, ?int $count = 0, ?array $fields = [], ?string $nameCase = '', ?array $custom = [])
    {
        $sendParams = [];

        $sendParams['poll_id'] = $pollId;
        $sendParams['answer_ids'] = implode(',', $answerIds);
        if ($ownerId !== 0 && $ownerId != null) $sendParams['owner_id'] = $ownerId;
        if ($isBoard !== false && $isBoard != null) $sendParams['is_board'] = intval($isBoard);
        if ($friendsOnly !== false && $friendsOnly != null) $sendParams['friends_only'] = intval($friendsOnly);
        if ($offset !== 0 && $offset != null) $sendParams['offset'] = $offset;
        if ($count !== 0 && $count != null) $sendParams['count'] = $count;
        if ($fields !== [] && $fields != null) $sendParams['fields'] = implode(',', $fields);
        if ($nameCase !== '' && $nameCase != null) $sendParams['name_case'] = $nameCase;

        if ($custom !== [] && $custom != null) $sendParams = array_merge($sendParams, $custom);

        return $this->provider->request('polls.getVoters', $sendParams);
    }
}