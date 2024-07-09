<?php

namespace Santosdave\Amadeus\Flight;

class Segment
{
    public $departure;
    public $arrival;
    public $carrierCode;
    public $number;
    public $aircraft;
    public $duration;
    public $id;
    public $numberOfStops;
    public $blacklistedInEU;

    public function __construct(
        $departure = null,
        $arrival = null,
        $carrierCode = null,
        $number = null,
        $aircraft = null,
        $duration = null,
        $id = null,
        $numberOfStops = null,
        $blacklistedInEU = null
    ) {
        $this->departure = $departure;
        $this->arrival = $arrival;
        $this->carrierCode = $carrierCode;
        $this->number = $number;
        $this->aircraft = $aircraft;
        $this->duration = $duration;
        $this->id = $id;
        $this->numberOfStops = $numberOfStops;
        $this->blacklistedInEU = $blacklistedInEU;
    }
}