<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns list of chairs on a specified faculty.
 */
class GetChairs
{
    private Provider $_provider;
    
    private int $facultyId = 0;
    private int $offset = 0;
    private int $count = 100;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetChairs
     */
    public function _setCustom(array $value): GetChairs
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * id of the faculty to get chairs from
     * 
     * @param int $value
     * @return GetChairs
     */
    public function setFacultyId(int $value): GetChairs
    {
        $this->facultyId = $value;
        return $this;
    }

    /**
     * offset required to get a certain subset of chairs
     * 
     * @param int $value
     * @return GetChairs
     */
    public function setOffset(int $value): GetChairs
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * amount of chairs to get
     * 
     * @param int $value
     * @return GetChairs
     */
    public function setCount(int $value): GetChairs
    {
        $this->count = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['faculty_id'] = $this->facultyId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->facultyId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getChairs', $params);
    }
}