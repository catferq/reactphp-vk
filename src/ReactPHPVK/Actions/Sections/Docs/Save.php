<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
 */
class Save
{
    private Provider $_provider;
    
    private string $file = '';
    private string $title = '';
    private string $tags = '';
    private bool $returnTags = false;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Save
     */
    public function _setCustom(array $value): Save
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * This parameter is returned when the file is [vk.com/dev/upload_files_2|uploaded to the server].
     * 
     * @param string $value
     * @return Save
     */
    public function setFile(string $value): Save
    {
        $this->file = $value;
        return $this;
    }

    /**
     * Document title.
     * 
     * @param string $value
     * @return Save
     */
    public function setTitle(string $value): Save
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Document tags.
     * 
     * @param string $value
     * @return Save
     */
    public function setTags(string $value): Save
    {
        $this->tags = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return Save
     */
    public function setReturnTags(bool $value): Save
    {
        $this->returnTags = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['file'] = $this->file;
        if ($this->title !== '') $params['title'] = $this->title;
        if ($this->tags !== '') $params['tags'] = $this->tags;
        if ($this->returnTags !== false) $params['return_tags'] = intval($this->returnTags);
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->file = '';
            $this->title = '';
            $this->tags = '';
            $this->returnTags = false;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.save', $params);
    }
}