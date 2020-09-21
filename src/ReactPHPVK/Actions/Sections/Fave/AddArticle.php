<?php

namespace ReactPHPVK\Actions\Sections\Fave;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class AddArticle
{
    private Provider $_provider;
    
    private string $url = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return AddArticle
     */
    public function _setCustom(array $value): AddArticle
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddArticle
     */
    public function setUrl(string $value): AddArticle
    {
        $this->url = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['url'] = $this->url;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->url = '';
            $this->_custom = [];
        }

        return $this->_provider->request('fave.addArticle', $params);
    }
}