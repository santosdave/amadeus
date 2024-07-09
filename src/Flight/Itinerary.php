<?php

namespace Santosdave\Amadeus\Flight;

class Itinerary
{
    public $duration;
    public $segments;

    public function __construct($duration = null, $segments = null)
    {
        $this->duration = $duration;
        $this->segments = $segments;
    }
}