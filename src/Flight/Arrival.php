<?php

namespace Santosdave\Amadeus\Flight;

class Arrival
{
    public $iataCode;
    public $terminal;
    public $at;
    public $cityName;
    public $airportName;

    public function __construct($iataCode = null, $terminal = null, $at = null,  $cityName = null, $airportName = null)
    {
        $this->iataCode = $iataCode;
        $this->terminal = $terminal;
        $this->at = $at;
        $this->cityName = $cityName;
        $this->airportName = $airportName;
    }
}
