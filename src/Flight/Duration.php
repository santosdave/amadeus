<?php

namespace Santosdave\Amadeus\Flight;

use Carbon\CarbonInterval;

class Duration
{
    public $originalDuration;
    public $hours;
    public $minutes;

    public function __construct($duration)
    {
        $this->originalDuration = $duration;
        $this->parseDuration($duration);
    }

    public function parseDuration($duration)
    {
        $interval = new CarbonInterval();
        $interval = $interval->fromString($duration);

        $this->hours = $interval->hours;
        $this->minutes = $interval->minutes;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function getMinutes()
    {
        return $this->minutes;
    }

    public function __toString()
    {
        return "{$this->hours} hours {$this->minutes} minutes";
    }
}