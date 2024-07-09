<?php

namespace Santosdave\Amadeus\Flight;

class Location
{
    public $cityCode;
    public $countryCode;
    public $cityName;

    public function __construct($cityCode = null, $countryCode = null, $cityName = null)
    {
        $this->cityCode = $cityCode;
        $this->countryCode = $countryCode;
        $this->cityName = $cityName;
    }

    public function getCityCode()
    {
        return $this->cityCode;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCityName()
    {
        return $this->cityName;
    }
}
