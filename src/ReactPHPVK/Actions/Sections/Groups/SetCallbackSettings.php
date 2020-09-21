<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allow to set notifications settings for group.
 */
class SetCallbackSettings
{
    private Provider $_provider;
    
    private int $groupId = 0;
    private int $serverId = 0;
    private string $apiVersion = '';
    private bool $messageNew = false;
    private bool $messageReply = false;
    private bool $messageAllow = false;
    private bool $messageEdit = false;
    private bool $messageDeny = false;
    private bool $messageTypingState = false;
    private bool $photoNew = false;
    private bool $audioNew = false;
    private bool $videoNew = false;
    private bool $wallReplyNew = false;
    private bool $wallReplyEdit = false;
    private bool $wallReplyDelete = false;
    private bool $wallReplyRestore = false;
    private bool $wallPostNew = false;
    private bool $wallRepost = false;
    private bool $boardPostNew = false;
    private bool $boardPostEdit = false;
    private bool $boardPostRestore = false;
    private bool $boardPostDelete = false;
    private bool $photoCommentNew = false;
    private bool $photoCommentEdit = false;
    private bool $photoCommentDelete = false;
    private bool $photoCommentRestore = false;
    private bool $videoCommentNew = false;
    private bool $videoCommentEdit = false;
    private bool $videoCommentDelete = false;
    private bool $videoCommentRestore = false;
    private bool $marketCommentNew = false;
    private bool $marketCommentEdit = false;
    private bool $marketCommentDelete = false;
    private bool $marketCommentRestore = false;
    private bool $pollVoteNew = false;
    private bool $groupJoin = false;
    private bool $groupLeave = false;
    private bool $groupChangeSettings = false;
    private bool $groupChangePhoto = false;
    private bool $groupOfficersEdit = false;
    private bool $userBlock = false;
    private bool $userUnblock = false;
    private bool $leadFormsNew = false;
    private bool $likeAdd = false;
    private bool $likeRemove = false;
    private bool $messageEvent = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return SetCallbackSettings
     */
    public function _setCustom(array $value): SetCallbackSettings
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community ID.
     * 
     * @param int $value
     * @return SetCallbackSettings
     */
    public function setGroupId(int $value): SetCallbackSettings
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * Server ID.
     * 
     * @param int $value
     * @return SetCallbackSettings
     */
    public function setServerId(int $value): SetCallbackSettings
    {
        $this->serverId = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return SetCallbackSettings
     */
    public function setApiVersion(string $value): SetCallbackSettings
    {
        $this->apiVersion = $value;
        return $this;
    }

    /**
     * A new incoming message has been received ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageNew(bool $value): SetCallbackSettings
    {
        $this->messageNew = $value;
        return $this;
    }

    /**
     * A new outcoming message has been received ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageReply(bool $value): SetCallbackSettings
    {
        $this->messageReply = $value;
        return $this;
    }

    /**
     * Allowed messages notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageAllow(bool $value): SetCallbackSettings
    {
        $this->messageAllow = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageEdit(bool $value): SetCallbackSettings
    {
        $this->messageEdit = $value;
        return $this;
    }

    /**
     * Denied messages notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageDeny(bool $value): SetCallbackSettings
    {
        $this->messageDeny = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageTypingState(bool $value): SetCallbackSettings
    {
        $this->messageTypingState = $value;
        return $this;
    }

    /**
     * New photos notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setPhotoNew(bool $value): SetCallbackSettings
    {
        $this->photoNew = $value;
        return $this;
    }

    /**
     * New audios notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setAudioNew(bool $value): SetCallbackSettings
    {
        $this->audioNew = $value;
        return $this;
    }

    /**
     * New videos notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setVideoNew(bool $value): SetCallbackSettings
    {
        $this->videoNew = $value;
        return $this;
    }

    /**
     * New wall replies notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setWallReplyNew(bool $value): SetCallbackSettings
    {
        $this->wallReplyNew = $value;
        return $this;
    }

    /**
     * Wall replies edited notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setWallReplyEdit(bool $value): SetCallbackSettings
    {
        $this->wallReplyEdit = $value;
        return $this;
    }

    /**
     * A wall comment has been deleted ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setWallReplyDelete(bool $value): SetCallbackSettings
    {
        $this->wallReplyDelete = $value;
        return $this;
    }

    /**
     * A wall comment has been restored ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setWallReplyRestore(bool $value): SetCallbackSettings
    {
        $this->wallReplyRestore = $value;
        return $this;
    }

    /**
     * New wall posts notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setWallPostNew(bool $value): SetCallbackSettings
    {
        $this->wallPostNew = $value;
        return $this;
    }

    /**
     * New wall posts notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setWallRepost(bool $value): SetCallbackSettings
    {
        $this->wallRepost = $value;
        return $this;
    }

    /**
     * New board posts notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setBoardPostNew(bool $value): SetCallbackSettings
    {
        $this->boardPostNew = $value;
        return $this;
    }

    /**
     * Board posts edited notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setBoardPostEdit(bool $value): SetCallbackSettings
    {
        $this->boardPostEdit = $value;
        return $this;
    }

    /**
     * Board posts restored notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setBoardPostRestore(bool $value): SetCallbackSettings
    {
        $this->boardPostRestore = $value;
        return $this;
    }

    /**
     * Board posts deleted notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setBoardPostDelete(bool $value): SetCallbackSettings
    {
        $this->boardPostDelete = $value;
        return $this;
    }

    /**
     * New comment to photo notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setPhotoCommentNew(bool $value): SetCallbackSettings
    {
        $this->photoCommentNew = $value;
        return $this;
    }

    /**
     * A photo comment has been edited ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setPhotoCommentEdit(bool $value): SetCallbackSettings
    {
        $this->photoCommentEdit = $value;
        return $this;
    }

    /**
     * A photo comment has been deleted ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setPhotoCommentDelete(bool $value): SetCallbackSettings
    {
        $this->photoCommentDelete = $value;
        return $this;
    }

    /**
     * A photo comment has been restored ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setPhotoCommentRestore(bool $value): SetCallbackSettings
    {
        $this->photoCommentRestore = $value;
        return $this;
    }

    /**
     * New comment to video notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setVideoCommentNew(bool $value): SetCallbackSettings
    {
        $this->videoCommentNew = $value;
        return $this;
    }

    /**
     * A video comment has been edited ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setVideoCommentEdit(bool $value): SetCallbackSettings
    {
        $this->videoCommentEdit = $value;
        return $this;
    }

    /**
     * A video comment has been deleted ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setVideoCommentDelete(bool $value): SetCallbackSettings
    {
        $this->videoCommentDelete = $value;
        return $this;
    }

    /**
     * A video comment has been restored ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setVideoCommentRestore(bool $value): SetCallbackSettings
    {
        $this->videoCommentRestore = $value;
        return $this;
    }

    /**
     * New comment to market item notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMarketCommentNew(bool $value): SetCallbackSettings
    {
        $this->marketCommentNew = $value;
        return $this;
    }

    /**
     * A market comment has been edited ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMarketCommentEdit(bool $value): SetCallbackSettings
    {
        $this->marketCommentEdit = $value;
        return $this;
    }

    /**
     * A market comment has been deleted ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMarketCommentDelete(bool $value): SetCallbackSettings
    {
        $this->marketCommentDelete = $value;
        return $this;
    }

    /**
     * A market comment has been restored ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMarketCommentRestore(bool $value): SetCallbackSettings
    {
        $this->marketCommentRestore = $value;
        return $this;
    }

    /**
     * A vote in a public poll has been added ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setPollVoteNew(bool $value): SetCallbackSettings
    {
        $this->pollVoteNew = $value;
        return $this;
    }

    /**
     * Joined community notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setGroupJoin(bool $value): SetCallbackSettings
    {
        $this->groupJoin = $value;
        return $this;
    }

    /**
     * Left community notifications ('0' — disabled, '1' — enabled).
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setGroupLeave(bool $value): SetCallbackSettings
    {
        $this->groupLeave = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setGroupChangeSettings(bool $value): SetCallbackSettings
    {
        $this->groupChangeSettings = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setGroupChangePhoto(bool $value): SetCallbackSettings
    {
        $this->groupChangePhoto = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setGroupOfficersEdit(bool $value): SetCallbackSettings
    {
        $this->groupOfficersEdit = $value;
        return $this;
    }

    /**
     * User added to community blacklist
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setUserBlock(bool $value): SetCallbackSettings
    {
        $this->userBlock = $value;
        return $this;
    }

    /**
     * User removed from community blacklist
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setUserUnblock(bool $value): SetCallbackSettings
    {
        $this->userUnblock = $value;
        return $this;
    }

    /**
     * New form in lead forms
     * 
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setLeadFormsNew(bool $value): SetCallbackSettings
    {
        $this->leadFormsNew = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setLikeAdd(bool $value): SetCallbackSettings
    {
        $this->likeAdd = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setLikeRemove(bool $value): SetCallbackSettings
    {
        $this->likeRemove = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return SetCallbackSettings
     */
    public function setMessageEvent(bool $value): SetCallbackSettings
    {
        $this->messageEvent = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['group_id'] = $this->groupId;
        if ($this->serverId !== 0) $params['server_id'] = $this->serverId;
        if ($this->apiVersion !== '') $params['api_version'] = $this->apiVersion;
        if ($this->messageNew !== false) $params['message_new'] = intval($this->messageNew);
        if ($this->messageReply !== false) $params['message_reply'] = intval($this->messageReply);
        if ($this->messageAllow !== false) $params['message_allow'] = intval($this->messageAllow);
        if ($this->messageEdit !== false) $params['message_edit'] = intval($this->messageEdit);
        if ($this->messageDeny !== false) $params['message_deny'] = intval($this->messageDeny);
        if ($this->messageTypingState !== false) $params['message_typing_state'] = intval($this->messageTypingState);
        if ($this->photoNew !== false) $params['photo_new'] = intval($this->photoNew);
        if ($this->audioNew !== false) $params['audio_new'] = intval($this->audioNew);
        if ($this->videoNew !== false) $params['video_new'] = intval($this->videoNew);
        if ($this->wallReplyNew !== false) $params['wall_reply_new'] = intval($this->wallReplyNew);
        if ($this->wallReplyEdit !== false) $params['wall_reply_edit'] = intval($this->wallReplyEdit);
        if ($this->wallReplyDelete !== false) $params['wall_reply_delete'] = intval($this->wallReplyDelete);
        if ($this->wallReplyRestore !== false) $params['wall_reply_restore'] = intval($this->wallReplyRestore);
        if ($this->wallPostNew !== false) $params['wall_post_new'] = intval($this->wallPostNew);
        if ($this->wallRepost !== false) $params['wall_repost'] = intval($this->wallRepost);
        if ($this->boardPostNew !== false) $params['board_post_new'] = intval($this->boardPostNew);
        if ($this->boardPostEdit !== false) $params['board_post_edit'] = intval($this->boardPostEdit);
        if ($this->boardPostRestore !== false) $params['board_post_restore'] = intval($this->boardPostRestore);
        if ($this->boardPostDelete !== false) $params['board_post_delete'] = intval($this->boardPostDelete);
        if ($this->photoCommentNew !== false) $params['photo_comment_new'] = intval($this->photoCommentNew);
        if ($this->photoCommentEdit !== false) $params['photo_comment_edit'] = intval($this->photoCommentEdit);
        if ($this->photoCommentDelete !== false) $params['photo_comment_delete'] = intval($this->photoCommentDelete);
        if ($this->photoCommentRestore !== false) $params['photo_comment_restore'] = intval($this->photoCommentRestore);
        if ($this->videoCommentNew !== false) $params['video_comment_new'] = intval($this->videoCommentNew);
        if ($this->videoCommentEdit !== false) $params['video_comment_edit'] = intval($this->videoCommentEdit);
        if ($this->videoCommentDelete !== false) $params['video_comment_delete'] = intval($this->videoCommentDelete);
        if ($this->videoCommentRestore !== false) $params['video_comment_restore'] = intval($this->videoCommentRestore);
        if ($this->marketCommentNew !== false) $params['market_comment_new'] = intval($this->marketCommentNew);
        if ($this->marketCommentEdit !== false) $params['market_comment_edit'] = intval($this->marketCommentEdit);
        if ($this->marketCommentDelete !== false) $params['market_comment_delete'] = intval($this->marketCommentDelete);
        if ($this->marketCommentRestore !== false) $params['market_comment_restore'] = intval($this->marketCommentRestore);
        if ($this->pollVoteNew !== false) $params['poll_vote_new'] = intval($this->pollVoteNew);
        if ($this->groupJoin !== false) $params['group_join'] = intval($this->groupJoin);
        if ($this->groupLeave !== false) $params['group_leave'] = intval($this->groupLeave);
        if ($this->groupChangeSettings !== false) $params['group_change_settings'] = intval($this->groupChangeSettings);
        if ($this->groupChangePhoto !== false) $params['group_change_photo'] = intval($this->groupChangePhoto);
        if ($this->groupOfficersEdit !== false) $params['group_officers_edit'] = intval($this->groupOfficersEdit);
        if ($this->userBlock !== false) $params['user_block'] = intval($this->userBlock);
        if ($this->userUnblock !== false) $params['user_unblock'] = intval($this->userUnblock);
        if ($this->leadFormsNew !== false) $params['lead_forms_new'] = intval($this->leadFormsNew);
        if ($this->likeAdd !== false) $params['like_add'] = intval($this->likeAdd);
        if ($this->likeRemove !== false) $params['like_remove'] = intval($this->likeRemove);
        if ($this->messageEvent !== false) $params['message_event'] = intval($this->messageEvent);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->groupId = 0;
            $this->serverId = 0;
            $this->apiVersion = '';
            $this->messageNew = false;
            $this->messageReply = false;
            $this->messageAllow = false;
            $this->messageEdit = false;
            $this->messageDeny = false;
            $this->messageTypingState = false;
            $this->photoNew = false;
            $this->audioNew = false;
            $this->videoNew = false;
            $this->wallReplyNew = false;
            $this->wallReplyEdit = false;
            $this->wallReplyDelete = false;
            $this->wallReplyRestore = false;
            $this->wallPostNew = false;
            $this->wallRepost = false;
            $this->boardPostNew = false;
            $this->boardPostEdit = false;
            $this->boardPostRestore = false;
            $this->boardPostDelete = false;
            $this->photoCommentNew = false;
            $this->photoCommentEdit = false;
            $this->photoCommentDelete = false;
            $this->photoCommentRestore = false;
            $this->videoCommentNew = false;
            $this->videoCommentEdit = false;
            $this->videoCommentDelete = false;
            $this->videoCommentRestore = false;
            $this->marketCommentNew = false;
            $this->marketCommentEdit = false;
            $this->marketCommentDelete = false;
            $this->marketCommentRestore = false;
            $this->pollVoteNew = false;
            $this->groupJoin = false;
            $this->groupLeave = false;
            $this->groupChangeSettings = false;
            $this->groupChangePhoto = false;
            $this->groupOfficersEdit = false;
            $this->userBlock = false;
            $this->userUnblock = false;
            $this->leadFormsNew = false;
            $this->likeAdd = false;
            $this->likeRemove = false;
            $this->messageEvent = false;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.setCallbackSettings', $params);
    }
}