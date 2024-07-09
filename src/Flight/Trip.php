<?php

namespace Santosdave\Amadeus\Flight;

class Trip
{
    public $type;
    public $id;
    public $source;
    public $instantTicketingRequired;
    public $nonHomogeneous;
    public $oneWay;
    public $lastTicketingDate;
    public $lastTicketingDateTime;
    public $numberOfBookableSeats;
    public $itineraries;
    public $price;
    public $pricingOptions;
    public $validatingAirlineCodes;
    public $travelerPricings;

    public function __construct(
        $type = null,
        $id = null,
        $source = null,
        $instantTicketingRequired = null,
        $nonHomogeneous = null,
        $oneWay = null,
        $lastTicketingDate = null,
        $lastTicketingDateTime = null,
        $numberOfBookableSeats = null,
        $itineraries = null,
        $price = null,
        $pricingOptions = null,
        $validatingAirlineCodes = null,
        $travelerPricings = null
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->source = $source;
        $this->instantTicketingRequired = $instantTicketingRequired;
        $this->nonHomogeneous = $nonHomogeneous;
        $this->oneWay = $oneWay;
        $this->lastTicketingDate = $lastTicketingDate;
        $this->lastTicketingDateTime = $lastTicketingDateTime;
        $this->numberOfBookableSeats = $numberOfBookableSeats;
        $this->itineraries = $itineraries;
        $this->price = $price;
        $this->pricingOptions = $pricingOptions;
        $this->validatingAirlineCodes = $validatingAirlineCodes;
        $this->travelerPricings = $travelerPricings;
    }
}