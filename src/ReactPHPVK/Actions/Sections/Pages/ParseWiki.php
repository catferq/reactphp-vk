<?php

namespace ReactPHPVK\Actions\Sections\Pages;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns HTML representation of the wiki markup.
 */
class ParseWiki
{
    private Provider $_provider;
    
    private string $text = '';
    private int $groupId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return ParseWiki
     */
    public function _setCustom(array $value): ParseWiki
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Text of the wiki page.
     * 
     * @param string $value
     * @return ParseWiki
     */
    public function setText(string $value): ParseWiki
    {
        $this->text = $value;
        return $this;
    }

    /**
     * ID of the group in the context of which this markup is interpreted.
     * 
     * @param int $value
     * @return ParseWiki
     */
    public function setGroupId(int $value): ParseWiki
    {
        $this->groupId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['text'] = $this->text;
        if ($this->groupId !== 0) $params['group_id'] = $this->groupId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->text = '';
            $this->groupId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('pages.parseWiki', $params);
    }
}