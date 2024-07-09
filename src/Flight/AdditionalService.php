<?php

namespace Santosdave\Amadeus\Flight;

class AdditionalService
{
    public $amount;
    public $type;

    public function __construct($amount= null, $type= null)
    {
        $this->amount = $amount;
        $this->type = $type;
    }
}