<?php

namespace ReactPHPVK\Actions\Sections\AppWidgets;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Allows to update community app widget
 */
class Update
{
    private Provider $_provider;
    
    private string $code = '';
    private string $type = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Update
     */
    public function _setCustom(array $value): Update
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Update
     */
    public function setCode(string $value): Update
    {
        $this->code = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return Update
     */
    public function setType(string $value): Update
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['code'] = $this->code;
        $params['type'] = $this->type;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->code = '';
            $this->type = '';
            $this->_custom = [];
        }

        return $this->_provider->request('appWidgets.update', $params);
    }
}