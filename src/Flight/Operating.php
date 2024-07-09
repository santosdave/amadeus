<?php

namespace Santosdave\Amadeus\Flight;

class Operating
{
    public $carrierCode;
    public $name;

    public function __construct($carrierCode = null)
    {
        $this->carrierCode = $carrierCode;
    }

    public function getCarrierCode()
    {
        return $this->carrierCode;
    }
}