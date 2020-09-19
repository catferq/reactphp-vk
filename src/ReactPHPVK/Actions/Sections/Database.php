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

    private ?Database\GetChairs $getChairs = null;
    private ?Database\GetCities $getCities = null;
    private ?Database\GetCitiesById $getCitiesById = null;
    private ?Database\GetCountries $getCountries = null;
    private ?Database\GetCountriesById $getCountriesById = null;
    private ?Database\GetFaculties $getFaculties = null;
    private ?Database\GetMetroStations $getMetroStations = null;
    private ?Database\GetMetroStationsById $getMetroStationsById = null;
    private ?Database\GetRegions $getRegions = null;
    private ?Database\GetSchoolClasses $getSchoolClasses = null;
    private ?Database\GetSchools $getSchools = null;
    private ?Database\GetUniversities $getUniversities = null;

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * Returns list of chairs on a specified faculty.
     */
    public function getChairs(): GetChairs
    {
        if (!$this->getChairs) {
            $this->getChairs = new GetChairs($this->_provider);
        }
        return $this->getChairs;
    }

    /**
     * Returns a list of cities.
     */
    public function getCities(): GetCities
    {
        if (!$this->getCities) {
            $this->getCities = new GetCities($this->_provider);
        }
        return $this->getCities;
    }

    /**
     * Returns information about cities by their IDs.
     */
    public function getCitiesById(): GetCitiesById
    {
        if (!$this->getCitiesById) {
            $this->getCitiesById = new GetCitiesById($this->_provider);
        }
        return $this->getCitiesById;
    }

    /**
     * Returns a list of countries.
     */
    public function getCountries(): GetCountries
    {
        if (!$this->getCountries) {
            $this->getCountries = new GetCountries($this->_provider);
        }
        return $this->getCountries;
    }

    /**
     * Returns information about countries by their IDs.
     */
    public function getCountriesById(): GetCountriesById
    {
        if (!$this->getCountriesById) {
            $this->getCountriesById = new GetCountriesById($this->_provider);
        }
        return $this->getCountriesById;
    }

    /**
     * Returns a list of faculties (i.e., university departments).
     */
    public function getFaculties(): GetFaculties
    {
        if (!$this->getFaculties) {
            $this->getFaculties = new GetFaculties($this->_provider);
        }
        return $this->getFaculties;
    }

    /**
     * Get metro stations by city
     */
    public function getMetroStations(): GetMetroStations
    {
        if (!$this->getMetroStations) {
            $this->getMetroStations = new GetMetroStations($this->_provider);
        }
        return $this->getMetroStations;
    }

    /**
     * Get metro station by his id
     */
    public function getMetroStationsById(): GetMetroStationsById
    {
        if (!$this->getMetroStationsById) {
            $this->getMetroStationsById = new GetMetroStationsById($this->_provider);
        }
        return $this->getMetroStationsById;
    }

    /**
     * Returns a list of regions.
     */
    public function getRegions(): GetRegions
    {
        if (!$this->getRegions) {
            $this->getRegions = new GetRegions($this->_provider);
        }
        return $this->getRegions;
    }

    /**
     * Returns a list of school classes specified for the country.
     */
    public function getSchoolClasses(): GetSchoolClasses
    {
        if (!$this->getSchoolClasses) {
            $this->getSchoolClasses = new GetSchoolClasses($this->_provider);
        }
        return $this->getSchoolClasses;
    }

    /**
     * Returns a list of schools.
     */
    public function getSchools(): GetSchools
    {
        if (!$this->getSchools) {
            $this->getSchools = new GetSchools($this->_provider);
        }
        return $this->getSchools;
    }

    /**
     * Returns a list of higher education institutions.
     */
    public function getUniversities(): GetUniversities
    {
        if (!$this->getUniversities) {
            $this->getUniversities = new GetUniversities($this->_provider);
        }
        return $this->getUniversities;
    }

}