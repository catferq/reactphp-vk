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

    private ?Fave\AddArticle $addArticle = null;
    private ?Fave\AddLink $addLink = null;
    private ?Fave\AddPage $addPage = null;
    private ?Fave\AddPost $addPost = null;
    private ?Fave\AddProduct $addProduct = null;
    private ?Fave\AddTag $addTag = null;
    private ?Fave\AddVideo $addVideo = null;
    private ?Fave\EditTag $editTag = null;
    private ?Fave\Get $get = null;
    private ?Fave\GetPages $getPages = null;
    private ?Fave\GetTags $getTags = null;
    private ?Fave\MarkSeen $markSeen = null;
    private ?Fave\RemoveArticle $removeArticle = null;
    private ?Fave\RemoveLink $removeLink = null;
    private ?Fave\RemovePage $removePage = null;
    private ?Fave\RemovePost $removePost = null;
    private ?Fave\RemoveProduct $removeProduct = null;
    private ?Fave\RemoveTag $removeTag = null;
    private ?Fave\ReorderTags $reorderTags = null;
    private ?Fave\SetPageTags $setPageTags = null;
    private ?Fave\SetTags $setTags = null;
    private ?Fave\TrackPageInteraction $trackPageInteraction = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * 
     */
    public function addArticle(): AddArticle
    {
        if (!$this->addArticle) {
            $this->addArticle = new AddArticle($this->_provider);
        }
        return $this->addArticle;
    }

    /**
     * Adds a link to user faves.
     */
    public function addLink(): AddLink
    {
        if (!$this->addLink) {
            $this->addLink = new AddLink($this->_provider);
        }
        return $this->addLink;
    }

    /**
     * 
     */
    public function addPage(): AddPage
    {
        if (!$this->addPage) {
            $this->addPage = new AddPage($this->_provider);
        }
        return $this->addPage;
    }

    /**
     * 
     */
    public function addPost(): AddPost
    {
        if (!$this->addPost) {
            $this->addPost = new AddPost($this->_provider);
        }
        return $this->addPost;
    }

    /**
     * 
     */
    public function addProduct(): AddProduct
    {
        if (!$this->addProduct) {
            $this->addProduct = new AddProduct($this->_provider);
        }
        return $this->addProduct;
    }

    /**
     * 
     */
    public function addTag(): AddTag
    {
        if (!$this->addTag) {
            $this->addTag = new AddTag($this->_provider);
        }
        return $this->addTag;
    }

    /**
     * 
     */
    public function addVideo(): AddVideo
    {
        if (!$this->addVideo) {
            $this->addVideo = new AddVideo($this->_provider);
        }
        return $this->addVideo;
    }

    /**
     * 
     */
    public function editTag(): EditTag
    {
        if (!$this->editTag) {
            $this->editTag = new EditTag($this->_provider);
        }
        return $this->editTag;
    }

    /**
     * 
     */
    public function get(): Get
    {
        if (!$this->get) {
            $this->get = new Get($this->_provider);
        }
        return $this->get;
    }

    /**
     * 
     */
    public function getPages(): GetPages
    {
        if (!$this->getPages) {
            $this->getPages = new GetPages($this->_provider);
        }
        return $this->getPages;
    }

    /**
     * 
     */
    public function getTags(): GetTags
    {
        if (!$this->getTags) {
            $this->getTags = new GetTags($this->_provider);
        }
        return $this->getTags;
    }

    /**
     * 
     */
    public function markSeen(): MarkSeen
    {
        if (!$this->markSeen) {
            $this->markSeen = new MarkSeen($this->_provider);
        }
        return $this->markSeen;
    }

    /**
     * 
     */
    public function removeArticle(): RemoveArticle
    {
        if (!$this->removeArticle) {
            $this->removeArticle = new RemoveArticle($this->_provider);
        }
        return $this->removeArticle;
    }

    /**
     * Removes link from the user's faves.
     */
    public function removeLink(): RemoveLink
    {
        if (!$this->removeLink) {
            $this->removeLink = new RemoveLink($this->_provider);
        }
        return $this->removeLink;
    }

    /**
     * 
     */
    public function removePage(): RemovePage
    {
        if (!$this->removePage) {
            $this->removePage = new RemovePage($this->_provider);
        }
        return $this->removePage;
    }

    /**
     * 
     */
    public function removePost(): RemovePost
    {
        if (!$this->removePost) {
            $this->removePost = new RemovePost($this->_provider);
        }
        return $this->removePost;
    }

    /**
     * 
     */
    public function removeProduct(): RemoveProduct
    {
        if (!$this->removeProduct) {
            $this->removeProduct = new RemoveProduct($this->_provider);
        }
        return $this->removeProduct;
    }

    /**
     * 
     */
    public function removeTag(): RemoveTag
    {
        if (!$this->removeTag) {
            $this->removeTag = new RemoveTag($this->_provider);
        }
        return $this->removeTag;
    }

    /**
     * 
     */
    public function reorderTags(): ReorderTags
    {
        if (!$this->reorderTags) {
            $this->reorderTags = new ReorderTags($this->_provider);
        }
        return $this->reorderTags;
    }

    /**
     * 
     */
    public function setPageTags(): SetPageTags
    {
        if (!$this->setPageTags) {
            $this->setPageTags = new SetPageTags($this->_provider);
        }
        return $this->setPageTags;
    }

    /**
     * 
     */
    public function setTags(): SetTags
    {
        if (!$this->setTags) {
            $this->setTags = new SetTags($this->_provider);
        }
        return $this->setTags;
    }

    /**
     * 
     */
    public function trackPageInteraction(): TrackPageInteraction
    {
        if (!$this->trackPageInteraction) {
            $this->trackPageInteraction = new TrackPageInteraction($this->_provider);
        }
        return $this->trackPageInteraction;
    }

}