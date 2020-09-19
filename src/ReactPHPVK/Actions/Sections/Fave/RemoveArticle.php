<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class RemoveArticle
{
    private Provider $_provider;
    
    private int $ownerId = 0;
    private int $articleId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return RemoveArticle
     */
    public function _setCustom(array $value): RemoveArticle
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveArticle
     */
    public function setOwnerId(int $value): RemoveArticle
    {
        $this->ownerId = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return RemoveArticle
     */
    public function setArticleId(int $value): RemoveArticle
    {
        $this->articleId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['owner_id'] = $this->ownerId;
        $params['article_id'] = $this->articleId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->ownerId = 0;
            $this->articleId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('fave.removeArticle', $params);
    }
}