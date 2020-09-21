<?php

namespace ReactPHPVK\Actions\Sections\Ads;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns a set of auto-suggestions for various targeting parameters.
 */
class GetSuggestions
{
    private Provider $_provider;
    
    private string $section = '';
    private string $ids = '';
    private string $q = '';
    private int $country = 0;
    private string $cities = '';
    private string $lang = '';
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetSuggestions
     */
    public function _setCustom(array $value): GetSuggestions
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Section, suggestions are retrieved in. Available values: *countries — request of a list of countries. If q is not set or blank, a short list of countries is shown. Otherwise, a full list of countries is shown. *regions — requested list of regions. 'country' parameter is required. *cities — requested list of cities. 'country' parameter is required. *districts — requested list of districts. 'cities' parameter is required. *stations — requested list of subway stations. 'cities' parameter is required. *streets — requested list of streets. 'cities' parameter is required. *schools — requested list of educational organizations. 'cities' parameter is required. *interests — requested list of interests. *positions — requested list of positions (professions). *group_types — requested list of group types. *religions — requested list of religious commitments. *browsers — requested list of browsers and mobile devices.
     * 
     * @param string $value
     * @return GetSuggestions
     */
    public function setSection(string $value): GetSuggestions
    {
        $this->section = $value;
        return $this;
    }

    /**
     * Objects IDs separated by commas. If the parameter is passed, 'q, country, cities' should not be passed.
     * 
     * @param string $value
     * @return GetSuggestions
     */
    public function setIds(string $value): GetSuggestions
    {
        $this->ids = $value;
        return $this;
    }

    /**
     * Filter-line of the request (for countries, regions, cities, streets, schools, interests, positions).
     * 
     * @param string $value
     * @return GetSuggestions
     */
    public function setQ(string $value): GetSuggestions
    {
        $this->q = $value;
        return $this;
    }

    /**
     * ID of the country objects are searched in.
     * 
     * @param int $value
     * @return GetSuggestions
     */
    public function setCountry(int $value): GetSuggestions
    {
        $this->country = $value;
        return $this;
    }

    /**
     * IDs of cities where objects are searched in, separated with a comma.
     * 
     * @param string $value
     * @return GetSuggestions
     */
    public function setCities(string $value): GetSuggestions
    {
        $this->cities = $value;
        return $this;
    }

    /**
     * Language of the returned string values. Supported languages: *ru — Russian,, *ua — Ukrainian,, *en — English.
     * 
     * @param string $value
     * @return GetSuggestions
     */
    public function setLang(string $value): GetSuggestions
    {
        $this->lang = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        $params['section'] = $this->section;
        if ($this->ids !== '') $params['ids'] = $this->ids;
        if ($this->q !== '') $params['q'] = $this->q;
        if ($this->country !== 0) $params['country'] = $this->country;
        if ($this->cities !== '') $params['cities'] = $this->cities;
        if ($this->lang !== '') $params['lang'] = $this->lang;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->section = '';
            $this->ids = '';
            $this->q = '';
            $this->country = 0;
            $this->cities = '';
            $this->lang = '';
            $this->_custom = [];
        }

        return $this->_provider->request('ads.getSuggestions', $params);
    }
}