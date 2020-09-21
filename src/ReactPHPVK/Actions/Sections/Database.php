<?php

namespace ReactPHPVK\Actions\Sections;

use ReactPHPVK\Client\Provider;

use ReactPHPVK\Actions\Sections\Database\GetChairs;
use ReactPHPVK\Actions\Sections\Database\GetCities;
use ReactPHPVK\Actions\Sections\Database\GetCitiesById;
use ReactPHPVK\Actions\Sections\Database\GetCountries;
use ReactPHPVK\Actions\Sections\Database\GetCountriesById;
use ReactPHPVK\Actions\Sections\Database\GetFaculties;
use ReactPHPVK\Actions\Sections\Database\GetMetroStations;
use ReactPHPVK\Actions\Sections\Database\GetMetroStationsById;
use ReactPHPVK\Actions\Sections\Database\GetRegions;
use ReactPHPVK\Actions\Sections\Database\GetSchoolClasses;
use ReactPHPVK\Actions\Sections\Database\GetSchools;
use ReactPHPVK\Actions\Sections\Database\GetUniversities;

class Database
{
    private Provider $_provider;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns list of chairs on a specified faculty.
     */
    public function getChairs(): GetChairs
    {
        return new GetChairs($this->_provider);
    }

    /**
     * Returns a list of cities.
     */
    public function getCities(): GetCities
    {
        return new GetCities($this->_provider);
    }

    /**
     * Returns information about cities by their IDs.
     */
    public function getCitiesById(): GetCitiesById
    {
        return new GetCitiesById($this->_provider);
    }

    /**
     * Returns a list of countries.
     */
    public function getCountries(): GetCountries
    {
        return new GetCountries($this->_provider);
    }

    /**
     * Returns information about countries by their IDs.
     */
    public function getCountriesById(): GetCountriesById
    {
        return new GetCountriesById($this->_provider);
    }

    /**
     * Returns a list of faculties (i.e., university departments).
     */
    public function getFaculties(): GetFaculties
    {
        return new GetFaculties($this->_provider);
    }

    /**
     * Get metro stations by city
     */
    public function getMetroStations(): GetMetroStations
    {
        return new GetMetroStations($this->_provider);
    }

    /**
     * Get metro station by his id
     */
    public function getMetroStationsById(): GetMetroStationsById
    {
        return new GetMetroStationsById($this->_provider);
    }

    /**
     * Returns a list of regions.
     */
    public function getRegions(): GetRegions
    {
        return new GetRegions($this->_provider);
    }

    /**
     * Returns a list of school classes specified for the country.
     */
    public function getSchoolClasses(): GetSchoolClasses
    {
        return new GetSchoolClasses($this->_provider);
    }

    /**
     * Returns a list of schools.
     */
    public function getSchools(): GetSchools
    {
        return new GetSchools($this->_provider);
    }

    /**
     * Returns a list of higher education institutions.
     */
    public function getUniversities(): GetUniversities
    {
        return new GetUniversities($this->_provider);
    }

}