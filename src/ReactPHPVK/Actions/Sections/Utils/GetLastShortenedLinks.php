<?php

namespace ReactPHPVK\Actions\Sections\Utils;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of user's shortened links.
 */
class GetLastShortenedLinks
{
    private Provider $_provider;
    
    private int $count = 10;
    private int $offset = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetLastShortenedLinks
     */
    public function _setCustom(array $value): GetLastShortenedLinks
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Number of links to return.
     * 
     * @param int $value
     * @return GetLastShortenedLinks
     */
    public function setCount(int $value): GetLastShortenedLinks
    {
        $this->count = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of links.
     * 
     * @param int $value
     * @return GetLastShortenedLinks
     */
    public function setOffset(int $value): GetLastShortenedLinks
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->count !== 10) $params['count'] = $this->count;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->count = 10;
            $this->offset = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('utils.getLastShortenedLinks', $params);
    }
}