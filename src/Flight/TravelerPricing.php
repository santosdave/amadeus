<?php

namespace Santosdave\Amadeus\Flight;

class TravelerPricing
{
    public $travelerId;
    public $fareOption;
    public $travelerType;
    public $price;
    public $fareDetailsBySegment;

    public function __construct($travelerId = null, $fareOption = null, $travelerType = null, $price = null, $fareDetailsBySegment = null)
    {
        $this->travelerId = $travelerId;
        $this->fareOption = $fareOption;
        $this->travelerType = $travelerType;
        $this->price = $price;
        $this->fareDetailsBySegment = $fareDetailsBySegment;
    }
}