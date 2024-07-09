<?php

namespace Santosdave\Amadeus\Flight;

class Amenity
{
    public $description;
    public $isChargeable;
    public $amenityType;
    public $amenityProvider;

    public function __construct($description = null, $isChargeable = null, $amenityType = null, $amenityProvider = null)
    {
        $this->description = $description;
        $this->isChargeable = $isChargeable;
        $this->amenityType = $amenityType;
        $this->amenityProvider = $amenityProvider;
    }
}