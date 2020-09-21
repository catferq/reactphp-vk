<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Fave\AddArticle;
use ReactPHPVK\Actions\Sections\Fave\AddLink;
use ReactPHPVK\Actions\Sections\Fave\AddPage;
use ReactPHPVK\Actions\Sections\Fave\AddPost;
use ReactPHPVK\Actions\Sections\Fave\AddProduct;
use ReactPHPVK\Actions\Sections\Fave\AddTag;
use ReactPHPVK\Actions\Sections\Fave\AddVideo;
use ReactPHPVK\Actions\Sections\Fave\EditTag;
use ReactPHPVK\Actions\Sections\Fave\Get;
use ReactPHPVK\Actions\Sections\Fave\GetPages;
use ReactPHPVK\Actions\Sections\Fave\GetTags;
use ReactPHPVK\Actions\Sections\Fave\MarkSeen;
use ReactPHPVK\Actions\Sections\Fave\RemoveArticle;
use ReactPHPVK\Actions\Sections\Fave\RemoveLink;
use ReactPHPVK\Actions\Sections\Fave\RemovePage;
use ReactPHPVK\Actions\Sections\Fave\RemovePost;
use ReactPHPVK\Actions\Sections\Fave\RemoveProduct;
use ReactPHPVK\Actions\Sections\Fave\RemoveTag;
use ReactPHPVK\Actions\Sections\Fave\ReorderTags;
use ReactPHPVK\Actions\Sections\Fave\SetPageTags;
use ReactPHPVK\Actions\Sections\Fave\SetTags;
use ReactPHPVK\Actions\Sections\Fave\TrackPageInteraction;

class Fave
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function addArticle(): AddArticle
    {
        return new AddArticle($this->_provider);
    }

    /**
     * Adds a link to user faves.
     */
    public function addLink(): AddLink
    {
        return new AddLink($this->_provider);
    }

    /**
     * 
     */
    public function addPage(): AddPage
    {
        return new AddPage($this->_provider);
    }

    /**
     * 
     */
    public function addPost(): AddPost
    {
        return new AddPost($this->_provider);
    }

    /**
     * 
     */
    public function addProduct(): AddProduct
    {
        return new AddProduct($this->_provider);
    }

    /**
     * 
     */
    public function addTag(): AddTag
    {
        return new AddTag($this->_provider);
    }

    /**
     * 
     */
    public function addVideo(): AddVideo
    {
        return new AddVideo($this->_provider);
    }

    /**
     * 
     */
    public function editTag(): EditTag
    {
        return new EditTag($this->_provider);
    }

    /**
     * 
     */
    public function get(): Get
    {
        return new Get($this->_provider);
    }

    /**
     * 
     */
    public function getPages(): GetPages
    {
        return new GetPages($this->_provider);
    }

    /**
     * 
     */
    public function getTags(): GetTags
    {
        return new GetTags($this->_provider);
    }

    /**
     * 
     */
    public function markSeen(): MarkSeen
    {
        return new MarkSeen($this->_provider);
    }

    /**
     * 
     */
    public function removeArticle(): RemoveArticle
    {
        return new RemoveArticle($this->_provider);
    }

    /**
     * Removes link from the user's faves.
     */
    public function removeLink(): RemoveLink
    {
        return new RemoveLink($this->_provider);
    }

    /**
     * 
     */
    public function removePage(): RemovePage
    {
        return new RemovePage($this->_provider);
    }

    /**
     * 
     */
    public function removePost(): RemovePost
    {
        return new RemovePost($this->_provider);
    }

    /**
     * 
     */
    public function removeProduct(): RemoveProduct
    {
        return new RemoveProduct($this->_provider);
    }

    /**
     * 
     */
    public function removeTag(): RemoveTag
    {
        return new RemoveTag($this->_provider);
    }

    /**
     * 
     */
    public function reorderTags(): ReorderTags
    {
        return new ReorderTags($this->_provider);
    }

    /**
     * 
     */
    public function setPageTags(): SetPageTags
    {
        return new SetPageTags($this->_provider);
    }

    /**
     * 
     */
    public function setTags(): SetTags
    {
        return new SetTags($this->_provider);
    }

    /**
     * 
     */
    public function trackPageInteraction(): TrackPageInteraction
    {
        return new TrackPageInteraction($this->_provider);
    }

}