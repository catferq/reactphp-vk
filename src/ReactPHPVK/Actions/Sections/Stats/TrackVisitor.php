<?php

namespace ReactPHPVK\Actions\Sections\Stats;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * 
 */
class TrackVisitor
{
    private Provider $_provider;
    
    private string $id = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return TrackVisitor
     */
    public function _setCustom(array $value): TrackVisitor
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return TrackVisitor
     */
    public function setId(string $value): TrackVisitor
    {
        $this->id = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['id'] = $this->id;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->id = '';
            $this->_custom = [];
        }

        return $this->_provider->request('stats.trackVisitor', $params);
    }
}