<?php

namespace Santosdave\Amadeus\Flight;

class FareDetails
{
    public $segmentId;
    public $cabin;
    public $fareBasis;
    public $brandedFare;
    public $brandedFareLabel;
    public $class;
    public $includedCheckedBags;
    public $amenities;

    public function __construct(
        $segmentId = null,
        $cabin = null,
        $fareBasis = null,
        $brandedFare = null,
        $brandedFareLabel = null,
        $class = null,
        $includedCheckedBags = null,
        $amenities = null
    ) {
        $this->segmentId = $segmentId;
        $this->cabin = $cabin;
        $this->fareBasis = $fareBasis;
        $this->brandedFare = $brandedFare;
        $this->brandedFareLabel = $brandedFareLabel;
        $this->class = $class;
        $this->includedCheckedBags = $includedCheckedBags;
        $this->amenities = $amenities;
    }
}