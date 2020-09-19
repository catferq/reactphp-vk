<?php

namespace ReactPHPVK\Actions\Sections\Database;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a list of faculties (i.e., university departments).
 */
class GetFaculties
{
    private Provider $_provider;
    
    private int $universityId = 0;
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
     * @return GetFaculties
     */
    public function _setCustom(array $value): GetFaculties
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * University ID.
     * 
     * @param int $value
     * @return GetFaculties
     */
    public function setUniversityId(int $value): GetFaculties
    {
        $this->universityId = $value;
        return $this;
    }

    /**
     * Offset needed to return a specific subset of faculties.
     * 
     * @param int $value
     * @return GetFaculties
     */
    public function setOffset(int $value): GetFaculties
    {
        $this->offset = $value;
        return $this;
    }

    /**
     * Number of faculties to return.
     * 
     * @param int $value
     * @return GetFaculties
     */
    public function setCount(int $value): GetFaculties
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

        $params['university_id'] = $this->universityId;
        if ($this->offset !== 0) $params['offset'] = $this->offset;
        if ($this->count !== 100) $params['count'] = $this->count;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->universityId = 0;
            $this->offset = 0;
            $this->count = 100;
            $this->_custom = [];
        }

        return $this->_provider->request('database.getFaculties', $params);
    }
}